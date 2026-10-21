<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Linea_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function obtener_todas()
    {
        $query = $this->db->get('linea');
        return $query->result();
    }

    // Nueva función para actualizar el estatus
    public function cambiar_estatus($idlinea, $nuevo_estatus)
    {
        $this->db->where('idlinea', $idlinea);
        return $this->db->update('linea', ['estatus_linea' => $nuevo_estatus]);
    }
}
