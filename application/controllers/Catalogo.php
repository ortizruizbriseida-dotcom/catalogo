<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Producto_model');
    }

    public function index()
    {
        // Verificar que haya iniciado sesión.
        if (!$this->session->userdata('idusuario')) {
            redirect('login');
            return;
        }

        // Los administradores deben entrar a su panel.
        if ($this->session->userdata('rol') === 'ADMIN') {
            redirect('productos');
            return;
        }

        $data['titulo'] = 'Catálogo de productos';
        $data['productos'] = $this->Producto_model->catalogo();

        $this->load->view('catalogo_usuario', $data);
    }
}