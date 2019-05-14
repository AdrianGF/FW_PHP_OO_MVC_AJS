<?php
class login_bll{
    private $dao;
    private $db;
    static $_instance;

    private function __construct() {
        $this->dao = login_dao::getInstance();
        $this->db = db::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function exist_user_BLL($arrArgument){
        return $this->dao->select_exist_user($this->db,$arrArgument);
    }

    public function insert_user_BLL($arrArgument){
        return $this->dao->insert_user_reg($this->db,$arrArgument);
    }

    public function active_user_BLL($arrArgument){
        return $this->dao->update_active_user($this->db,$arrArgument);
    }

    public function get_mail_BLL($arrArgument){
        return $this->dao->select_get_mail($this->db,$arrArgument);
      }

    public function update_passwd_BLL($arrArgument){
    return $this->dao->update_passwd($this->db,$arrArgument);
    }

    public function type_user_BLL($arrArgument){
        return $this->dao->select_type_user($this->db,$arrArgument);
    }
      
    public function user_info_BLL($arrArgument){
        return $this->dao->select_user_info($this->db,$arrArgument);
    }
}
