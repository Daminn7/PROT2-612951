<?php

namespace App\Controllers;
use App\Models\UsuariosModel;

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
            'celular' => $post['telefono'],
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
        
        return redirect()->to(base_url('PROT2-612951/login'))
        ->with('mensaje_usuario', '¡Gracias por registrarte! Por favor, revisa tu correo electrónico para activar tu cuenta.');
    }
    
}