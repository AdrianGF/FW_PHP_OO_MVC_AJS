<?php
class donations_dao {
    static $_instance;

    private function __construct() {

    }

    public static function getInstance() {
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function select_all_projects_dao($db){
  
        $sql = "SELECT * FROM projects ORDER BY ProDonate DESC";
      
        $resu = $db->ejecutar($sql);
        return $db->listar($resu);      
    }    

    public function select_one_projects_dao($db, $arrArgument){
  
        $sql = "SELECT * FROM projects WHERE idproject = '$arrArgument' ORDER BY ProDonate DESC";
      
        $resu = $db->ejecutar($sql);
        return $db->listar($resu);      
    }    
}