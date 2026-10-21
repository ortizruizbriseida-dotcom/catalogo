
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
    public function buscar_por_correo($correo)
    {
        return $this->db
            ->where('correo', $correo)
            ->limit(1)
            ->get('usuarios')
            ->row();
    }

    public function insertar($datos)
    {
        return $this->db->insert('usuarios', $datos);
    }
}
