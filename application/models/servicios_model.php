<?php
class servicios_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public $CONDICION = '2015-06-01';
    public function Login($usuario,$pass){
        $i=0;
        $rtnUsuario = array();

        $this->db->where('Usuario',$usuario);
        $this->db->where('Activo',"1");
        $this->db->where('Password',$pass);
        $query = $this->db->get('usuarios');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $rtnUsuario['results'][$i]['mUID'] = $key['IdUser'];
                $rtnUsuario['results'][$i]['mUser'] = $key['Usuario'];
                $rtnUsuario['results'][$i]['mNamv'] = $key['Nombre_visitador'];
                $rtnUsuario['results'][$i]['mPass'] = $key['Password'];
                $rtnUsuario['results'][$i]['mRutas'] = $key['Rutas'];
            }
        }else{
            $rtnUsuario['results'][$i]['mUser'] = $query->num_rows();
        }
        echo json_encode($rtnUsuario);
    }

    public function ROUND(){
        $i=0;
        $rtnUsuario = array();
        $query = $this->db->get('cuotasmes');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $this->db->where('RUTA', $key['RUTA']);
                $this->db->where('ARTICULO', $key['ARTICULO']);
                $this->db->update('cuotasmes', array(
                    'VALOR' => $this->getRound($key['VALOR'])
                ));
                $rtnUsuario['results'][$i]['mRuta'] = $key['RUTA'];
                $rtnUsuario['results'][$i]['mArti'] = $key['ARTICULO'];
                $rtnUsuario['results'][$i]['mDesc'] = $key['DESCRIPCION'];
                $rtnUsuario['results'][$i]['mCant'] = $this->getRound($key['VALOR']);
                $i++;                
            }
        }else{
            $rtnUsuario['results'][$i]['mUser'] = $query->num_rows();
        }
        echo json_encode($rtnUsuario);
    }
    public function Especialidades(){
        $i=0;
        $rtnUsuario = array();
        $query = $this->db->get('especialidad');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $rtnUsuario['results'][$i]['mUID'] = $key['IdEspecialidad'];
                $rtnUsuario['results'][$i]['mName'] = $key['Especialidad'];
                $i++;
            }
        }else{
            $rtnUsuario['results'][$i]['mUID'] = $query->num_rows();
        }
        echo json_encode($rtnUsuario);
    }
    function getRound($cantidad){        
        $query = $this->db->query("SELECT ROUND($cantidad, 0) valor");
        foreach ($query->result() as $row){
            return $row->valor;
        }

        return $cantidad;
    }

    public function Llaves($Vendedor,$keys){
        $i=0;
        $rtnUsuario = array();

        foreach(json_decode($keys, true) as $key){
            $this->db->where('Ruta', $key['mRut']);
            $this->db->update('llaves', array(
                'FARMACIA' => $key['mFar'],
                'MEDICOS' => $key['mMed'],
                'REPORTE'=> $key['mRpt']
            ));
        }

        $this->db->where('Ruta',$Vendedor);
        $query = $this->db->get('llaves');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $rtnUsuario['results'][$i]['mRut'] = $key['Ruta'];
                $rtnUsuario['results'][$i]['mFar'] = $key['FARMACIA'];
                $rtnUsuario['results'][$i]['mMed'] = $key['MEDICOS'];
                $rtnUsuario['results'][$i]['mRpt'] = $key['REPORTE'];
            }
        }else{
            $rtnUsuario['results'][$i]['mUser'] = $query->num_rows();
        }


        echo json_encode($rtnUsuario);
    }
    public function UpdateLlaves($Vendedor,$Farmacias,$Medicos,$Reportes){
        $this->db->where('Ruta', $Vendedor);
        $result = $this->db->update('llaves', array(
            'FARMACIA' => $Farmacias,
            'MEDICOS' => $Medicos,
            'REPORTE'=> $Reportes
        ));
        if ($result) {
            echo "OK";
        }



    }
    public function Farmacias($Ruta){
        $i=0;
        $arr = array();
        $this->db->where('Ruta',$Ruta);
        $query = $this->db->get('farmacias');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $arr['results'][$i]['mUID'] = $key['IdFarmacia'];
                $arr['results'][$i]['mNFR'] = $key['NombreFarmacia'];
                $arr['results'][$i]['mNPR'] = $key['NombrePropietario'];
                $arr['results'][$i]['mDIR'] = $key['Direccion'];
                $arr['results'][$i]['mFAN'] = $key['FechaAniversario'];
                $arr['results'][$i]['mTFR'] = $key['TelfFarmacia'];
                $arr['results'][$i]['mTFP'] = $key['TelfPropietario'];
                $arr['results'][$i]['mHAT'] = $key['HorarioAtencion'];
                $arr['results'][$i]['mRCP'] = $key['ResponsableCompra'];
                $arr['results'][$i]['mTRC'] = $key['TelfRespCompra'];
                $arr['results'][$i]['mCDP'] = $key['CantDependiente'];
                $arr['results'][$i]['mPCP'] = $key['PotencialMensualCompra'];
                $arr['results'][$i]['mDPF'] = $key['DiasPagoFact'];
                $arr['results'][$i]['mRVC'] = $key['RespVencidos'];
                $arr['results'][$i]['mRCJ'] = $key['RespCanjes'];
                $arr['results'][$i]['mNDM'] = $key['NumDepMostrador'];
                $arr['results'][$i]['mPPP'] = $key['PartProgPuntos'];
                $arr['results'][$i]['mEBD'] = $key['EntregaBenefDepend'];
                $arr['results'][$i]['mPIP'] = $key['PermiteImpulsadoras'];
                $arr['results'][$i]['mCCO'] = $key['CadenaCooperativa'];
                $arr['results'][$i]['Ruta'] = $key['Ruta'];
                $arr['results'][$i]['mCommit'] = $key['cCommit'];
                $i++;
            }
        }else{
            $arr['results'][$i]['mUID'] = "0";
        }
        echo json_encode($arr);
    }
    public function Medicos($Ruta){
        $i=0;
        $arr = array();
        $this->db->where('Ruta',$Ruta);
        $query = $this->db->get('medicos');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $arr['results'][$i]['mUID']  = $key['IdMedico'];
                $arr['results'][$i]['m01']   = $key['NombreMedico'];
                $arr['results'][$i]['m02']   = $key['FNacimiento'];
                $arr['results'][$i]['m03']   = $key['Direccion'];
                $arr['results'][$i]['m04']   = $key['TelfClinica'];
                $arr['results'][$i]['m05']   = $key['Celular'];
                $arr['results'][$i]['m06']   = $key['Email'];

                $arr['results'][$i]['m07']   = $key['OLBAMedica'];
                $arr['results'][$i]['m08']   = $key['DeportePractica'];
                $arr['results'][$i]['m09']   = $key['Pasatiempo'];
                $arr['results'][$i]['m10']   = $key['SMParticipa'];

                $arr['results'][$i]['m11']   = $key['AUGraduacion'];
                $arr['results'][$i]['m12']   = $key['NEPSPrivado'];
                $arr['results'][$i]['m13']   = $key['MCMFrecuente'];
                $arr['results'][$i]['m14']   = $key['CConsulta'];

                $arr['results'][$i]['m15']   = $key['MCelular'];

                $arr['results'][$i]['m16']   = $key['SocioClinica'];
                $arr['results'][$i]['m17']   = $key['MCelular'];
                $arr['results'][$i]['m18']   = $key['MVehiculo'];
                $arr['results'][$i]['m19']   = $key['MReloj'];
                $arr['results'][$i]['m20']   = $key['MComputadora'];

                $arr['results'][$i]['m21']   = $key['NombreAsis'];
                $arr['results'][$i]['m22']   = $key['TExtensionAsis'];
                $arr['results'][$i]['m23']   = $key['CelularAsis'];
                $arr['results'][$i]['m24']   = $key['EmailAsis'];
                $arr['results'][$i]['m25']   = $key['FNacimientoAsis'];
                $arr['results'][$i]['m26']   = $key['ComputadoraAsis'];

                $arr['results'][$i]['m27']   = $key['Facebook'];
                $arr['results'][$i]['m28']   = $key['Twitter'];
                $arr['results'][$i]['m29']   = $key['Linkedin'];
                $arr['results'][$i]['m30']   = $key['Instagram'];

                $arr['results'][$i]['m31']   = $key['PFarmacia'];
                $arr['results'][$i]['m32']   = $key['Especialidad'];

                $arr['results'][$i]['mRuta'] = $key['Ruta'];
                $arr['results'][$i]['mCommit'] = $key['cCommit'];
                $i++;
            }
        }else{
            $arr['results'][$i]['mUID'] = "0";
        }
        echo json_encode($arr);
    }

    public function Mcuotas($vendedor,$UID){
        $in_where = explode(",", str_replace(array("'"), "", $vendedor));

        $i=0;
        $rtnUsuario = array();
        $this->db->select('ARTICULO, DESCRIPCION');
        $this->db->select_sum('CANTIDAD');
        $this->db->where_in('RUTA',$in_where);
        $this->db->group_by("ARTICULO");
        $query = $this->db->get('cuotasmes');
       // echo $this->db->last_query();;




        $rtnUsuario['results'][$i]['mRuta'] = $UID;
        $rtnUsuario['results'][$i]['mArti'] = "";
        $rtnUsuario['results'][$i]['mDesc'] = "";
        $rtnUsuario['results'][$i]['mCant'] = "";
        $rtnUsuario['results'][$i]['mCnAc'] = "";

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $rtnUsuario['results'][$i]['mRuta'] = $UID;
                $rtnUsuario['results'][$i]['mArti'] = $key['ARTICULO'];
                $rtnUsuario['results'][$i]['mDesc'] = $key['DESCRIPCION'];
                $rtnUsuario['results'][$i]['mCant'] = $key['CANTIDAD'];
                $rtnUsuario['results'][$i]['mCnAc'] = $this->Lleva($key['ARTICULO'],$vendedor);
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

        $arr['results'][$i]['mCod']     = "";
        $arr['results'][$i]['mNam']     = "";
        $arr['results'][$i]['mExi']     = 0;
        $arr['results'][$i]['mLab']     = "";
        $arr['results'][$i]['mUnd']     = "";
        $arr['results'][$i]['mPts']     = "";
        $arr['results'][$i]['mRgl']     = "";

        foreach($query as $key){
            $arr['results'][$i]['mCod']     = $key['ARTICULO'];
            $arr['results'][$i]['mNam']     = $key['DESCRIPCION'];
            $arr['results'][$i]['mExi']     = number_format($key['total'],2,'.','');
            $arr['results'][$i]['mLab']     = $key['LABORATORIO'];
            $arr['results'][$i]['mUnd']     = $key['UNIDAD_ALMACEN'];
            $arr['results'][$i]['mPts']     = $key['PUNTOS'] . " Precio: " . number_format($key['PRECIO'],2,'.','');
            $arr['results'][$i]['mRgl']     = $key['REGLAS'];
            $i++;
        }
        echo json_encode($arr);
        $this->sqlsrv->close();
    }

    public function Lleva($Articulo,$Ruta){
       $Cantidad="0";
       
        $query = $this->sqlsrv->fetchArray("SELECT SUM(Cantidad) AS Cantidad FROM vm_Mensuales_vstCLA WHERE RUTA in (".$Ruta.") AND ARTICULO='".$Articulo."' GROUP BY ARTICULO",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $retVal = ($key['Cantidad']=="") ? "0" : $key['Cantidad'] ;
            $Cantidad     = number_format($retVal,0);            
        }       
        
        return $Cantidad;

    }
    public function Clientes($Vendedor)
    {
        $i=0;
        $arr=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM vm_Clientes WHERE VENDEDOR IN (".$Vendedor.")",SQLSRV_FETCH_ASSOC);

        $arr['results'][$i]['mCod']     = "";
        $arr['results'][$i]['mNam']     = "";
        $arr['results'][$i]['mDir']     = "";
        $arr['results'][$i]['mRuc']     = "";

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
    public function vstCLA($VENDEDOR)
    {
        $i=0;
        $arr=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM vm_3M_vstCLA  where RUTA IN (".$VENDEDOR.")",SQLSRV_FETCH_ASSOC);

        $arr['results'][$i]['mRut']     = "";
        $arr['results'][$i]['mCcl']     = "";
        $arr['results'][$i]['mArt']     = "";
        $arr['results'][$i]['mDec']     = "";
        $arr['results'][$i]['mDia']     = "";
        $arr['results'][$i]['mCnt']     = 0;
        $arr['results'][$i]['mClf']     = "";
        $arr['results'][$i]['mVnt']     = "";

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
    public function vtsArticulos($vendedor,$UID)
    {
        $i=0;
        $arr=array();

        $query = $this->sqlsrv->fetchArray("SELECT ARTICULO,DESCRIPCION,Clasificacion6,SUM(CANTIDAD) AS CANTIDAD,SUM(Venta) as Venta,SUM(Hts) as Hts FROM vm_3M_vtsArticulos WHERE RUTA IN (".$vendedor.") GROUP BY ARTICULO,DESCRIPCION,Clasificacion6",SQLSRV_FETCH_ASSOC);

        $arr['results'][$i]['mRut']     = $UID;
        $arr['results'][$i]['mArt']     = "";
        $arr['results'][$i]['mDec']     = "";
        $arr['results'][$i]['mClf']     = "";
        $arr['results'][$i]['mCnt']     = 0;
        $arr['results'][$i]['mVnt']     = 0;
        $arr['results'][$i]['mHts']     = "";

        foreach($query as $key){
            $arr['results'][$i]['mRut']     = $UID;
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
    public function vtsCliente($vendedor,$uid)
    {
        $i=0;
        $arr=array();
        $query = $this->sqlsrv->fetchArray("SELECT CCL,NOMBRE,RUC,SUM(hts) AS hts,SUM(Venta) as Venta FROM vm_3M_vtsCliente WHERE RUTA IN (".$vendedor.") GROUP BY CCL,NOMBRE,RUC",SQLSRV_FETCH_ASSOC);

        $arr['results'][$i]['mRut']     = $uid;
        $arr['results'][$i]['mCcl']     = "";
        $arr['results'][$i]['mNam']     = "";
        $arr['results'][$i]['mRuc']     = "";
        $arr['results'][$i]['mHts']     = "";
        $arr['results'][$i]['mVnt']     = 0;

        foreach($query as $key){
            $arr['results'][$i]['mRut']     = $uid;
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
        $query = $this->sqlsrv->fetchArray("SELECT * FROM vm_Mensuales_vstCLA WHERE RUTA IN (".$vendedor.") ORDER BY Dia DESC",SQLSRV_FETCH_ASSOC);

        $arr['results'][$i]['mRut']     = $vendedor;
        $arr['results'][$i]['mCcl']     = "";
        $arr['results'][$i]['mNcl']     = "";
        $arr['results'][$i]['mArt']     = "";
        $arr['results'][$i]['mDec']     = "";
        $arr['results'][$i]['mDia']     = "";
        $arr['results'][$i]['mCnt']     = 0;
        $arr['results'][$i]['mClf']     = "";
        $arr['results'][$i]['mVnt']     = 0;

        foreach($query as $key){
            $arr['results'][$i]['mRut']     = $key['RUTA'];
            $arr['results'][$i]['mCcl']     = $key['CCL'];
            $arr['results'][$i]['mNcl']     = $key['NOMBRECL'];
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
    function Suma_meta($vendedor){
        $in_where = explode(",", str_replace(array("'"), "", $vendedor));
        $Rtn="0";
        $this->db->select('VALOR');
        $this->db->select_sum('VALOR');
        $this->db->where_in('RUTA',$in_where);
        $query = $this->db->get('cuotasmes');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $Rtn = $key['VALOR'];
            }
        }else{
            $Rtn = "";
        }
        return $Rtn;
    }
    public function MvtsArticulos($vendedor,$mUID)
    {
        $i=0;
        $arr=array();
        $qMetas = $this->sqlsrv->fetchArray("SELECT SUM(Venta) as Venta,sum(metas) as metas,sum(vst_3m) as vst_3m FROM vm_Mensuales_vtsTotales  WHERE RUTA IN(".$vendedor.")",SQLSRV_FETCH_ASSOC);

        $arr['results'][$i]['mRut']     = $vendedor;
        $arr['results'][$i]['mventa']   = 0;
        $arr['results'][$i]['mV3m']     = 0;
        $arr['results'][$i]['mMeta']    = 0;

        foreach($qMetas as $key){
            $arr['results'][$i]['mRut']     = $mUID;
            $arr['results'][$i]['mventa']   = number_format($key['Venta'],2);
            $arr['results'][$i]['mV3m']     = number_format($key['vst_3m'],2);            
            //$arr['results'][$i]['mMeta']    = number_format($key['metas'],2);
            $arr['results'][$i]['mMeta']    = number_format($this->Suma_meta($vendedor),2);
        }

        $i++;
        $qVstas = $this->sqlsrv->fetchArray("SELECT ARTICULO,DESCRIPCION,Clasificacion6,sum(CANTIDAD) as CANTIDAD,sum(Venta) as Venta,sum(Hts) as Hts FROM vm_Mensuales_vtsArticulos WHERE RUTA IN(".$vendedor.") GROUP BY ARTICULO,DESCRIPCION,Clasificacion6",SQLSRV_FETCH_ASSOC);

        $arr['results'][$i]['mRut']     = $mUID;
        $arr['results'][$i]['mArt']     = "";
        $arr['results'][$i]['mDic']     = "";
        $arr['results'][$i]['mClf']     = "";
        $arr['results'][$i]['mCnt']     = 0;
        $arr['results'][$i]['mVnt']     = 0;
        $arr['results'][$i]['mHts']     = "";

        foreach($qVstas as $key){
            $arr['results'][$i]['mRut']     = $mUID;
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
    public function MvtsCliente($vendedor,$UID)
    {
        $i=0;
        $arr=array();
        $query = $this->sqlsrv->fetchArray("SELECT CCL,NOMBRE,RUC,SUM(hts) as hts,sum(Venta) as Venta FROM vm_Mensuales_vtsCliente WHERE RUTA IN (".$vendedor.") GROUP BY CCL,NOMBRE,RUC",SQLSRV_FETCH_ASSOC);

        $arr['results'][$i]['mRut']     = $UID;
        $arr['results'][$i]['mCcl']     = "";
        $arr['results'][$i]['mNam']     = "";
        $arr['results'][$i]['mRuc']     = "";
        $arr['results'][$i]['mHts']     = "";
        $arr['results'][$i]['mVnt']     = 0;

        foreach($query as $key){
            $arr['results'][$i]['mRut']     = $UID;
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
    public function HstItemFacturados($vendedor,$UID)
    {

        $i=0;
        $arr=array();
        $query = $this->sqlsrv->fetchArray("SELECT ARTICULO,DESCRIPCION,CCL,SUM(Cantidad) as Cantidad,Sum(Venta) as Venta FROM vm_HstItemFacturados WHERE RUTA in (".$vendedor.") GROUP BY ARTICULO,DESCRIPCION,CCL",SQLSRV_FETCH_ASSOC);

        $arr['results'][$i]['mCcl']     = $UID;
        $arr['results'][$i]['mArt']     = "";
        $arr['results'][$i]['mDes']     = "";
        $arr['results'][$i]['mCan']     = 0;
        $arr['results'][$i]['mVnt']     = 0;

        foreach($query as $key){
            $arr['results'][$i]['mCcl']     = $UID;
            $arr['results'][$i]['mArt']     = $key['ARTICULO'];
            $arr['results'][$i]['mDes']     = $key['DESCRIPCION'];
            $arr['results'][$i]['mCan']     = number_format($key['Cantidad'],2);
            $arr['results'][$i]['mVnt']     = number_format($key['Venta'],2);
            $i++;
        }
        echo json_encode($arr);
        $this->sqlsrv->close();
    }
    public function LOTES()
    {
        $i=0;
        $arr=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM vm_Lotes",SQLSRV_FETCH_ASSOC);

        $arr['results'][$i]['mArt']     = "";
        $arr['results'][$i]['mLot']     = "";
        $arr['results'][$i]['mFvc']     = "";
        $arr['results'][$i]['mCds']     = 0;

        foreach($query as $key){
            $arr['results'][$i]['mArt']     = $key['ARTICULO'];
            $arr['results'][$i]['mLot']     = $key['LOTE'];
            $arr['results'][$i]['mFvc']     = $key['FECHA_VENCIMIENTO'];
            $arr['results'][$i]['mCds']     = number_format($key['CANT_DISPONIBLE'],2);
            $i++;
        }
        echo json_encode($arr);
        $this->sqlsrv->close();
    }
    public function FacturaPuntos($Vendedor)
    {
        $i=0;
        $rtnCliente=array();
        $query = $this->sqlsrv->fetchArray("SELECT CLIENTE,FECHA,FACTURA,SUM(TT_PUNTOS) AS TOTAL,RUTA FROM vtVS2_Facturas_CL WHERE RUTA IN (".$Vendedor.")
                        GROUP BY FACTURA,FECHA,RUTA,CLIENTE",SQLSRV_FETCH_ASSOC);

        $rtnCliente['results'][$i]['mFch']  = "";
        $rtnCliente['results'][$i]['mClt']  = "";
        $rtnCliente['results'][$i]['mFct']  = "";
        $rtnCliente['results'][$i]['mPnt']  = 0;
        $rtnCliente['results'][$i]['mRmT']  = "";

        foreach($query as $key){
            $Remanente = number_format($this->FacturaSaldo($key['FACTURA'],$key['TOTAL']),2,'.','');
            if (intval($Remanente) > 0.00 ) {
                $rtnCliente['results'][$i]['mFch']  = $key['FECHA']->format('Y-m-d');
                $rtnCliente['results'][$i]['mClt']  = $key['CLIENTE'];
                $rtnCliente['results'][$i]['mFct']  = $key['FACTURA'];
                $rtnCliente['results'][$i]['mPnt']  = number_format($key['TOTAL'],2,'.','');
                $rtnCliente['results'][$i]['mRmT']  = $Remanente;
                $i++;
            }
        }
        echo json_encode($rtnCliente);
        $this->sqlsrv->close();
    }
    public function FacturaSaldo($id,$pts){
        $this->db->where('Factura',$id);
        $this->db->select('Puntos');
        $query = $this->db->get('visys.rfactura');
        if($query->num_rows() > 0){
            $parcial = $query->result_array()[0]['Puntos'];
        } else {
            $parcial = $pts;
        }
        return $parcial;
    }

    function getDate($Time){
        date_default_timezone_set("America/Managua");
        $mil = $Time ;
        $seconds = $mil / 1000;
        return date("Y-m-d H:i:s", $seconds);
    }


    public function logs($d1,$d2) {
        $result=false;
        if (count($d1)>0) {
            foreach(json_decode($d1, true) as $key){
                $result =  $this->db->insert('log', array(
                    'IdLog' => $key['UID'],
                    'Latitud' => $key['mLatitud'],
                    'Longitud' => $key['mLogitud'],
                    'Descripcion' => $key['mComentario'],
                    'Cliente' => $key['mCliente'],
                    'CLNombre' => $key['Name'],
                    'Fecha' => $this->getDate($key['mFecha']),
                    'Ruta' => $key['mRuta']
                ));

            }
            if (count($d1)>0) {
                foreach(json_decode($d2, true) as $key){
                    $result=   $this->db->insert('detallelog', array(
                        'Articulo' => $key['Articulos'],
                        'Descripcion' => $key['Descrp'],
                        'Cantidad' => $key['Cantidad'],
                        'IdLog' => $key['ID']
                    ));
                }
            }

        }


            echo $result;




    }

    /*ADD-UPDATE FARMACIA*/
    public function guardandoCambiosFarmacia($data) {
        if (count($data)>0) {
            foreach(json_decode($data, true) as $key){
                $fecha = date('Y-m-d', strtotime($key['mFAN']));
                $result = $this->db->query("call sp_farmacias('".$key['mUID']."','".$key['mNFR']."','".$key['mNPR']."','".$key['mDIR']."','".$fecha."','".$key['mTFR']."','".$key['mTFP']."','".$key['mHAT']."','".$key['mRCP']."','".$key['mTRC']."','".$key['mCDP']."','".$key['mPCP']."','".$key['mDPF']."','".$key['mRVC']."','".$key['mRCJ']."','".$key['mNDM']."',".$key['mPPP'].",".$key['mEBD'].",".$key['mPIP'].",".$key['mCCO'].",'".$key['Ruta']."','".$key['mCommit']."')");
            }
        }
    }


    /*ADD-UPDATE MEDICOS*/
        public function guardandoCambiosMedicos($data) {
        if (count($data)>0) {
            foreach (json_decode($data, true) as $key){
                $Sub=0;
                $f1 = date('Y-m-d', strtotime(str_replace('/', '-', $key['m02'])));
                $f2 = date('Y-m-d', strtotime(str_replace('/', '-', $key['m25'])));


                $result = $this->db->query("call sp_medicos(
                '".$key['mUID']./*IdMedico*/"',
                '".$key['m01']./*Nombre medico*/"',
                '".$f1./*Fecha nacimiento*/"',
                '".$key['m32']./*Especialidad*/"',
                '".$Sub./*Sub especialidad*/"',
                '".$key['m03']./*Direccion*/"',
                '".$key['m04']./*Telefono Clinica*/"',
                '".$key['m05']./*Celular*/"',
                '".$key['m06']./*Email*/"',
                '".$key['m011']./*Año y uni de graduacion*/"',
                '".$key['m012']./*Numero Paciente Estimado*/"',
                '".$key['m013']./*Motivo consulta frecuente*/"',
                '".$key['m014']./*Costo consulta*/"',
                ".$key['m31']./*Propietario farmacia*/",
                '".$key['m016']./*Socio clinica*/"',
                '".$key['m017']./*Marca celular*/"',
                '".$key['m018']./*Marca vehiculo*/"',
                '".$key['m019']./*Marca reloj*/"',
                '".$key['m020']./*Marca computadora*/"',
                '".$key['m21']./*Nombre asistente*/"',
                '".$key['m22']./*Telef extension asistente*/"',
                '".$key['m23']./*Celular asistente*/"',
                '".$key['m24']./*Email asistente*/"',
                '".$f2./*Fecha nacimiento asistente*/"',
                '".$key['m26']./*Computadora asistente*/"',
                '".$key['m07']./*OLBA medica*/"',
                '".$key['m08']./*Deporte practica*/"',
                '".$key['m09']./*Pasatiempo*/"',
                '".$key['m010']./*Sociedad medica participa*/"',
                '".$key['m27']./*Facebook*/"',
                '".$key['m28']./*Twitter*/"',
                '".$key['m29']./*Linkedin*/"',
                '".$key['m30']./*Instagram*/"',
                '".$key['mRuta']./*Ruta*/"',
                '".$key['mCommit']./*Comentarios*/"')");
            }
        }



    }
    public function DeleteFarmacia($uID){
        $result = $this->db->delete('farmacias', array('IdFarmacia' => $uID));
        if ($result) {
            echo json_encode("OK");
        }
    }

    public function DeleteMedicos($uID){
        $result = $this->db->delete('medicos', array('IdMedico' => $uID));
        if ($result) {
            echo json_encode("OK");

        }
    }
}