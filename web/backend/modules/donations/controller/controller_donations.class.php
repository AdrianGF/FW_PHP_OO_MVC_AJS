<?php
class controller_donations {

    function __construct() {
    }


    public function all_projects() {
        $arrValue = false;
        $arrValue = loadModel(MODEL_DONATIONS, "donations_model", "select_all_projects", "" );
        echo json_encode($arrValue);
    }


    function load_project(){
        $arrValue = array();
        $arrValue = loadModel(MODEL_DONATIONS, "donations_model", "select_one_projects", $_GET['param']);
        echo json_encode($arrValue);
    }

}