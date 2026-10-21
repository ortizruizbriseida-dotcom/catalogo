
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    // ==========================================
    // OBTENER TODOS LOS PROVEEDORES
    // ==========================================
    public function catalogo()
    {
        $this->db->select('proveedores.*');

        $this->db->from('proveedores');

        $this->db->order_by(
            'proveedores.idprov',
            'DESC'
        );

        return $this->db->get()->result();
    }


    // ==========================================
    // OBTENER UN PROVEEDOR
    // ==========================================
    public function obtener($id)
    {
        $this->db->select('proveedores.*');

        $this->db->from('proveedores');

        $this->db->where(
            'proveedores.idprov',
            $id
        );

        return $this->db->get()->row();
    }


    // ==========================================
    // INSERTAR PROVEEDOR
    // ==========================================
    public function insertar($datos)
    {
        return $this->db->insert(
            'proveedores',
            $datos
        );
    }


    // ==========================================
    // ACTUALIZAR PROVEEDOR
    // ==========================================
    public function actualizar($id, $datos)
    {
        $this->db->where(
            'idprov',
            $id
        );

        return $this->db->update(
            'proveedores',
            $datos
        );
    }


    // ==========================================
    // ELIMINAR PROVEEDOR
    // ==========================================
    public function eliminar($id)
    {
        $this->db->where(
            'idprov',
            $id
        );

        return $this->db->delete(
            'proveedores'
        );
    }
}
