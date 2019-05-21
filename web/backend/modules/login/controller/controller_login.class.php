<?php
@session_start();
class controller_login {

    function __construct() {
        $_SESSION['module'] = "login";
        include(UTILS_LOGIN . "functions_login.inc.php");
    }

    function typeuser(){
        //$data_social = json_decode($_POST['data_social_net'],true);
        $result = loadModel(MODEL_LOGIN,'login_model','type_user',$_GET['param']);
        if ($result) {
            echo json_encode($result);
        }else{
            echo json_encode(false);
        }
    }

    

    function user_info(){
        $token = $_POST['user'];
        $option = $_POST['option'];

       
        switch ($option) {
            case 'info':
                $result = loadModel(MODEL_LOGIN,'login_model','user_info',$token);
                $jsondata['resu'] = $result;
                $jsondata['op'] = $option; 

                echo json_encode($jsondata);   
            break;

            case 'edit':
                $result = loadModel(MODEL_LOGIN,'login_model','user_info',$token);
                $jsondata['resu'] = $result;
                $jsondata['op'] = $option; 

                echo json_encode($jsondata);   
            break;
        }

    }

    
    function recover_password() { 

        if (isset($_GET['param'])) {
            $_SESSION['token'] = $_GET['param'];
            //print($_SESSION['token']);
            require_once(VIEW_PATH_INC . "top_page_login.php");
            require_once(VIEW_PATH_INC . "banner.php");
            require_once(VIEW_PATH_INC . "header.php");
            require_once(VIEW_PATH_INC . "menu.php");
            loadView('modules/login/view/', 'recover_password.html');
            require_once(VIEW_PATH_INC . "footer.php");
            require_once(VIEW_PATH_INC . "bottom_page.php");
        }

    }

    function recover_pass_email(){
        $key = api_key('mailgun');
        $recover_pass = json_decode($_POST['rpuser'],true);
        $response = validate_data($recover_pass,'recover_pass');

        if ($response['valido'] === true) {
            $result = loadModel(MODEL_LOGIN,'login_model','get_mail',$recover_pass);
            $result = $result[0];
            $result['token'] = $result['token'];
            $result['inputEmail'] = $result['email'];
            if ($result) {
                $result['type'] = 'recover';
                $result['inputMessage'] = 'Para recuperar tu contraseña pulse en el siguiente enlace';
                $result['key'] = $key;
                enviar_email($result);

                $jsondata['valido'] = true;
                echo json_encode($jsondata);
            }else{
                echo "error";
            }
        }else{
            $jsondata['valido'] = false;
            $jsondata['error'] = $response['error'];
            //header('HTTP/1.0 400 Bad error');
            echo json_encode($jsondata);
        }
    }

    function update_password(){
        
        $rpass_data = json_decode($_POST['rec_pass'],true);
        if ($rpass_data) {
            $result = loadModel(MODEL_LOGIN,'login_model','update_passwd',$rpass_data);
            echo json_encode($result);
        }else{
            $jsondata = false;
            echo json_encode($jsondata);	
        }
    }



    function validate_login(){
        $info_data = json_decode($_POST['login_data'],true);
        $response = validate_data($info_data,'login');

        if ($response['valido'] === true) {
            $data['token_log_valido'] = loadModel(MODEL_LOGIN, 'login_model', 'token_log', $info_data['login_user']);
            $data = exist_user($info_data['login_user']);
            $data = $data[0];
            $data['valido'] = true;
            echo json_encode($data);
        }else{
            $jsondata['valido'] = false;
            $jsondata['error'] = $response['error'];
            //header('HTTP/1.0 400 Bad error');
            echo json_encode($jsondata);
        }
    }

    function validate_register(){
        $info_data = json_decode($_POST['reg_data'],true);
        $response = validate_data($info_data,'register');
        $key = api_key('mailgun');

        if ($response['valido']) { 
            $result['token'] = loadModel(MODEL_LOGIN,'login_model','insert_user',$info_data);
            if ($result) {
                $result['type'] = 'reg';
                $result['inputEmail'] = $info_data['reg_email'];
                $result['inputMessage'] = 'Para activar tu cuenta pulse en el siguiente enlace';
                $result['key'] = $key;
                enviar_email($result);
            }
            echo json_encode($response);
        }else{
            $jsondata['valido'] = false;
            $jsondata['error'] = $response['error'];
            //header('HTTP/1.0 400 Bad error');
            echo json_encode($jsondata);
        }
    }

    function active_user(){
        $token = json_decode($_POST['token'],true);
        loadModel(MODEL_LOGIN, "login_model", "active_user", $token['token']);
        echo json_encode($token);
    }




    function key_auth0(){
        $resu = api_key($_POST["key"], true);
        echo json_encode($resu);
    }


}