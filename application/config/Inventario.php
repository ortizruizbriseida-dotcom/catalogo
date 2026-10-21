<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Inventario_model');
        $this->load->helper(['url', 'form']);
    }

    public function index() {
        $this->entradas();
    }

    // --- ENTRADAS ---
    public function entradas() {
        $data['entradas'] = $this->Inventario_model->get_entradas();
        $this->load->view('layouts/header', ['titulo' => 'Registro de Entradas']);
        $this->load->view('inventario_entradas_view', $data);
        $this->load->view('layouts/footer');
    }

    public function guardar_entrada() {
        $data = [
            'id_producto'   => $this->input->post('id_producto'),
            'cantidad_ent'  => $this->input->post('cantidad_ent'),
            'id_concepto'   => $this->input->post('id_concepto')
        ];
        $this->Inventario_model->insertar_entrada($data);
        redirect('inventario/entradas');
    }

    // --- SALIDAS ---
    public function salidas() {
        $data['salidas'] = $this->Inventario_model->get_salidas();
        $this->load->view('layouts/header', ['titulo' => 'Registro de Salidas']);
        $this->load->view('inventario_salidas_view', $data);
        $this->load->view('layouts/footer');
    }

    public function guardar_salida() {
        $data = [
            'id_producto'   => $this->input->post('id_producto'),
            'cantidad_sal'  => $this->input->post('cantidad_sal'),
            'id_concepto'   => $this->input->post('id_concepto')
        ];
        $this->Inventario_model->insertar_salida($data);
        redirect('inventario/salidas');
    }

    // --- INVENTARIO FÍSICO ---
    public function fisico() {
        // Carga la información calculada de las tablas de productos, entradas y salidas
        $data['fisico'] = $this->Inventario_model->get_fisico();
        $this->load->view('layouts/header', ['titulo' => 'Inventario Físico']);
        $this->load->view('inventario_fisico_view', $data);
        $this->load->view('layouts/footer');
    }
}
