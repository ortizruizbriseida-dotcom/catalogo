
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->model('Usuario_model');
    }

    public function index()
    {
        if ($this->session->userdata('idusuario')) {
            redirect(
                $this->session->userdata('rol') === 'ADMIN'
                    ? 'productos'
                    : 'catalogo'
            );
            return;
        }

        $data['error'] = $this->session->flashdata('error');

        $this->load->view('registro/index', $data);
    }

    public function guardar()
    {
        if ($this->input->method(TRUE) !== 'POST') {
            redirect('registro');
            return;
        }

        $this->form_validation->set_rules(
            'nombre',
            'Nombre',
            'required|trim|max_length[100]'
        );

        $this->form_validation->set_rules(
            'correo',
            'Correo',
            'required|trim|valid_email|max_length[100]'
        );

        $this->form_validation->set_rules(
            'password',
            'Contraseña',
            'required|min_length[8]|max_length[72]'
        );

        $this->form_validation->set_rules(
            'confirmar',
            'Confirmación',
            'required|matches[password]'
        );

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('registro/index');
            return;
        }

        $correo = strtolower(trim($this->input->post('correo', TRUE)));

        if ($this->Usuario_model->buscar_por_correo($correo)) {
            $this->session->set_flashdata(
                'error',
                'Ese correo ya está registrado.'
            );

            redirect('registro');
            return;
        }

        $datos = array(
            'descripusuario' => trim($this->input->post('nombre', TRUE)),
            'correo'         => $correo,
            'password'       => password_hash(
                $this->input->post('password', FALSE),
                PASSWORD_DEFAULT
            ),
            'rol'            => 'USUARIO',
            'estatus_usuario'=> 'ALTA'
        );

        if ($this->Usuario_model->insertar($datos)) {
            $this->session->set_flashdata(
                'mensaje',
                'Tu cuenta fue creada. Ya puedes iniciar sesión.'
            );

            redirect('login');
        } else {
            $this->session->set_flashdata(
                'error',
                'No fue posible crear la cuenta. Inténtalo de nuevo.'
            );

            redirect('registro');
        }
    }
}
