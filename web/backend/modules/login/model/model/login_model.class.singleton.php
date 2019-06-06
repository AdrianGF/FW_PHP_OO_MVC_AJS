<?php
class login_model {
    private $bll;
    static $_instance;

    private function __construct() {
        $this->bll = login_bll::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
   
    public function exist_user($arrArgument){
        return $this->bll->exist_user_BLL($arrArgument);
    }

    public function token_log($arrArgument){
        return $this->bll->token_log_BLL($arrArgument);
    }

    public function insert_user($arrArgument){
        return $this->bll->insert_user_BLL($arrArgument);
    }

    public function active_user($arrArgument){
        return $this->bll->active_user_BLL($arrArgument);
    }

    public function get_mail($arrArgument){
        return $this->bll->get_mail_BLL($arrArgument);
    }

    public function update_passwd($arrArgument){
        return $this->bll->update_passwd_BLL($arrArgument);
    }

    public function type_user($arrArgument){
        return $this->bll->type_user_BLL($arrArgument);
    }

    public function user_info($arrArgument){
        return $this->bll->user_info_BLL($arrArgument);
    }

    public function insert_user_social($arrArgument){
        return $this->bll->insert_user_social_BLL($arrArgument);
    }

    public function obtain_paises($url) {
        return $this->bll->obtain_paises_BLL($url);
    }

    public function obtain_provincias() {
        return $this->bll->obtain_provincias_BLL();
    }
 
    public function obtain_poblaciones($arrArgument) {
        return $this->bll->obtain_poblaciones_BLL($arrArgument);
    }

    public function update_user($arrArgument){
        return $this->bll->update_user_BLL($arrArgument);
    }

    public function select_favs($arrArgument){
        return $this->bll->select_favs_BLL($arrArgument);
    }
    
    public function select_favs_project($arrArgument){
        return $this->bll->select_favs_project_BLL($arrArgument);
    }

    public function insert_favs_project($arrArgument){
        return $this->bll->insert_favs_project_BLL($arrArgument);
    }

    public function favs_project_validate($arrArgument){
        return $this->bll->favs_project_validate_BLL($arrArgument);
    }
    

    
}