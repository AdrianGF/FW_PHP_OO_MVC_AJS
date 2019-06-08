<?php
class home_dao {
    static $_instance;

    private function __construct() {

    }

    public static function getInstance() {
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function select_home_top_dao($db){
  
        $sql = "SELECT *, ROUND(ProDonate*100/ProPrice, 1) AS percent FROM projects ORDER BY ProDonate DESC";
      

        $resu = $db->ejecutar($sql);
        return $db->listar($resu);      

    }

    public function select_auto_name_dao($db){
  
        $sql = "SELECT DISTINCT ProName FROM projects";
      
        $resu = $db->ejecutar($sql);
        return $db->listar($resu);      

    }

    
    public function load_details_DAO($db,$arrArgument) {
        
        $idproject = $arrArgument;

        $sql = "SELECT * FROM projects WHERE idproject = '$idproject'";

        $resu = $db->ejecutar($sql);
        return $db->listar($resu);
        
        
    }

    


}