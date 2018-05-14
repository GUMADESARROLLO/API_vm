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
        $this->servicios_model->vstCLA($_POST['mVendedor'],$_POST['mUID']);
    }
    public function vtsArticulos()
    {
        $this->servicios_model->vtsArticulos($_POST['mVendedor'],$_POST['mUID']);
    }
    public function vtsCliente()
    {
        $this->servicios_model->vtsCliente($_POST['mVendedor'],$_POST['mUID']);
    }
   /* public function vtsTotales()
    {
        $this->servicios_model->vtsTotales();
    }*/
    public function MvstCLA()
    {
        $this->servicios_model->MvstCLA($_POST['mVendedor'],$_POST['mUID']);
    }
    public function MvtsArticulos()
    {
        $this->servicios_model->MvtsArticulos($_POST['mVendedor'],$_POST['mUID']);
        //$this->servicios_model->MvtsArticulos("'F03','F13'","VM07");

    }
    public function Farmacias(){
        $this->servicios_model->guardandoCambiosFarmacia($_POST['mFarmacias']);
        $this->servicios_model->Farmacias($_POST['mVendedor']);
    }
    public function MvtsCliente()
    {
        $this->servicios_model->MvtsCliente($_POST['mVendedor'],$_POST['mUID']);
    }
    public function Llaves()
    {
        $this->servicios_model->Llaves($_POST['mVendedor'],$_POST['mJsonLlaves']);
    }

    public function UpdateLlaves()
    {
        $this->servicios_model->UpdateLlaves($_POST['mVendedor'],$_POST['mFarmacias'],$_POST['mMedicos'],$_POST['mReportes']);
    }
    public function Login(){
        $this->servicios_model->Login($_POST['mUser'],$_POST['mPassword']);
        //$this->servicios_model->Login("VM02","AQ4769");
    }
    public function Mcuotas()
    {
        $this->servicios_model->Mcuotas($_POST['mVendedor'],$_POST['mUID']);
        //$this->servicios_model->Mcuotas("'F03','F13'","VM07");
    }
    public function HstItemFacturados()
    {
        $this->servicios_model->HstItemFacturados($_POST['mVendedor'],$_POST['mUID']);
    }
    public function DeleteFarmacia()
    {
        $this->servicios_model->DeleteFarmacia($_POST['mID']);
    }
    public function DeleteMedicos()
    {
        $this->servicios_model->DeleteMedicos($_POST['mID']);
    }
    public function LOTES()
    {
        $this->servicios_model->LOTES();
    }
    public function PUNTOS()
    {
        $this->servicios_model->FacturaPuntos($_POST['mVendedor']);
    }

    public function ROUND()
    {
        //$this->servicios_model->ROUND();
    }

    public function Medicos()
    {
        $this->servicios_model->guardandoCambiosMedicos($_POST['mJSONMedicos']);
        $this->servicios_model->Medicos($_POST['mVendedor']);
    }
    public function Especialidades(){
        $this->servicios_model->Especialidades();
    }

    public function Logs(){
        $this->servicios_model->logs($_POST['mLogs'],$_POST['mLogsDetalles']);
    }

    /*ADD-UPDATE FARMACIA*/
    public function guardarCambiosFarmacia() {
        $this->servicios_model->guardandoCambiosFarmacia(json_decode($_POST['mFarmacias'],true));
    }

    /*ADD-UPDATE MEDICOS*/
    public function guardarCambiosMedicos() {
        $this->servicios_model->guardandoCambiosMedicos(json_decode($_POST['mMedicos'],true));
    }
}
