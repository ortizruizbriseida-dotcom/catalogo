<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_entradas() {
        return $this->db->get('registro_entradas')->result();
    }

    public function get_salidas() {
        return $this->db->get('registro_salidas')->result();
    }

    public function get_fisico() {
        $sql = "
            SELECT 
                p.idprod AS id_producto,
                p.descripcion AS nombre_producto,
                COALESCE(e.total_ent, 0) AS total_entradas,
                COALESCE(s.total_sal, 0) AS total_salidas,
                CURTIME() AS hora
            FROM productos p
            LEFT JOIN (
                SELECT id_producto, SUM(cantidad_ent) AS total_ent 
                FROM registro_entradas 
                GROUP BY id_producto
            ) e ON (e.id_producto = p.idprod OR e.id_producto = p.claveprod)
            LEFT JOIN (
                SELECT id_producto, SUM(cantidad_sal) AS total_sal 
                FROM registro_salidas 
                GROUP BY id_producto
            ) s ON (s.id_producto = p.idprod OR s.id_producto = p.claveprod)
        ";

        return $this->db->query($sql)->result();
    }

    public function insertar_entrada($data) {
        return $this->db->insert('registro_entradas', $data);
    }

    public function insertar_salida($data) {
        return $this->db->insert('registro_salidas', $data);
    }
}
