<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Inventario_model');
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
    }

    public function index() {
        $this->entradas();
    }

    // --- ENTRADAS ---
    public function entradas() {
        $data['entradas'] = $this->Inventario_model->get_entradas();
        
        // Si tus vistas usan desplegables/selects para productos y conceptos:
        // $data['productos'] = $this->Inventario_model->get_productos(); 
        // $data['conceptos'] = $this->Inventario_model->get_conceptos_entradas();

        $this->load->view('layouts/header', ['titulo' => 'Registro de Entradas']);
        $this->load->view('inventario_entradas_view', $data);
        $this->load->view('layouts/footer');
    }

    public function guardar_entrada() {
        // Reglas de validación
        $this->form_validation->set_rules('id_producto', 'Producto', 'required|numeric');
        $this->form_validation->set_rules('cantidad_ent', 'Cantidad de Entrada', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('id_concepto', 'Concepto', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            // Si falla la validación, recarga la vista mostrando errores
            $this->entradas();
        } else {
            $data = [
                'id_producto'  => $this->input->post('id_producto', TRUE),
                'cantidad_ent' => $this->input->post('cantidad_ent', TRUE),
                'id_concepto'  => $this->input->post('id_concepto', TRUE)
            ];

            $this->Inventario_model->insertar_entrada($data);
            redirect('inventario/entradas');
        }
    }

    // --- SALIDAS ---
    public function salidas() {
        $data['salidas'] = $this->Inventario_model->get_salidas();

        // Si tus vistas usan desplegables/selects para productos y conceptos:
        // $data['productos'] = $this->Inventario_model->get_productos();
        // $data['conceptos'] = $this->Inventario_model->get_conceptos_salidas();

        $this->load->view('layouts/header', ['titulo' => 'Registro de Salidas']);
        $this->load->view('inventario_salidas_view', $data);
        $this->load->view('layouts/footer');
    }

    public function guardar_salida() {
        // Reglas de validación
        $this->form_validation->set_rules('id_producto', 'Producto', 'required|numeric');
        $this->form_validation->set_rules('cantidad_sal', 'Cantidad de Salida', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('id_concepto', 'Concepto', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            // Si falla la validación, recarga la vista
            $this->salidas();
        } else {
            $data = [
                'id_producto'  => $this->input->post('id_producto', TRUE),
                'cantidad_sal' => $this->input->post('cantidad_sal', TRUE),
                'id_concepto'  => $this->input->post('id_concepto', TRUE)
            ];

            $this->Inventario_model->insertar_salida($data);
            redirect('inventario/salidas');
        }
    }

    // --- INVENTARIO FÍSICO ---
    public function fisico() {
        $data['fisico'] = $this->Inventario_model->get_fisico();
        
        $this->load->view('layouts/header', ['titulo' => 'Inventario Físico']);
        $this->load->view('inventario_fisico_view', $data);
        $this->load->view('layouts/footer');
    }
}