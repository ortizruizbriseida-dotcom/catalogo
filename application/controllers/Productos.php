
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // MODELOS
        $this->load->model('Producto_model');
        $this->load->model('Proveedor_model');

        // BASE DE DATOS
        $this->load->database();

        // HELPERS
        $this->load->helper('url');

        // LIBRERÍAS
        $this->load->library('form_validation');
        $this->load->library('session');
    }


    // ==================================================
    // PRODUCTOS
    // ==================================================

    public function index()
    {
        $data['titulo'] = 'Catálogo de productos';

        $data['productos'] =
            $this->Producto_model->catalogo();

        $this->load->view(
            'layouts/header',
            $data
        );

        $this->load->view(
            'productos/index',
            $data
        );

        $this->load->view(
            'layouts/footer'
        );
    }


    // ==================================================
    // DAR DE BAJA PRODUCTO
    // ==================================================

    public function dar_baja($idprod)
    {
        $data = array('estatus_prod' => 'BAJA');

        $this->db->where('idprod', $idprod);
        $resultado = $this->db->update('productos', $data);

        if ($resultado)
        {
            $this->session->set_flashdata('mensaje', 'Producto dado de baja correctamente.');
        }
        else
        {
            $this->session->set_flashdata('error', 'No se pudo dar de baja el producto.');
        }

        redirect('productos');
    }


    // ==================================================
    // DAR DE ALTA PRODUCTO
    // ==================================================

    public function dar_alta($idprod)
    {
        $data = array('estatus_prod' => 'ALTA');

        $this->db->where('idprod', $idprod);
        $resultado = $this->db->update('productos', $data);

        if ($resultado)
        {
            $this->session->set_flashdata('mensaje', 'Producto dado de alta correctamente.');
        }
        else
        {
            $this->session->set_flashdata('error', 'No se pudo dar de alta el producto.');
        }

        redirect('productos');
    }


    // ==================================================
    // NUEVO PRODUCTO
    // ==================================================

    public function nuevo()
    {
        $data['titulo'] = 'Agregar producto';

        // Líneas activas
        $data['lineas'] = $this->db
            ->where('estatus_linea', 'ALTA')
            ->order_by(
                'descripcion_linea',
                'ASC'
            )
            ->get('linea')
            ->result();

        // Proveedores activos
        $data['proveedores'] = $this->db
            ->where('estatusprov', 'ALTA')
            ->order_by(
                'nombreprov',
                'ASC'
            )
            ->get('proveedores')
            ->result();

        $this->load->view(
            'layouts/header',
            $data
        );

        $this->load->view(
            'productos/form',
            $data
        );

        $this->load->view(
            'layouts/footer'
        );
    }


    // ==================================================
    // GUARDAR PRODUCTO
    // ==================================================

    public function guardar()
    {
        $this->form_validation->set_rules(
            'claveprod',
            'Clave del producto',
            'required|trim'
        );

        $this->form_validation->set_rules(
            'descripcion',
            'Descripción',
            'required|trim'
        );

        $this->form_validation->set_rules(
            'idlinea',
            'Línea',
            'required|integer'
        );

        $this->form_validation->set_rules(
            'proveedor',
            'Proveedor',
            'required|integer'
        );

        $this->form_validation->set_rules(
            'preciocompra',
            'Precio de compra',
            'required|numeric'
        );

        $this->form_validation->set_rules(
            'precioventa',
            'Precio de venta',
            'required|numeric'
        );

        if ($this->form_validation->run() == FALSE)
        {
            $this->nuevo();
            return;
        }


        $claveprod = trim(
            $this->input->post(
                'claveprod',
                TRUE
            )
        );

        $descripcion = trim(
            $this->input->post(
                'descripcion',
                TRUE
            )
        );

        $idlinea = (int) $this->input->post(
            'idlinea',
            TRUE
        );

        $idprov = (int) $this->input->post(
            'proveedor',
            TRUE
        );

        $preciocompra = $this->input->post(
            'preciocompra',
            TRUE
        );

        $precioventa = $this->input->post(
            'precioventa',
            TRUE
        );


        // Comprobar línea
        $linea = $this->db
            ->where('idlinea', $idlinea)
            ->where(
                'estatus_linea',
                'ALTA'
            )
            ->get('linea')
            ->row();

        if (!$linea)
        {
            $this->session->set_flashdata(
                'error',
                'La línea seleccionada no existe o está inactiva.'
            );

            redirect('productos/nuevo');
            return;
        }


        // Comprobar proveedor
        $proveedor = $this->db
            ->where('idprov', $idprov)
            ->where(
                'estatusprov',
                'ALTA'
            )
            ->get('proveedores')
            ->row();

        if (!$proveedor)
        {
            $this->session->set_flashdata(
                'error',
                'El proveedor seleccionado no existe o está inactivo.'
            );

            redirect('productos/nuevo');
            return;
        }


        // Transacción
        $this->db->trans_start();


        // Producto
        $producto = array(
            'claveprod' =>
                $claveprod,

            'descripcion' =>
                $descripcion,

            'linea' =>
                $idlinea,

            'idprov' =>
                $idprov,

            'estatus_prod' =>
                'ALTA'
        );

        $this->db->insert(
            'productos',
            $producto
        );


        $idprod =
            $this->db->insert_id();


        // Precio
        $precio = array(
            'idprod' =>
                $idprod,

            'precioventa' =>
                $precioventa,

            'preciocompra' =>
                $preciocompra
        );

        $this->db->insert(
            'precios',
            $precio
        );


        // Stock inicial
        $stock = array(
            'idprod' =>
                $idprod,

            'stock' =>
                0
        );

        $this->db->insert(
            'stock',
            $stock
        );


        $this->db->trans_complete();


        if ($this->db->trans_status() === FALSE)
        {
            $this->session->set_flashdata(
                'error',
                'No se pudo guardar el producto.'
            );

            redirect(
                'productos/nuevo'
            );

            return;
        }


        $this->session->set_flashdata(
            'mensaje',
            'Producto agregado correctamente.'
        );

        redirect('productos');
    }


    // ==================================================
    // EDITAR PRODUCTO
    // ==================================================

    public function editar($id)
    {
        $data['titulo'] =
            'Modificar producto';

        $data['producto'] =
            $this->Producto_model->obtener(
                $id
            );

        if (!$data['producto'])
        {
            show_404();
            return;
        }


        $data['lineas'] = $this->db
            ->where(
                'estatus_linea',
                'ALTA'
            )
            ->order_by(
                'descripcion_linea',
                'ASC'
            )
            ->get('linea')
            ->result();


        $data['proveedores'] = $this->db
            ->where(
                'estatusprov',
                'ALTA'
            )
            ->order_by(
                'nombreprov',
                'ASC'
            )
            ->get('proveedores')
            ->result();


        $this->load->view(
            'layouts/header',
            $data
        );

        $this->load->view(
            'productos/form',
            $data
        );

        $this->load->view(
            'layouts/footer'
        );
    }


    // ==================================================
    // ACTUALIZAR PRODUCTO
    // ==================================================

    public function actualizar($id)
    {
        $this->form_validation->set_rules(
            'claveprod',
            'Clave del producto',
            'required|trim'
        );

        $this->form_validation->set_rules(
            'descripcion',
            'Descripción',
            'required|trim'
        );

        $this->form_validation->set_rules(
            'idlinea',
            'Línea',
            'required|integer'
        );

        $this->form_validation->set_rules(
            'proveedor',
            'Proveedor',
            'required|integer'
        );

        $this->form_validation->set_rules(
            'preciocompra',
            'Precio de compra',
            'required|numeric'
        );

        $this->form_validation->set_rules(
            'precioventa',
            'Precio de venta',
            'required|numeric'
        );


        if ($this->form_validation->run() == FALSE)
        {
            $this->editar($id);
            return;
        }


        $claveprod = trim(
            $this->input->post(
                'claveprod',
                TRUE
            )
        );

        $descripcion = trim(
            $this->input->post(
                'descripcion',
                TRUE
            )
        );

        $idlinea = (int) $this->input->post(
            'idlinea',
            TRUE
        );

        $idprov = (int) $this->input->post(
            'proveedor',
            TRUE
        );

        $preciocompra =
            $this->input->post(
                'preciocompra',
                TRUE
            );

        $precioventa =
            $this->input->post(
                'precioventa',
                TRUE
            );


        // Comprobar producto
        $productoExiste = $this->db
            ->where(
                'idprod',
                $id
            )
            ->get('productos')
            ->row();

        if (!$productoExiste)
        {
            show_404();
            return;
        }


        // Comprobar línea
        $linea = $this->db
            ->where(
                'idlinea',
                $idlinea
            )
            ->where(
                'estatus_linea',
                'ALTA'
            )
            ->get('linea')
            ->row();

        if (!$linea)
        {
            $this->session->set_flashdata(
                'error',
                'La línea seleccionada no existe o está inactiva.'
            );

            redirect(
                'productos/editar/' . $id
            );

            return;
        }


        // Comprobar proveedor
        $proveedor = $this->db
            ->where(
                'idprov',
                $idprov
            )
            ->where(
                'estatusprov',
                'ALTA'
            )
            ->get('proveedores')
            ->row();

        if (!$proveedor)
        {
            $this->session->set_flashdata(
                'error',
                'El proveedor seleccionado no existe o está inactivo.'
            );

            redirect(
                'productos/editar/' . $id
            );

            return;
        }


        $this->db->trans_start();


        // Producto
        $producto = array(
            'claveprod' =>
                $claveprod,

            'descripcion' =>
                $descripcion,

            'linea' =>
                $idlinea,

            'idprov' =>
                $idprov,

            'estatus_prod' =>
                (
                    $this->input->post(
                        'status_prod'
                    ) == '1'
                )
                    ? 'ALTA'
                    : 'BAJA'
        );


        $this->db
            ->where(
                'idprod',
                $id
            )
            ->update(
                'productos',
                $producto
            );


        // Precio
        $precio = array(
            'precioventa' =>
                $precioventa,

            'preciocompra' =>
                $preciocompra
        );


        $existe = $this->db
            ->where(
                'idprod',
                $id
            )
            ->get('precios')
            ->row();


        if ($existe)
        {
            $this->db
                ->where(
                    'idprod',
                    $id
                )
                ->update(
                    'precios',
                    $precio
                );
        }
        else
        {
            $precio['idprod'] =
                $id;

            $this->db->insert(
                'precios',
                $precio
            );
        }


        $this->db->trans_complete();


        if ($this->db->trans_status() === FALSE)
        {
            $this->session->set_flashdata(
                'error',
                'No se pudo actualizar el producto.'
            );

            redirect(
                'productos/editar/' . $id
            );

            return;
        }


        $this->session->set_flashdata(
            'mensaje',
            'Producto actualizado correctamente.'
        );

        redirect('productos');
    }


    // ==================================================
    // ELIMINAR PRODUCTO
    // ==================================================

    public function eliminar($id)
    {
        $producto = $this->db
            ->where(
                'idprod',
                $id
            )
            ->get('productos')
            ->row();


        if (!$producto)
        {
            $this->session->set_flashdata(
                'error',
                'El producto no existe.'
            );

            redirect('productos');
            return;
        }


        $this->db->trans_start();


        $this->db
            ->where(
                'idprod',
                $id
            )
            ->delete('precios');


        $this->db
            ->where(
                'idprod',
                $id
            )
            ->delete('stock');


        $this->db
            ->where(
                'idprod',
                $id
            )
            ->delete('productos');


        $this->db->trans_complete();


        if ($this->db->trans_status() === FALSE)
        {
            $this->session->set_flashdata(
                'error',
                'No se pudo eliminar el producto.'
            );
        }
        else
        {
            $this->session->set_flashdata(
                'mensaje',
                'Producto eliminado correctamente.'
            );
        }


        redirect('productos');
    }


    // ==================================================
    // PROVEEDORES
    // ==================================================

    public function proveedores()
    {
        $data['titulo'] =
            'Catálogo de proveedores';


        // Obtener proveedores mediante el modelo
        $data['proveedores'] =
            $this->Proveedor_model->catalogo();


        $this->load->view(
            'layouts/header',
            $data
        );

        $this->load->view(
            'proveedores/index',
            $data
        );

        $this->load->view(
            'layouts/footer'
        );
    }


    // ==================================================
    // NUEVO PROVEEDOR
    // ==================================================

    public function nuevo_proveedor()
    {
        $data['titulo'] =
            'Agregar proveedor';


        $this->load->view(
            'layouts/header',
            $data
        );

        $this->load->view(
            'proveedores/form',
            $data
        );

        $this->load->view(
            'layouts/footer'
        );
    }


    // ==================================================
    // GUARDAR PROVEEDOR
    // ==================================================

    public function guardar_proveedor()
    {
        $this->form_validation->set_rules(
            'nombreprov',
            'Nombre del proveedor',
            'required|trim'
        );

        $this->form_validation->set_rules(
            'apaternoprov',
            'Apellido paterno',
            'required|trim'
        );

        $this->form_validation->set_rules(
            'amaternoprov',
            'Apellido materno',
            'required|trim'
        );

        $this->form_validation->set_rules(
            'telprov',
            'Teléfono',
            'required|trim'
        );

        $this->form_validation->set_rules(
            'domprov',
            'Domicilio',
            'required|trim'
        );

        $this->form_validation->set_rules(
            'mailprov',
            'Correo electrónico',
            'required|valid_email|trim'
        );

        $this->form_validation->set_rules(
            'estatusprov',
            'Estado',
            'required'
        );


        if ($this->form_validation->run() == FALSE)
        {
            $this->nuevo_proveedor();
            return;
        }


        $datos = array(

            'nombreprov' =>
                trim(
                    $this->input->post(
                        'nombreprov',
                        TRUE
                    )
                ),

            'apaternoprov' =>
                trim(
                    $this->input->post(
                        'apaternoprov',
                        TRUE
                    )
                ),

            'amaternoprov' =>
                trim(
                    $this->input->post(
                        'amaternoprov',
                        TRUE
                    )
                ),

            'telprov' =>
                trim(
                    $this->input->post(
                        'telprov',
                        TRUE
                    )
                ),

            'domprov' =>
                trim(
                    $this->input->post(
                        'domprov',
                        TRUE
                    )
                ),

            'mailprov' =>
                trim(
                    $this->input->post(
                        'mailprov',
                        TRUE
                    )
                ),

            'estatusprov' =>
                $this->input->post(
                    'estatusprov',
                    TRUE
                )
        );


        $resultado =
            $this->Proveedor_model->insertar(
                $datos
            );


        if ($resultado)
        {
            $this->session->set_flashdata(
                'mensaje',
                'Proveedor registrado correctamente.'
            );
        }
        else
        {
            $this->session->set_flashdata(
                'error',
                'No se pudo registrar el proveedor.'
            );
        }


        redirect('proveedores');
    }


    // ==================================================
    // EDITAR PROVEEDOR
    // ==================================================

    public function editar_proveedor($id)
    {
        $proveedor =
            $this->Proveedor_model->obtener(
                $id
            );


        if (!$proveedor)
        {
            show_404();
            return;
        }


        $data['titulo'] =
            'Modificar proveedor';

        $data['proveedor'] =
            $proveedor;


        $this->load->view(
            'layouts/header',
            $data
        );

        $this->load->view(
            'proveedores/form',
            $data
        );

        $this->load->view(
            'layouts/footer'
        );
    }


    // ==================================================
    // ACTUALIZAR PROVEEDOR
    // ==================================================

    public function actualizar_proveedor($id)
    {
        $this->form_validation->set_rules(
            'nombreprov',
            'Nombre del proveedor',
            'required|trim'
        );

        $this->form_validation->set_rules(
            'apaternoprov',
            'Apellido paterno',
            'required|trim'
        );

        $this->form_validation->set_rules(
            'amaternoprov',
            'Apellido materno',
            'required|trim'
        );

        $this->form_validation->set_rules(
            'telprov',
            'Teléfono',
            'required|trim'
        );

        $this->form_validation->set_rules(
            'domprov',
            'Domicilio',
            'required|trim'
        );

        $this->form_validation->set_rules(
            'mailprov',
            'Correo electrónico',
            'required|valid_email|trim'
        );

        $this->form_validation->set_rules(
            'estatusprov',
            'Estado',
            'required'
        );


        if ($this->form_validation->run() == FALSE)
        {
            $this->editar_proveedor($id);
            return;
        }


        $datos = array(

            'nombreprov' =>
                trim(
                    $this->input->post(
                        'nombreprov',
                        TRUE
                    )
                ),

            'apaternoprov' =>
                trim(
                    $this->input->post(
                        'apaternoprov',
                        TRUE
                    )
                ),

            'amaternoprov' =>
                trim(
                    $this->input->post(
                        'amaternoprov',
                        TRUE
                    )
                ),

            'telprov' =>
                trim(
                    $this->input->post(
                        'telprov',
                        TRUE
                    )
                ),

            'domprov' =>
                trim(
                    $this->input->post(
                        'domprov',
                        TRUE
                    )
                ),

            'mailprov' =>
                trim(
                    $this->input->post(
                        'mailprov',
                        TRUE
                    )
                ),

            'estatusprov' =>
                $this->input->post(
                    'estatusprov',
                    TRUE
                )
        );


        $resultado =
            $this->Proveedor_model->actualizar(
                $id,
                $datos
            );


        if ($resultado)
        {
            $this->session->set_flashdata(
                'mensaje',
                'Proveedor actualizado correctamente.'
            );
        }
        else
        {
            $this->session->set_flashdata(
                'error',
                'No se pudo actualizar el proveedor.'
            );
        }


        redirect('proveedores');
    }


    // ==================================================
    // ELIMINAR PROVEEDOR
    // ==================================================

    public function eliminar_proveedor($id)
    {
        $proveedor =
            $this->Proveedor_model->obtener(
                $id
            );


        if (!$proveedor)
        {
            $this->session->set_flashdata(
                'error',
                'El proveedor no existe.'
            );

            redirect('proveedores');
            return;
        }


        // Verificar productos relacionados
        $productos = $this->db
            ->where(
                'idprov',
                $id
            )
            ->count_all_results(
                'productos'
            );


        if ($productos > 0)
        {
            // No eliminar físicamente
            $this->Proveedor_model->actualizar(
                $id,
                array(
                    'estatusprov' =>
                        'BAJA'
                )
            );


            $this->session->set_flashdata(
                'mensaje',
                'El proveedor tiene productos relacionados y fue marcado como inactivo.'
            );
        }
        else
        {
            $this->Proveedor_model->eliminar(
                $id
            );


            $this->session->set_flashdata(
                'mensaje',
                'Proveedor eliminado correctamente.'
            );
        }


        redirect('proveedores');
    }


    // ==================================================
    // STOCK
    // ==================================================

    public function stock()
    {
        $data['titulo'] =
            'Control de stock';


        $data['productos'] = $this->db
            ->select('
                productos.idprod,
                productos.claveprod,
                productos.descripcion,
                stock.stock
            ')
            ->from('productos')
            ->join(
                'stock',
                'stock.idprod = productos.idprod',
                'left'
            )
            ->where(
                'productos.estatus_prod',
                'ALTA'
            )
            ->order_by(
                'productos.idprod',
                'DESC'
            )
            ->get()
            ->result();


        $this->load->view(
            'layouts/header',
            $data
        );

        $this->load->view(
            'productos/stock',
            $data
        );

        $this->load->view(
            'layouts/footer'
        );
    }


    // ==================================================
    // ACTUALIZAR STOCK
    // ==================================================

    public function actualizar_stock()
    {
        $idprod =
            $this->input->post('idprod');

        $stock =
            $this->input->post('stock');


        if (
            !is_numeric($idprod) ||
            !is_numeric($stock)
        )
        {
            $this->session->set_flashdata(
                'error',
                'Los datos del stock no son válidos.'
            );

            redirect('stock');
            return;
        }


        $idprod =
            (int) $idprod;

        $stock =
            (int) $stock;


        if ($stock < 0)
        {
            $stock = 0;
        }


        $producto = $this->db
            ->where(
                'idprod',
                $idprod
            )
            ->get('productos')
            ->row();


        if (!$producto)
        {
            $this->session->set_flashdata(
                'error',
                'El producto no existe.'
            );

            redirect('stock');
            return;
        }


        $registro = $this->db
            ->where(
                'idprod',
                $idprod
            )
            ->get('stock')
            ->row();


        if ($registro)
        {
            $this->db
                ->where(
                    'idprod',
                    $idprod
                )
                ->update(
                    'stock',
                    array(
                        'stock' =>
                            $stock
                    )
                );
        }
        else
        {
            $this->db->insert(
                'stock',
                array(
                    'idprod' =>
                        $idprod,

                    'stock' =>
                        $stock
                )
            );
        }


        $this->session->set_flashdata(
            'mensaje',
            'Stock actualizado correctamente.'
        );


        redirect('stock');
    }
}
