
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
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
        // Si ya inició sesión, enviarlo a su sección.
        if ($this->session->userdata('idusuario')) {
            $this->redirigir_por_rol();
            return;
        }

        // Mostrar el formulario de inicio de sesión.
        $data['titulo'] = 'Iniciar sesión';
        $data['error'] = $this->session->flashdata('error');

        $this->load->view('login/index', $data);
    }

    public function ingresar()
    {
        // Permitir el ingreso únicamente mediante POST.
        if ($this->input->method(TRUE) !== 'POST') {
            redirect('login');
            return;
        }

        $correo = trim($this->input->post('correo', TRUE));
        $password = $this->input->post('password', FALSE);

        // Buscar al usuario por su correo.
        $usuario = $this->Usuario_model->buscar_por_correo($correo);

        // Verificar credenciales y estado de la cuenta.
        if (
            !$usuario ||
            !password_verify($password, $usuario->password) ||
            $usuario->estatus_usuario !== 'ALTA'
        ) {
            $this->session->set_flashdata(
                'error',
                'Correo o contraseña incorrectos, o cuenta inactiva.'
            );

            redirect('login');
            return;
        }

        // Regenerar el identificador de sesión.
        $this->session->sess_regenerate(TRUE);

        // Guardar los datos del usuario autenticado.
        $this->session->set_userdata(array(
            'idusuario' => $usuario->idusuario,
            'nombre'    => $usuario->descripusuario,
            'rol'       => $usuario->rol,
            'logueado'  => TRUE
        ));

        // Enviar al usuario a la sección correspondiente.
        $this->redirigir_por_rol();
    }

    private function redirigir_por_rol()
    {
        if ($this->session->userdata('rol') === 'ADMIN') {
            redirect('productos');
        } else {
            redirect('catalogo');
        }
    }

    public function salir()
    {
        // Evitar que el cierre de sesión se ejecute mediante GET.
        if ($this->input->method(TRUE) !== 'POST') {
            show_error(
                'Método no permitido.',
                405,
                'Acceso no permitido'
            );
            return;
        }

        // Eliminar todos los datos de la sesión.
        $this->session->sess_destroy();

        // Regresar al formulario de inicio de sesión.
        redirect('login');
    }
}
