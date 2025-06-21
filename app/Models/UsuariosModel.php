<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id_usuario';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_roles','email','contraseña','nombre','apellido','telefono','direccion','activacion_token','reset_token','reset_token_expiracion','activo'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_actualizacion';

    public function validacionUsuario($usuario,$password){
        $usuario = $this->where(['email' => $usuario, 'activo' => 1])->first();
        if ($usuario && password_verify($password, $usuario['contraseña'])) { 
            return $usuario; // Usuario encontrado y contraseña correcta
        }
            return null;
    }
}
