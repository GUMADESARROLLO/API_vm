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
        $this->servicios_model->guardandoCambiosFarmacia($_POST['mFarmacias']);
        $this->servicios_model->Farmacias($_POST['mVendedor']);
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
       // $this->servicios_model->ROUND();
    }

    public function Medicos()
    {
        //$this->servicios_model->Medicos($_POST['mVendedor']);
        echo '[{"m01":"3131313132132","m010":"","m011":"","m012":"","m013":"","m014":"","m016":"","m017":"","m018":"","m019":"","m02":"12/04/2018","m020":"","m03":"313213132132","m04":"78798798798798","m05":"","m06":"","m07":"","m08":"","m09":"","m21":"","m22":"","m23":"","m24":"","m25":"00/00/000","m26":"","m27":"","m28":"","m29":"","m30":"","m31":1,"m32":5,"mRuta":"F09","mUID":"F09-M2"}]';
    }
    public function Especialidades(){
        $this->servicios_model->Especialidades();
    }

    public function Logs(){
        //echo '[{"UID":"F09-R2","mCliente":"F09-M1","mFecha":1523651448814,"mLatitud":"12.1021467","mLogitud":"12.1021467","mRuta":"F09"},{"UID":"F09-R3","mCliente":"F09-M1","mFecha":1523651649543,"mLatitud":"12.1021558","mLogitud":"-86.2642666","mRuta":"F09"}]';
        date_default_timezone_set("America/Managua");
        $mil = 1523651448814;
        $seconds = $mil / 1000;
        echo date("Y-m-d H:i:s", $seconds);
    }

    /*ADD-UPDATE FARMACIA*/
    public function guardarCambiosFarmacia() {

        $this->servicios_model->guardandoCambiosFarmacia(json_decode($_POST['mFarmacias'],true));
    }
}
