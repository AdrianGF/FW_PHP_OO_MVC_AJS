<?php
class donations_bll{
    private $dao;
    private $db;
    static $_instance;

    private function __construct() {
        $this->dao = donations_dao::getInstance();
        $this->db = db::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function select_all_projects_bll(){
      return $this->dao->select_all_projects_dao($this->db);
    }

    public function select_one_projects_bll($arrArgument){
        return $this->dao->select_one_projects_dao($this->db, $arrArgument);
    }

    


    
}
