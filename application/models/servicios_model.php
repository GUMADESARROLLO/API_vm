<?php
class servicios_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function Login($usuario,$pass){
        $i=0;
        $rtnUsuario = array();

        $this->db->where('Usuario',$usuario);
        $this->db->where('Activo',"1");
        $this->db->where('Password',$pass);
        $query = $this->db->get('usuarios');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $rtnUsuario['results'][$i]['mUser'] = $key['Usuario'];
                $rtnUsuario['results'][$i]['mNamv'] = $key['Nombre_visitador'];
                $rtnUsuario['results'][$i]['mPass'] = $key['Password'];
            }
        }else{
            $rtnUsuario['results'][$i]['mUser'] = "";
        }
        echo json_encode($rtnUsuario);
    }
    public function Mcuotas($vendedor){
        $i=0;
        $rtnUsuario = array();

        $this->db->where('RUTA',$vendedor);
        $query = $this->db->get('cuotasmes');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $rtnUsuario['results'][$i]['mRuta'] = $key['RUTA'];
                $rtnUsuario['results'][$i]['mArti'] = $key['ARTICULO'];
                $rtnUsuario['results'][$i]['mDesc'] = $key['DESCRIPCION'];
                $rtnUsuario['results'][$i]['mCant'] = $key['CANTIDAD'];
                $i++;
            }
        }else{
            $rtnUsuario['results'][$i]['mUser'] = "";
        }
        echo json_encode($rtnUsuario);
    }
    public function Articulos()
    {
        $i=0;
        $arr = array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM vm_Articulos",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $arr['results'][$i]['mCod']     = $key['ARTICULO'];
            $arr['results'][$i]['mNam']     = $key['DESCRIPCION'];
            $arr['results'][$i]['mExi']     = number_format($key['total'],2,'.','');
            $arr['results'][$i]['mLab']     = $key['LABORATORIO'];
            $arr['results'][$i]['mUnd']     = $key['UNIDAD_ALMACEN'];
            $arr['results'][$i]['mPts']     = $key['PUNTOS'];
            $i++;
        }
        echo json_encode($arr);
        $this->sqlsrv->close();
    }
    public function Clientes($Vendedor)
    {
        $i=0;
        $arr=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM vm_Clientes WHERE VENDEDOR='".$Vendedor."'",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $arr['results'][$i]['mCod']     = $key['CLIENTE'];
            $arr['results'][$i]['mNam']     = $key['NOMBRE'];
            $arr['results'][$i]['mDir']     = $key['DIRECCION'];
            $arr['results'][$i]['mRuc']     = $key['RUC'];
            $i++;
        }
        echo json_encode($arr);
        $this->sqlsrv->close();
    }
    public function vstCLA()
    {
        $i=0;
        $arr=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM vm_3M_vstCLA",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $arr['results'][$i]['mRut']     = $key['RUTA'];
            $arr['results'][$i]['mCcl']     = $key['CCL'];
            $arr['results'][$i]['mArt']     = $key['ARTICULO'];
            $arr['results'][$i]['mDec']     = $key['DESCRIPCION'];
            $arr['results'][$i]['mDia']     = $key['Dia']->format('d-m-Y');
            $arr['results'][$i]['mCnt']     = number_format($key['Cantidad'],2);
            $arr['results'][$i]['mClf']     = $key['Clasificacion6'];
            $arr['results'][$i]['mVnt']     = number_format($key['Venta'],2);
            $i++;
        }
        echo json_encode($arr);
        $this->sqlsrv->close();
    }
    public function vtsArticulos($vendedor)
    {
        $i=0;
        $arr=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM vm_3M_vtsArticulos WHERE RUTA='".$vendedor."'",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $arr['results'][$i]['mRut']     = $key['RUTA'];
            $arr['results'][$i]['mArt']     = $key['ARTICULO'];
            $arr['results'][$i]['mDec']     = $key['DESCRIPCION'];
            $arr['results'][$i]['mClf']     = $key['Clasificacion6'];
            $arr['results'][$i]['mCnt']     = number_format($key['CANTIDAD'],2);
            $arr['results'][$i]['mVnt']     = number_format($key['Venta'],2);
            $arr['results'][$i]['mHts']     = $key['Hts'];
            $i++;
        }
        echo json_encode($arr);
        $this->sqlsrv->close();
    }
    public function vtsCliente($vendedor)
    {
        $i=0;
        $arr=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM vm_3M_vtsCliente WHERE RUTA='".$vendedor."'",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $arr['results'][$i]['mRut']     = $key['RUTA'];
            $arr['results'][$i]['mCcl']     = $key['CCL'];
            $arr['results'][$i]['mNam']     = $key['NOMBRE'];
            $arr['results'][$i]['mRuc']     = $key['RUC'];
            $arr['results'][$i]['mHts']     = $key['hts'];
            $arr['results'][$i]['mVnt']     = number_format($key['Venta'],2);
            $i++;
        }
        echo json_encode($arr);
        $this->sqlsrv->close();
    }
   /* public function vtsTotales()
    {
        $i=0;
        $arr=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM vm_3M_vtsTotales",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $arr['results'][$i]['mRut']     = $key['RUTA'];
            $arr['results'][$i]['mVnt']     = number_format($key['Venta'],2);

            $i++;
        }
        echo json_encode($arr);
        $this->sqlsrv->close();
    }*/
    public function MvstCLA($vendedor)
    {
        $i=0;
        $arr=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM vm_Mensuales_vstCLA WHERE RUTA='".$vendedor."'",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $arr['results'][$i]['mRut']     = $key['RUTA'];
            $arr['results'][$i]['mCcl']     = $key['CCL'];
            $arr['results'][$i]['mArt']     = $key['ARTICULO'];
            $arr['results'][$i]['mDec']     = $key['DESCRIPCION'];
            $arr['results'][$i]['mDia']     = $key['Dia']->format('d-m-Y');
            $arr['results'][$i]['mCnt']     = number_format($key['Cantidad'],2);
            $arr['results'][$i]['mClf']     = $key['Clasificacion6'];
            $arr['results'][$i]['mVnt']     = number_format($key['Venta'],2);
            $i++;
        }
        echo json_encode($arr);
        $this->sqlsrv->close();
    }
    public function MvtsArticulos($vendedor)
    {
        $i=0;
        $arr=array();
        $qMetas = $this->sqlsrv->fetchArray("SELECT * FROM vm_Mensuales_vtsTotales WHERE RUTA='".$vendedor."'",SQLSRV_FETCH_ASSOC);
        foreach($qMetas as $key){
            $arr['results'][$i]['mRut']     = $key['RUTA'];
            $arr['results'][$i]['mventa']   = number_format($key['Venta'],2);
            $arr['results'][$i]['mV3m']     = number_format($key['vst_3m'],2);            
            $arr['results'][$i]['mMeta']    = number_format($key['metas'],2);            

        }

        $i++;
        $qVstas = $this->sqlsrv->fetchArray("SELECT * FROM vm_Mensuales_vtsArticulos WHERE RUTA='".$vendedor."' ",SQLSRV_FETCH_ASSOC);
        foreach($qVstas as $key){
            $arr['results'][$i]['mRut']     = $key['RUTA'];
            $arr['results'][$i]['mArt']     = $key['ARTICULO'];
            $arr['results'][$i]['mDic']     = $key['DESCRIPCION'];
            $arr['results'][$i]['mClf']     = $key['Clasificacion6'];
            $arr['results'][$i]['mCnt']     = number_format($key['CANTIDAD'],2);
            $arr['results'][$i]['mVnt']     = number_format($key['Venta'],2);
            $arr['results'][$i]['mHts']     = $key['Hts'];
            $i++;
        }
        echo json_encode($arr);
        $this->sqlsrv->close();
    }
    public function MvtsCliente($vendedor)
    {
        $i=0;
        $arr=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM vm_Mensuales_vtsCliente WHERE RUTA='".$vendedor."'",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $arr['results'][$i]['mRut']     = $key['RUTA'];
            $arr['results'][$i]['mCcl']     = $key['CCL'];
            $arr['results'][$i]['mNam']     = $key['NOMBRE'];
            $arr['results'][$i]['mRuc']     = $key['RUC'];
            $arr['results'][$i]['mHts']     = $key['hts'];
            $arr['results'][$i]['mVnt']     = number_format($key['Venta'],2);
            $i++;
        }
        echo json_encode($arr);
        $this->sqlsrv->close();
    }
    public function HstItemFacturados($vendedor)
    {
        $i=0;
        $arr=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM vm_HstItemFacturados WHERE RUTA='".$vendedor."'",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $arr['results'][$i]['mCcl']     = $key['CCL'];
            $arr['results'][$i]['mArt']     = $key['ARTICULO'];
            $arr['results'][$i]['mDes']     = $key['DESCRIPCION'];
            $arr['results'][$i]['mCan']     = number_format($key['Cantidad'],2);
            $arr['results'][$i]['mVnt']     = number_format($key['Venta'],2);
            $i++;
        }
        echo json_encode($arr);
        $this->sqlsrv->close();
    }
}


