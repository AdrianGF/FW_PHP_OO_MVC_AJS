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
  
        $sql = "SELECT * FROM projects ORDER BY ProDonate DESC";
      
        $resu = $db->ejecutar($sql);
        return $db->listar($resu);      

    }

    public function select_auto_name_dao($db){
  
        $sql = "SELECT DISTINCT ProName FROM projects";
      
        $resu = $db->ejecutar($sql);
        return $db->listar($resu);      

    }

    


}