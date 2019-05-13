<?php
class home_bll{
    private $dao;
    private $db;
    static $_instance;

    private function __construct() {
        $this->dao = home_dao::getInstance();
        $this->db = db::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function select_home_top_bll(){
      return $this->dao->select_home_top_dao($this->db);
    }
    
    public function select_auto_name_bll(){
        return $this->dao->select_auto_name_dao($this->db);
    }

    



}
