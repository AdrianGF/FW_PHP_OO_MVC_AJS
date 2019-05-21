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
        
        $token = generate_Token_secure(40);

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
        //$token = md5(uniqid(rand(),true));
        $token = generate_Token_secure(20);
        $avatar= "http://i.pravatar.cc/150?u=$mail"; 

        $sql = "INSERT INTO users(IDuser, user, email, `password`, `type`, avatar, activate, token) VALUES('$user','$user','$mail','$password',1,'$avatar',0,'$token')";
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
        $sql = "SELECT IDuser, user, email, avatar FROM users WHERE token = '$arrArgument'";
        $resu = $db->ejecutar($sql);
        return $db->listar($resu);
    }
}