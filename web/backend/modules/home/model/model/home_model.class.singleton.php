<?php
class home_model {
    private $bll;
    static $_instance;

    private function __construct() {
        $this->bll = home_bll::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    
    public function select_home_top() {
        return $this->bll->select_home_top_bll();
    }

    public function select_auto_name() {
        return $this->bll->select_auto_name_bll();
    }

    public function load_details($arrArgument) {
        return $this->bll->load_details_BLL($arrArgument);
    }
  

}
