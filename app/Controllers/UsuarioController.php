<?php

namespace App\Controllers;
use App\Models\UsuariosModel;
use Config\Services;

class UsuarioController extends BaseController{
    public function crearCuenta(){
        $rules = [
            'nombre' => 'required|min_length[2]|max_length[100]',
            'apellido' => 'required|min_length[2]|max_length[100]',
            'domicilio' => 'required|min_length[2]|max_length[255]',
            'telefono' => 'required|numeric|min_length[10]|max_length[20]|regex_match[/^[0-9]+$/]',
            'email' => 'required|max_length[100]|valid_email|is_unique[usuarios.email]',
            'password' => 'required|min_length[6]|max_length[100]',
            'repassword' => 'required|matches[password]',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $usuariosModel = new UsuariosModel();
        $post = $this->request->getPost(['nombre', 'apellido', 'domicilio', 'telefono', 'email', 'password']);

        $token = bin2hex(random_bytes(20)); // Generar un token aleatorio

        $usuariosModel->insert([
            'id_roles' => 2, 
            'nombre' => $post['nombre'],
            'apellido' => $post['apellido'],
            'direccion' => $post['domicilio'],
            'telefono' => $post['telefono'],
            'email' => $post['email'],
            'contraseña' => password_hash($post['password'], PASSWORD_DEFAULT),
            'activacion_token' => $token,
            'activo' => 0, // Usuario inactivo por defecto
        ]);

        $email = \Config\Services::email();
        $email->setTo($post['email']);
        $email->setSubject('Activación de cuenta');

        $url = base_url('activar_cuenta/' . $token);
        $body = '<p>Hola ' . $post['nombre'] . ',</p>';
        $body .= "<p>Gracias por registrarte. Por favor, activa tu cuenta haciendo clic en el siguiente enlace: <a href='$url'>Activar cuenta</a></p>";
        $body .= 'Gracias por unirte a nosotros!';

        $email->setMessage($body);
        $email->send();
        
        if (!$email->send()) {
        log_message('error', $email->printDebugger(['headers', 'subject', 'body']));
        }
        // Limpia los datos de la sesión después de un registro exitoso
        session()->remove('registration_data');
        
        return redirect()->to(base_url('login'))
        ->with('mensaje_usuario', '¡Gracias por registrarte! Por favor, revisa tu correo electrónico para activar tu cuenta.');
    }
    
    public function guardarDatosRegistro(){
        if ($this->request->isAJAX()) { //con Javascript
            $data = $this->request->getJSON(true); // Obtiene los datos JSON como un array asociativo

            // Elimina datos sensibles como contraseñas antes de guardar en la sesión
            unset($data['password']);
            unset($data['repassword']);
            unset($data['csrf_test_name']); // Elimina el token CSRF si está presente

            session()->set('registration_data', $data);
            return $this->response->setJSON(['success' => true]);
        }
        return $this->response->setJSON(['success' => false, 'message' => 'Solicitud inválida']);
    }

    public function obtenerDatosRegistro(){
        if ($this->request->isAJAX()) {
            $data = session()->get('registration_data');
            return $this->response->setJSON($data);
        }
        return $this->response->setJSON([]);
    }

    public function activar_cuenta($token) {
        $usuariosModel = new UsuariosModel();
        $usuario = $usuariosModel->where(['activacion_token' => $token, 'activo' => 0])->first();

        if ($usuario) {
            $usuariosModel->update($usuario['id_usuario'], [
                'activo' => 1,
                'activacion_token' => null, // Limpiar el token después de la activación
            ]);

            return redirect()->to(base_url('login'))
            ->with('mensaje_usuario', 'Cuenta activada exitosamente. Ahora puedes iniciar sesión.');
        }
        
        return redirect()->to(base_url('login'))
        ->with('error_usuario', 'Por favor, intenta nuevamente más tarde o contacta al soporte si el problema persiste.');
    }

    public function mostrarModificarUsuario(){
        // Verificar si el usuario está logueado
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'))->with('error_usuario', 'Debes iniciar sesión primero.');
        }

        // Verificar si es administrador (id_roles = 1)
        if (session()->get('id_roles') == 1) {
            return redirect()->to(base_url('PROT3-612951/inicioSesion'))->with('error_usuario', 'Los administradores no pueden modificar su perfil desde esta sección.');
        }

        $usuariosModel = new UsuariosModel();
        $usuario = $usuariosModel->find(session()->get('id_usuario'));

        if (!$usuario) {
            return redirect()->to(base_url('login'))->with('error_usuario', 'Usuario no encontrado.');
        }

        return view('usuarios/modificar_usuario', ['usuario' => $usuario]);
    }

    public function actualizarUsuario(){
        // Verificar si el usuario está logueado
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'))->with('error_usuario', 'Debes iniciar sesión primero.');
        }

        // Verificar si es administrador (id_roles = 1)
        if (session()->get('id_roles') == 1) {
            return redirect()->to(base_url('PROT3-612951/inicioSesion'))->with('error_usuario', 'Los administradores no pueden modificar su perfil desde esta sección.');
        }

        $rules = [
            'nombre' => 'required|min_length[2]|max_length[100]',
            'apellido' => 'required|min_length[2]|max_length[100]',
            'direccion' => 'required|min_length[2]|max_length[255]',
            'telefono' => 'required|numeric|min_length[10]|max_length[20]|regex_match[/^[0-9]+$/]',
            'email' => 'required|max_length[100]|valid_email|is_unique[usuarios.email,id_usuario,' . session()->get('id_usuario') . ']',
        ];

        // Si se proporciona una nueva contraseña, validarla
        if ($this->request->getPost('password')) {
            $rules['password'] = 'required|min_length[6]|max_length[100]';
            $rules['repassword'] = 'required|matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $usuariosModel = new UsuariosModel();
        $post = $this->request->getPost(['nombre', 'apellido', 'direccion', 'telefono', 'email', 'password']);

        $updateData = [
            'nombre' => $post['nombre'],
            'apellido' => $post['apellido'],
            'direccion' => $post['direccion'],
            'telefono' => $post['telefono'],
            'email' => $post['email'],
        ];

        // Si se proporciona una nueva contraseña, hashearla
        if (!empty($post['password'])) {
            $updateData['contraseña'] = password_hash($post['password'], PASSWORD_DEFAULT);
        }

        $updated = $usuariosModel->update(session()->get('id_usuario'), $updateData);

        if ($updated) {
            // Actualizar los datos de la sesión
            $usuarioActualizado = $usuariosModel->find(session()->get('id_usuario'));
            $data = [
                'logged_in' => true,
                'id_usuario' => $usuarioActualizado['id_usuario'],
                'nombre' => $usuarioActualizado['nombre'] ?: 'admin',
                'apellido' => $usuarioActualizado['apellido'] ?: 'Administrador',
                'id_roles' => $usuarioActualizado['id_roles'],
                'admin' => ($usuarioActualizado['id_roles'] == 1) ? true : false,
                'email' => $usuarioActualizado['email'],
                'telefono' => $usuarioActualizado['telefono'] ?: 'N/A'
            ];
            session()->set($data);
            return redirect()->to(base_url('modificar-usuario'))->with('mensaje_usuario', 'Datos actualizados exitosamente.');
        } else {
            return redirect()->back()->withInput()->with('error_usuario', 'Error al actualizar los datos.');
        }
    }

    public function mostrarEliminarCuenta(){
        // Verificar si el usuario está logueado
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'))->with('error_usuario', 'Debes iniciar sesión primero.');
        }

        // Verificar si es administrador (id_roles = 1)
        if (session()->get('id_roles') == 1) {
            return redirect()->to(base_url('PROT3-612951/inicioSesion'))->with('error_usuario', 'Los administradores no pueden eliminar su cuenta.');
        }

        return view('usuarios/eliminar_cuenta');
    }

    public function eliminarCuenta(){
        // Verificar si el usuario está logueado
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'))->with('error_usuario', 'Debes iniciar sesión primero.');
        }

        // Verificar si es administrador (id_roles = 1)
        if (session()->get('id_roles') == 1) {
            return redirect()->to(base_url('PROT3-612951/inicioSesion'))->with('error_usuario', 'Los administradores no pueden eliminar su cuenta.');
        }

        $rules = [
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $usuariosModel = new UsuariosModel();
        $usuario = $usuariosModel->find(session()->get('id_usuario'));

        if (!$usuario) {
            return redirect()->to(base_url('login'))->with('error_usuario', 'Usuario no encontrado.');
        }

        // Verificar la contraseña actual
        if (!password_verify($this->request->getPost('password'), $usuario['contraseña'])) {
            return redirect()->back()->with('error_usuario', 'Contraseña incorrecta.');
        }

        // Desactivar la cuenta (activo = 0)
        $updated = $usuariosModel->update(session()->get('id_usuario'), ['activo' => 0]);

        if ($updated) {
            // Cerrar sesión
            session()->destroy();
            return redirect()->to(base_url('login'))->with('mensaje_usuario', 'Tu cuenta ha sido eliminada exitosamente.');
        } else {
            return redirect()->back()->with('error_usuario', 'Error al eliminar la cuenta.');
        }
    }

}