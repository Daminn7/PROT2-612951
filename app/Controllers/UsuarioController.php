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

    public function auth(){
        $rules = [
            'email' => 'required|min_length[3]|max_length[100]',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $usuariosModel = new UsuariosModel();
        $post = $this->request->getPost(['email', 'password']);

        // Buscar usuario por email o por nombre de usuario
        $usuario = $usuariosModel->where('activo', 1)
            ->groupStart()
                ->where('email', $post['email'])
                ->orWhere('nombre', $post['email'])
            ->groupEnd()
        ->first();

        if (!$usuario) {
            return redirect()->back()->withInput()->with('errors', ['Usuario/email no encontrado o cuenta inactiva.']);
        }

        if (!password_verify($post['password'], $usuario['contraseña'])) {
            return redirect()->back()->withInput()->with('errors', ['Contraseña incorrecta.']);
        }

        // Login exitoso
        $this->setSession($usuario);

        // Si es admin 
        if ($usuario['nombre'] === 'admin' && $usuario['id_roles'] == 1) {
            return redirect()->to(base_url('admin'));
        }
        // Para usuarios normales
        return redirect()->to(base_url('PROT3-612951/inicioSesion'));
    }

    private function setSession($usuarioData){
        $data = [
            'logged_in' => true,
            'id_usuario' => $usuarioData['id_usuario'],
            'nombre' => $usuarioData['nombre'] ?: 'admin', // Si nombre está vacío, usar 'admin'
            'apellido' => $usuarioData['apellido'] ?: 'Administrador', // Si apellido está vacío, usar 'Administrador'
            'id_roles' => $usuarioData['id_roles'],
            'admin' => ($usuarioData['id_roles'] == 1) ? true : false,
            'email' => $usuarioData['email'],
            'telefono' => $usuarioData['telefono'] ?: 'N/A'
        ];
        session()->set($data);
    }

    public function cerrarSesion(){
        if (session()->get('logged_in')) {
            session()->destroy();
        }
        return redirect()->to(base_url('login'));
    }

    //public function formularioRecuperacion() {
    //    return view('formularioRecuperacion');
    //}

    public function sendResetLinkEmail() {
        $rules =[
            'email' => 'required|max_length[100]|valid_email'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $usuariosModel = new UsuariosModel();
        $post = $this->request->getPost(['email']);
        $usuario = $usuariosModel->where(['email' => $post['email'], 'activo' => 1])->first();

        if ($usuario) {
            $token = bin2hex(random_bytes(20)); 
            $expireAt = new \DateTime();
            $expireAt->modify('+1 hour'); // El token expira en 1 hora

            $usuariosModel->update($usuario['id_usuario'], [
                'reset_token' => $token,
                'reset_token_expiracion' => $expireAt->format('Y-m-d H:i:s'),
            ]);

            $email = \Config\Services::email();
            $email->setTo($post['email']);
            $email->setSubject('Recuperación de contraseña');

            $url = base_url('password_reset/' . $token);
            $body = '<p>Estimado/a ' . $usuario['nombre'] . ',</p>';
            $body .= "<p>Se ha solicitado un reinicio de contraseña.<br>Para restaurar la contraseña, visita el siguiente enlace:  <a href='$url'>$url</a></p>";

            $email->setMessage($body);
            $email->send();
        }

        return redirect()->to(base_url('login'))
        ->with('mensaje_usuario', 'Se ha enviado un correo electrónico con instrucciones para restablecer tu contraseña.');
    }

    public function resetForm($token) {
        $usuariosModel = new UsuariosModel();
        $usuario = $usuariosModel->where(['reset_token' => $token])->first();

        if ($usuario){
            $currentDateTime = new \DateTime();
            $currentDateTimeStr = $currentDateTime->format('Y-m-d H:i:s');

            if($currentDateTimeStr <= $usuario['reset_token_expiracion']) {
                return view('password_reset',['token' => $token]);// El token es válido y no ha expirado
            } else {
                // El token ha expirado
                return redirect()->to(base_url('login'))
                ->with('error_usuario', 'El enlace de recuperación ha expirado. Por favor, solicita un nuevo enlace para restablecer tu contraseña.');

            }
        }

        return redirect()->to(base_url('login'))
        ->with('error_usuario', 'Por favor, intenta nuevamente más tarde.');
    }

    public function resetPassword() {
        
        $rules = [
            'password' => [
                'label' => 'contraseña',
                'rules' => 'required|min_length[6]|max_length[100]'
            ],
            'repassword' => [
                'label' => 'confirmar contraseña',
                'rules' => 'matches[password]'
            ],
        ];

        if (!$this->validate($rules)) {
            return view('password-reset', [
                'token' => $this->request->getPost('token'),
                'errors' => $this->validator->getErrors()
                
            ]);
        }

        $usuariosModel = new UsuariosModel();
        $post = $this->request->getPost(['token', 'password', 'repassword']);

        $usuario = $usuariosModel->where(['reset_token' => $post['token'], 'activo' => 1])->first();

        if ($usuario) {
            $usuariosModel->update($usuario['id_usuario'], [
                'contraseña' => password_hash($post['password'], PASSWORD_DEFAULT),
                'reset_token' => null,
                'reset_token_expiracion' => null,
            ]);
            
        return redirect()->to(base_url('login'))
        ->with('mensaje_usuario', 'Tu contraseña ha sido restablecida exitosamente. Ahora puedes iniciar sesión.');

        }
        return redirect()->to(base_url('login'))
        ->with('error_usuario', 'Por favor, intenta nuevamente más tarde.');
    }

    public function inicioSesion(){
        // Verificar si el usuario está logueado
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'))->with('error_usuario', 'Debes iniciar sesión primero.');
        }
        
        return view('PROT3-612951/inicioSesion');
    }

    public function mostrarModificarUsuario(){
        // Verificar si el usuario está logueado
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'))->with('error_usuario', 'Debes iniciar sesión primero.');
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
            $this->setSession($usuariosModel->find(session()->get('id_usuario')));
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

        return view('usuarios/eliminar_cuenta');
    }

    public function eliminarCuenta(){
        // Verificar si el usuario está logueado
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'))->with('error_usuario', 'Debes iniciar sesión primero.');
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