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
        $this->servicios_model->Clientes($_POST['mVendedor']);
    }
    public function vstCLA()
    {
        $this->servicios_model->vstCLA($_POST['mVendedor']);
    }
    public function vtsArticulos()
    {
        $this->servicios_model->vtsArticulos($_POST['mVendedor']);
    }
    public function vtsCliente()
    {
        $this->servicios_model->vtsCliente($_POST['mVendedor']);
    }
   /* public function vtsTotales()
    {
        $this->servicios_model->vtsTotales();
    }*/
    public function MvstCLA()
    {
        $this->servicios_model->MvstCLA($_POST['mVendedor']);
    }
    public function MvtsArticulos()
    {
        $this->servicios_model->MvtsArticulos($_POST['mVendedor']);
    }
    public function MvtsCliente()
    {
        $this->servicios_model->MvtsCliente($_POST['mVendedor']);
    }
    public function Login(){
        $this->servicios_model->Login($_POST['mUser'],$_POST['mPassword']);
    }
    public function Mcuotas()
    {
        //$this->servicios_model->Mcuotas($_POST['mVendedor']);
        $this->servicios_model->Mcuotas("F03");
    }
    public function HstItemFacturados()
    {
        //$this->servicios_model->HstItemFacturados($_POST['mVendedor']);
        $this->servicios_model->HstItemFacturados("F09");
    }


}
