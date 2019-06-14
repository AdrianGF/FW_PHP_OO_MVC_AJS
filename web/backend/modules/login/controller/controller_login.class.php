<?php
@session_start();
class controller_login {

    function __construct() {
        $_SESSION['module'] = "login";
        include(UTILS_LOGIN . "functions_login.inc.php");
        include (UTILS . 'upload.inc.php');
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
        $token = $_POST['token_log'];
        $info_user = loadModel(MODEL_LOGIN,'login_model','user_info',$token);
        echo json_encode($info_user);   
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

    function social_login(){
        $login = login_social();
        //echo json_encode($login);
    }

    function social_data(){
        $data = data_social();
        $id = explode("|", $data[sub]);
        if( $id[0] === 'github'){
            $name = 'github_' . $data[nickname];
        }else{
            $name = 'google_' . $data[nickname];  
        }
        $exist = exist_user($name);
        //print_r($data);
        //exit;

        if(!$exist){

            if($id[0] === 'github'){
                $arrayDatos = array(
                    'id' => $name,
                    'name' => $data[nickname],
                    'email' => $data[name],
                    'avatar' => $data[picture]  
                );

                //print_r($arrayDatos);
                //exit;

            }else{//google
                
                $arrayDatos = array(
                    'id' => $name,
                    'name' => $data[nickname],
                    'email' => $data[nickname] . '@gmail.com',
                    'avatar' => $data[picture]  
                );
                
                //print_r($arrayDatos);
                //exit;
            }

            loadModel(MODEL_LOGIN,'login_model','insert_user_social',$arrayDatos);
            loadModel(MODEL_LOGIN, 'login_model', 'token_log',$name);
            $resu = exist_user($name);
            $token_log = $resu[0]['token_log'];
            redirect(SITE_PATH_ANGULAR . "#/login/social/$token_log");
            
            //print_r($resu);
            //exit;
            
        }else{

            loadModel(MODEL_LOGIN, 'login_model', 'token_log',$name);
            $resu = exist_user($name);
            $token_log = $resu[0]['token_log'];
            //SITE_PATH_ANGULAR . "#/login/social/$token_log";
            redirect(SITE_PATH_ANGULAR . "#/login/social/$token_log");
            //print_r($testy);
            //exit;
           

        }  

    }


    function upload_avatar() {
        $result_avatar = upload_files();
        $_SESSION['avatar'] = $result_avatar;
        echo json_encode($result_avatar);
    }

    function delete_avatar() {
        $_SESSION['avatar'] = array();
        $result = remove_files();
        if ($result === true) {
            echo json_encode(array("res" => true));
        } else {
            echo json_encode(array("res" => false));
        }
    }

    function load_pais_user() {
        if ((isset($_GET["param"])) && ($_GET["param"] == true)) {
            $json = array();
            $url = 'http://localhost/framework/FW_PHP_OO_MVC_AJS/web/backend/resources/ListOfCountryNamesByName.json';
            try {
                $json = loadModel(MODEL_LOGIN, "login_model", "obtain_paises", $url);
            } catch (Exception $e) {
                $json = false;
            }
            if ($json) {
                echo $json;
                exit;
            } else {
                $json = "error";
                echo $json;
                exit;
            }
        }
    }

    function load_provincias_user() {
        if ((isset($_GET["param"])) && ($_GET["param"] == true)) {
            $jsondata = array();
            $json = array();

            try {
                $json = loadModel(MODEL_LOGIN, "login_model", "obtain_provincias");
            } catch (Exception $e) {
                $json = false;
            }

            if ($json) {
                $jsondata["provincias"] = $json;
                echo json_encode($jsondata);
                exit;
            } else {
                $jsondata["provincias"] = "error";
                echo json_encode($jsondata);
                exit;
            }
        }
    }


    function load_poblaciones_user() {
        if (isset($_POST['idPoblac'])) {
            $jsondata = array();
            $json = array();

            try {
                $json = loadModel(MODEL_LOGIN, "login_model", "obtain_poblaciones", $_POST['idPoblac']);
            } catch (Exception $e) {
                $json = false;
            }

            if ($json) {
                $jsondata["poblaciones"] = $json;
                echo json_encode($jsondata);
                exit;
            } else {
                $jsondata["poblaciones"] = $_POST['idPoblac'];
                echo json_encode($jsondata);
                exit;
            }
        }
    }

    function edit_profile() {
        $jsondata = array();
        $info_data = $_POST;
        $IDuser = $info_data['IDuser'];
        $token = $info_data['Token_log'];
        $response = validate_data($info_data,'edit_profile');
        
        if($response['valido']){
            $resu = loadModel(MODEL_LOGIN,'login_model','update_user',$info_data);
            $data = loadModel(MODEL_LOGIN,'login_model','user_info',$token);
            $data['token_log_valido'] = loadModel(MODEL_LOGIN, 'login_model', 'token_log', $IDuser );
            $data['new_token'] = exist_user($IDuser);
            $response['datos'] = $data;
        }
       

        echo json_encode($response);
        
    }

    function user_favs() {
        $IDuser = $_POST['IDuser'];

        if($IDuser){
            $resu = loadModel(MODEL_LOGIN,'login_model', 'select_favs', $IDuser);

        }else{
            $resu = "ERROR1";
        }
        
        echo json_encode($resu);
        
    }

    function favs_project() {
        $IDuser = $_POST['IDuser'];

        if($IDuser){
            $data['data'] = loadModel(MODEL_LOGIN,'login_model', 'select_favs_project', $IDuser);
            $data['token_log_valido'] = loadModel(MODEL_LOGIN, 'login_model', 'token_log', $IDuser );
            $data['new_token'] = exist_user($IDuser);
        }else{
            $data = "ERROR2";
        }
        
        echo json_encode($data);
        
    }


    function favs_project_validate() {

        $arrayArgument = array(
            'idproject' => $_POST['idproject'],
            'token_log' => $_POST['token_log'],
        );
        $IDuser = $_POST['IDuser'];

        if($arrayArgument){
            $data = loadModel(MODEL_LOGIN,'login_model', 'favs_project_validate', $arrayArgument);
            $data['token_log_valido'] = loadModel(MODEL_LOGIN, 'login_model', 'token_log', $IDuser );
            $data['new_token'] = exist_user($IDuser);

        }else{
            $data = "ERROR2";
        }
        
        echo json_encode($data);
        
    }
    
    function favs_project_insert() {

        $arrayArgument = array(
            'idproject' => $_POST['idproject'],
            'token_log' => $_POST['token_log']
        );

        if($arrayArgument){
            $data = loadModel(MODEL_LOGIN,'login_model', 'insert_favs_project', $arrayArgument);

        }else{
            $data = "ERROR2";
        }
        
        echo json_encode($data);
        
    }
    
    function user_projects() {

        $token_log =  $_POST['token_log'];
        
        if($token_log){
            $data = loadModel(MODEL_LOGIN,'login_model', 'user_project', $token_log);

        }else{
            $data = "ERROR";
        }
        
        echo json_encode($data);

    }

    

    function create_project() {

        $project_info = $_POST;

        if($project_info){
            $data[0] = loadModel(MODEL_LOGIN,'login_model', 'create_project', $project_info);
            $data[1] = loadModel(MODEL_LOGIN,'login_model', 'create_user_project', $project_info);
        }else{
            $data = "ERROR";
        }
        
        echo json_encode($data);

    }

}
