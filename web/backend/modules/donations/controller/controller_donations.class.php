<?php
class controller_donations {

    function __construct() {
    }

    function content() { 
        require_once(VIEW_PATH_INC . "top_page_home.php");
        require_once(VIEW_PATH_INC . "banner.php");
        require_once(VIEW_PATH_INC . "header.php");
        require_once(VIEW_PATH_INC . "menu.php");

        require_once(VIEW_PATH_INC . "footer.php");
        require_once(VIEW_PATH_INC . "bottom_page.php");

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