<?php
class controller_home {

    function __construct() {
    }

    public function top_projects() {
        $arrValue = false;
        $arrValue = loadModel(MODEL_HOME, "home_model", "select_home_top", "" );
        echo json_encode($arrValue);
    }

    public function load_auto_name() {
        $arrValue = false;
        $arrValue = loadModel(MODEL_HOME, "home_model", "select_auto_name", "" );
        echo json_encode($arrValue); 
    }
    


}