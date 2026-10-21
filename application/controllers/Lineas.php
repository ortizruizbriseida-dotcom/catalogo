<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lineas extends CI_Controller 
{
    public function index()
    {
        $this->load->model('Linea_model');
        $data['lineas'] = $this->Linea_model->obtener_todas();
        $this->load->view('lineas/index', $data);
    }

    // Método para cambiar el estatus y regresar a la vista
    public function cambiar_estatus($idlinea, $nuevo_estatus)
    {
        $this->load->model('Linea_model');
        $this->Linea_model->cambiar_estatus($idlinea, $nuevo_estatus);
        
        // Redirecciona de vuelta a la lista de líneas
        redirect('lineas');
    }
}
