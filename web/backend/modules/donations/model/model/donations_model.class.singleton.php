<?php
class donations_model {
    private $bll;
    static $_instance;

    private function __construct() {
        $this->bll = donations_bll::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    
    public function select_all_projects() {
        return $this->bll->select_all_projects_bll();
    }
      
    public function select_one_projects($arrArgument) {
        return $this->bll->select_one_projects_bll($arrArgument);
    }

    
}
