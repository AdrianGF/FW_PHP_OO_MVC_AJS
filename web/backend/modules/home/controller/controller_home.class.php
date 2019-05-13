<?php
class controller_home {

    function __construct() {
    }

    function content() { 
        require_once(VIEW_PATH_INC . "top_page_home.php");
        require_once(VIEW_PATH_INC . "banner.php");
        require_once(VIEW_PATH_INC . "header.php");
        require_once(VIEW_PATH_INC . "menu.php");
        loadView('modules/home/view/', 'main_home.html');
        require_once(VIEW_PATH_INC . "footer.php");
        require_once(VIEW_PATH_INC . "bottom_page.php");

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