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
    
    public function load_details() {
        $idproject = $_POST['idproject'];
        if($idproject){
            $resu = loadModel(MODEL_HOME, "home_model", "load_details", $idproject );
        }else{
            $resu = 'Error';
        }
        echo json_encode($resu); 
    }

    public function select_IDuser() {

        $token_log = $_POST['token_log'];
        
        
        $data = loadModel(MODEL_HOME, "home_model", "select_IDuser", $token_log );
        echo json_encode($data); 
    }
    

}