<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio_controllers extends CI_Controller {

	public function index()
	{
		//$this->load->view('welcome_message');
	}
	public function Articulos()
	{
		$this->servicios_model->Articulos();
    }
    public function Clientes()
    {
        $this->servicios_model->Clientes();
    }
    public function vstCLA()
    {
        $this->servicios_model->vstCLA();
    }
    public function vtsArticulos()
    {
        $this->servicios_model->vtsArticulos();
    }
    public function vtsCliente()
    {
        $this->servicios_model->vtsCliente();
    }
    public function vtsTotales()
    {
        $this->servicios_model->vtsTotales();
    }
    public function MvstCLA()
    {
        $this->servicios_model->MvstCLA();
    }
    public function MvtsArticulos()
    {
        $this->servicios_model->MvtsArticulos();
    }
    public function MvtsCliente()
    {
        $this->servicios_model->MvtsCliente();
    }
   

}
