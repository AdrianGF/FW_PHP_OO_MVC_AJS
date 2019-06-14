<?php
class login_dao {
    static $_instance;

    private function __construct() {

    }

    public static function getInstance() {
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function select_exist_user($db,$arrArgument) {
        
        $sql = "SELECT user,activate,token,`password`,token_log FROM users WHERE IDuser = '$arrArgument'";
        $resu = $db->ejecutar($sql);
        return $db->listar($resu);
        
    }

    public function token_log_update($db,$arrArgument) {
        
        $token = encode($arrArgument);

        $sql = "UPDATE users SET token_log = '$token' WHERE IDuser = '$arrArgument'";
        return $db->ejecutar($sql);
        
    }
    

    public function insert_user_reg($db,$arrArgument) {
        $user = $arrArgument['reg_user'];
        $mail = $arrArgument['reg_email'];
        $opciones = [
            'cost' => 12,
        ];
        $password= password_hash($arrArgument['reg_password'], PASSWORD_BCRYPT, $opciones);
        $token = generate_Token_secure(20);
        $avatar= "http://i.pravatar.cc/150?u=$mail"; 

        $sql = "INSERT INTO users(IDuser, user, email, `password`, `type`, avatar, activate, token) VALUES('$user','$user','$mail','$password',1,'$avatar',0,'$token')";
        $db->ejecutar($sql);

        $sql = "INSERT INTO users_info(IDuser, `Name`, Surname1, Surname2, Birthday, Country, Province, City) VALUES('$user', 'Empty', 'Empty', 'Empty', 'Empty', 'Empty', 'Empty', 'Empty')";
        $db->ejecutar($sql);

        return $token;


    }

    public function update_active_user($db,$arrArgument) {
        $sql = "UPDATE users SET activate = 1 WHERE token = '$arrArgument'";
        return $db->ejecutar($sql);
    }

    public function select_get_mail($db,$arrArgument) {
        $sql = "SELECT email, token FROM users WHERE IDuser = '$arrArgument'";
        $resu = $db->ejecutar($sql);
        return $db->listar($resu);
    }

    public function update_passwd($db,$arrArgument) {
        $opciones = [
            'cost' => 12,
        ];
        $password = password_hash($arrArgument['rec_password'],  PASSWORD_BCRYPT, $opciones);
        $token = $arrArgument['token'];

        $sql = "UPDATE users SET `password` = '$password' WHERE token = '$token'";
        return $db->ejecutar($sql);
    }

    public function select_type_user($db,$arrArgument) {
        $sql = "SELECT `type` FROM users WHERE token_log = '$arrArgument'";
        $resu = $db->ejecutar($sql);
        return $db->listar($resu);
    }

    public function select_user_info($db,$arrArgument) {
        $sql = "SELECT users.IDuser, users.user, users.email, users.avatar, users_info.`Name`, users_info.Surname1, users_info.Surname2, users_info.Birthday, users_info.Country, users_info.Province, users_info.City FROM users, users_info WHERE users.IDuser = users_info.IDuser AND users.token_log = '$arrArgument'";
        $resu = $db->ejecutar($sql);
        return $db->listar($resu);
    }

    public function insert_user_social($db,$arrArgument) {
        $id = $arrArgument['id'];
        $user = $arrArgument['name'];
        $mail = $arrArgument['email'];
        $avatar= $arrArgument['avatar']; 

        $sql = "INSERT INTO users(IDuser, user, email, `type`, avatar, activate) VALUES('$id','$user','$mail', 1,'$avatar',1)";
        $db->ejecutar($sql);
        return $token;
    }

    public function obtain_paises_DAO($url){
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $file_contents = curl_exec($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $accepted_response = array(200, 301, 302);
        if(!in_array($httpcode, $accepted_response)){
          return FALSE;
        }else{
          return ($file_contents) ? $file_contents : FALSE;
        }
    }

    public function obtain_provincias_DAO() {
        $json = array();
        $tmp = array();

        $provincias = simplexml_load_file(RESOURCES . "provinciasypoblaciones.xml");
        $result = $provincias->xpath("/lista/provincia/nombre | /lista/provincia/@id");
        for ($i = 0; $i < count($result); $i+=2) {
            $e = $i + 1;
            $provincia = $result[$e];
            $tmp = array(
                'id' => (string) $result[$i], 'nombre' => (string) $provincia
            );
            array_push($json, $tmp);
        }
        return $json;
    }

    public function obtain_poblaciones_DAO($arrArgument) {
        $json = array();
        $tmp = array();

        $filter = (string) $arrArgument;
        $xml = simplexml_load_file(RESOURCES . 'provinciasypoblaciones.xml');
        $result = $xml->xpath("/lista/provincia[@id='$filter']/localidades");

        for ($i = 0; $i < count($result[0]); $i++) {
            $tmp = array(
                'poblacion' => (string) $result[0]->localidad[$i]
            );
            array_push($json, $tmp);
        }
        return $json;
    }

    public function update_user_DAO($db,$arrArgument) {
        
        $IDuser = $arrArgument['IDuser'];
        $Name = $arrArgument['Name'];
        $Surname1 = $arrArgument['Surname1'];
        $Surname2 = $arrArgument['Surname2'];
        $Birthday = $arrArgument['Birthday'];
        $Country = $arrArgument['Country'];
        $Province = $arrArgument['Province'];
        $City = $arrArgument['City'];
        $token_log = $arrArgument['Token_log'];
        $nameAvatar = $arrArgument['Avatar'];
        $avatar = "http://localhost/framework/FW_PHP_OO_MVC_AJS/web/backend/media/$nameAvatar";

        
        $sql = "UPDATE users SET avatar = '$avatar' WHERE IDuser = '$IDuser' AND token_log = '$token_log'";
        $db->ejecutar($sql);

        $sql = "UPDATE users_info SET `Name` = '$Name', Surname1 = '$Surname1', Surname2 = '$Surname2', Birthday = '$Birthday', Country = '$Country', Province = '$Province', City = '$City' WHERE IDuser = '$IDuser'";
        return $db->ejecutar($sql);
        
    }

    public function select_favs_DAO($db,$arrArgument) {
        
        $IDuser = $arrArgument;

        $sql = "SELECT count(*) FROM favoritos WHERE IDuser = '$IDuser'";
       
        $resu = $db->ejecutar($sql);
        return $db->listar($resu);

        //return $arrArgument;
        
    }

    public function select_favs_project_DAO($db,$arrArgument) {
        
        $IDuser = $arrArgument;

        $sql = " SELECT * FROM projects p, favoritos f WHERE p.idproject = f.idproject AND f.IDuser = '$IDuser';";
       
        $resu = $db->ejecutar($sql);
        return $db->listar($resu);

        //return $idproject;
        
    }


    public function favs_project_validate_DAO($db,$arrArgument) {
        
        $idproject = $arrArgument['idproject'];
        $token_log = $arrArgument['token_log'];

        $sql = "SELECT COUNT(*) AS num FROM favoritos f, users u WHERE f.IDuser = u.IDuser AND u.token_log = '$token_log' AND f.idproject = '$idproject'";

        $resu = $db->ejecutar($sql);
        return $db->listar($resu);
        
        
    }


    public function insert_favs_project_DAO($db,$arrArgument) {
          
        $idproject = $arrArgument['idproject'];
        $token_log = $arrArgument['token_log'];

        $sql = "INSERT INTO favoritos(idproject, IDuser) VALUES('$idproject', (SELECT IDuser FROM users WHERE token_log = '$token_log') );";
       
        $db->ejecutar($sql);
        return $arrArgument;
        
    }

    public function user_project_DAO($db,$arrArgument) {
          
        $token_log = $arrArgument;

        $sql = "SELECT pro.* FROM user_project user_pro, projects pro, users us WHERE user_pro.idproject = pro.idproject AND user_pro.IDuser = us.IDuser AND us.token_log = '$token_log'";
       
        $resu = $db->ejecutar($sql);
        return $db->listar($resu);
        
    }
    
    public function create_project_DAO($db,$arrArgument) {
          
        $ProName = $arrArgument['ProName'];
        $ProType = $arrArgument['ProType'];
        $ProDesc = $arrArgument['ProDesc'];
        $Mail = $arrArgument['Mail'];
        $ProDateIni = $arrArgument['ProDateIni'];
        $ProPrice = $arrArgument['ProPrice'];
        $ProDonate = $arrArgument['ProDonate'];
        $Curr = $arrArgument['Curr'];
        $Img = $arrArgument['ProImg'];
        $ProImg = "http://localhost/framework/FW_PHP_OO_MVC_AJS/web/backend/media/$Img";

        $sql = "INSERT INTO projects(ProName, ProType, ProDesc, Mail, ProDateIni, ProPrice, ProDonate, Curr, ProImg) VALUES('$ProName', '$ProType', '$ProDesc', '$Mail', '$ProDateIni', '$ProPrice', '$ProDonate', '$Curr', '$ProImg') ";
       
        $resu = $db->ejecutar($sql);
        return $resu;
        
    }
    
    public function create_user_project_DAO($db,$arrArgument) {
          
        $ProName = $arrArgument['ProName'];
        $token_log = $arrArgument['token_log'];

        $sql = "INSERT INTO user_project(idproject, IDuser) VALUES( (SELECT idproject FROM projects WHERE ProName = '$ProName'), (SELECT IDuser FROM users WHERE token_log = '$token_log'))";

        $resu = $db->ejecutar($sql);
        return $resu;
        
    }
    
            

    

}