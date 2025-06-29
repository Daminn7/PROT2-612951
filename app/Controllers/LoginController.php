<?php

namespace App\Controllers;
use App\Models\UsuariosModel;
use Config\Services;

class LoginController extends BaseController{
    
    public function index(){
        return view('PROT3-612951/login');
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

    public function formularioRecuperacion(){
        return view('PROT3-612951/formularioRecuperacion');
    }

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
            return view('password_reset', [
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
}
