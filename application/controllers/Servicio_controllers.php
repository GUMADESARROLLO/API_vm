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
    public function Farmacias(){
        $this->servicios_model->Farmacias("F09");
        /*$cobros = '[{"mCCO":0,"mCDP":"10","mDIR":"ADMINISTRACION DE RENTA 6 AL SUR","mDPF":"Lunes , Martes","mEBD":0,"mFAN":"","mHAT":"DE LUNES A VIERNES","mNDM":"2","mNFR":"NOMBRE DE FARMACIA","mNPR":"NOMBRE DE PROPIETARIO","mPCP":"1000","mPIP":1,"mPPP":1,"mRCJ":"MRYAN ESPINOZA","mRCP":"MARYAN ESPINOZA","mRVC":"MARYAN ESPINOZA","mTFR":"82449100","mTRC":"82449100","mUID":"0"}]

';
        echo $cobros;*/
      
    }
    public function MvtsCliente()
    {
        $this->servicios_model->MvtsCliente($_POST['mVendedor']);
    }
    public function Llaves()
    {
        $this->servicios_model->Llaves($_POST['mVendedor'],$_POST['mFarmacias'],$_POST['mMedicos']);
    }
    public function Login(){
        $this->servicios_model->Login($_POST['mUser'],$_POST['mPassword']);
    }
    public function Mcuotas()
    {
        $this->servicios_model->Mcuotas($_POST['mVendedor']);
        //$this->servicios_model->Mcuotas("F03");
    }
    public function HstItemFacturados()
    {
        $this->servicios_model->HstItemFacturados($_POST['mVendedor']);
        
    }
    public function LOTES()
    {
        $this->servicios_model->LOTES();
    }
    public function PUNTOS()
    {
        $this->servicios_model->FacturaPuntos($_POST['mVendedor']);
    }

    /*ADD-UPDATE FARMACIA*/
    public function guardarCambiosFarmacia() {
        $this->servicios_model->guardandoCambiosFarmacia(json_decode($_POST['data'],true));
    }
}
