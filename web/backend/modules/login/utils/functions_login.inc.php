<?php
	function validate_data($data,$type){
		$error = array();
		$valid = true;
		
		if ($type === 'login') {
			$filter = array(
		        'login_user' => array(
		            'filter' => FILTER_VALIDATE_REGEXP,
		            'options' => array('regexp' => '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9_.-]*$/')
		        ),
		        'login_password' => array(
		            'filter' => FILTER_VALIDATE_REGEXP,
		            'options' => array('regexp' => '/[a-zA-z0-9@-_.,~ñ]{8,30}/')
		        ),
		    );
		    $result = filter_var_array($data, $filter);
		    $data = exist_user($result['login_user']);
			$data = $data[0];
			
	    	$activate = $data['activate'];
	    	$password = $data['password'];
		    if ($result != null && $result){
		        if(!$result['login_user']){
		            $error['login_user'] = "El formato del usuario es incorrecto";
		            $valid = false;
		        }
		        elseif(!$data){
		            $error['login_user'] = "El usuario añadido no coincide con nuestros datos";
		            $valid = false;
		        }
		        elseif(!password_verify($result['login_password'],$password)){
		            $error['login_password'] = "Contraseña incorrecta.";
		            $valid = false;
				}
				
		        if($activate === '0'){
		            $error['login_user'] = "Tienes que verificar el correo";
		            $valid = false;
		        }
		    } else {
		        $valid = false;
		    }
		    return $return = array('valido' => $valid,'error' => $error, 'data' => $result);
		    
		}

		//-----
		
        if($type === 'register'){
			$filter = array(
		        'reg_user' => array(
		            'filter' => FILTER_VALIDATE_REGEXP,
		            'options' => array('regexp' => '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9_.-]*$/')
		        ),
		        'reg_email' => array(
		            'filter' => FILTER_VALIDATE_REGEXP,
		            'options' => array('regexp' => '/^^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/')
		        ),
		        'reg_password' => array(
		            'filter' => FILTER_VALIDATE_REGEXP,
		            'options' => array('regexp' => '/[a-zA-z0-9@-_.,~ñ]{8,30}/')
                )
            );
            
		    $result = filter_var_array($data, $filter);
		    if ($result != null && $result){
		        if(!$result['reg_user']){
		            $error['reg_user'] = "El usuario tiene que estar entre 5 y 25 caracteres";
		            $valid = false;
		        }
		        if(!$result['reg_email']){
		            $error['reg_email'] = "El formato del email es incorrecto";
		            $valid = false;
		        }
		        if(!$result['reg_password']){
		            $error['reg_password'] = "El formato de la contraseña es incorrecta";
		            $valid = false;
                }
		       	if(exist_user($result['reg_user'])){
		            $error['reg_user'] = "El usuario ya existe";
		            $valid = false;
		        }
		    } else {
		        $valid = false;
		    };
            return $return = array('valido' => $valid,'error' => $error, 'data' => $result);
		}

		//

		if($type === 'edit_profile'){
			$filter = array(
		        'Name' => array(
		            'filter' => FILTER_VALIDATE_REGEXP,
		            'options' => array('regexp' => '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9_.-]*$/')
		        ),
		        'Surname1' => array(
		            'filter' => FILTER_VALIDATE_REGEXP,
		            'options' => array('regexp' => '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9_.-]*$/')
				),
				'Surname2' => array(
		            'filter' => FILTER_VALIDATE_REGEXP,
		            'options' => array('regexp' => '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9_.-]*$/')
				),
				'Birthday' => array(
		            'filter' => FILTER_VALIDATE_REGEXP,
		            'options' => array('regexp' => '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/')
		        )
            );
            
		    $result = filter_var_array($data, $filter);
			if ($result != null && $result){
		        if(!$result['Name']){
		            $error['Name'] = "El nombre tiene que contener entre 5 y 25 caracteres";
		            $valid = false;
				}
				if(!$result['Surname1']){
		            $error['Surname1'] = "El primer apellido tiene que contener entre 5 y 25 caracteres";
		            $valid = false;
				}
				if(!$result['Surname2']){
		            $error['Surname2'] = "El segundo apellido tiene que contener entre 5 y 25 caracteres";
		            $valid = false;
		        }
				if(!$result['Birthday']){
		            $error['Birthday'] = "Fecha no valida";
		            $valid = false;
		        }
		    } else {
		        $valid = false;
		    };
            return $return = array('valido' => $valid,'error' => $error, 'data' => $result);

		}
		
		if($type === 'recover_pass'){
			if(!exist_user($data)){
				$error['rpuser'] = "El usuario no existe";
				$valid = false;
			}
			return $return = array('valido' => $valid,'error' => $error, 'data' => $result);
		}

		if($type === 'recover_passwd'){
			$filter = array(
		        'recpass' => array(
		            'filter' => FILTER_VALIDATE_REGEXP,
		            'options' => array('regexp' => '/[a-zA-z0-9@-_.,~ñ]{8,30}/')
		        ),
		        'recpassr' => array(
		            'filter' => FILTER_VALIDATE_REGEXP,
		            'options' => array('regexp' => '/[a-zA-z0-9@-_.,~ñ]{8,30}/')
		        ),
			);
			
			$result = filter_var_array($data, $filter);
		    if ($result != null && $result){
		        if(!$result['recpass']){
		            $error['recpass'] = "El formato de la contraseña es incorrecta";
		            $valid = false;
		        }
		        if(!$result['recpassr']){
		            $error['recpassr'] = "El formato de la contraseña es incorrecta";
		            $valid = false;
		        }
		        if($result['recpass'] != $result['recpassr']){
		            $error['recpassr'] = "Las contraseñas no coinciden";
		            $valid = false;
		        }
		    } else {
		        $valid = false;
		    };
		    return $return = array('valido' => $valid,'error' => $error, 'data' => $result);
		}

    }
    
	function exist_user($user){
		return loadModel(MODEL_LOGIN,'login_model','exist_user',$user);
	}

	function generate_Token_secure($longitud){
        if ($longitud < 4) {
            $longitud = 4;
        }
        return bin2hex(openssl_random_pseudo_bytes(($longitud - ($longitud % 2)) / 2));
	}

	function encode($name){
		require_once "JWT.php";

		$header = '{"typ":"JWT", "alg":"HS256"}';
		$secret = generate_Token_secure(10);

		$payload = '{
		"iat":' . time() . '", 
		"exp":' . time()  +  (60*60) . '",
		"name":' . $name . '
		}';

		$JWT = new JWT;
		$token = $JWT->encode($header, $payload, $secret);
		//$json = $JWT->decode($token, $secret);
		return $token;
	}

	require SITE_ROOT . 'modules/login/utils/auth0/vendor/autoload.php';
	use Auth0\SDK\Auth0;
	
	function login_social(){

		$domain        = 'dev-iqc252su.eu.auth0.com';
		$key           =  api_key('auth0');
		$client_secret =  api_key('auth0_sec');
		$redirect_uri  = 'http://localhost/framework/FW_PHP_OO_MVC_AJS/web/backend/index.php?module=login&function=social_data';
		$audience      = 'https://' . 'dev-iqc252su.eu.auth0.com' . '/userinfo';
	  
		$auth0 = new Auth0([
		  'domain' => $domain,
		  'client_id' => $key,
		  'client_secret' => $client_secret,
		  'redirect_uri' => $redirect_uri,
		  'audience' => $audience,
		  'scope' => 'openid profile',
		  'persist_id_token' => true,
		  'persist_access_token' => true,
		  'persist_refresh_token' => true
		]);
	  
		$auth0->login();

	}

	function data_social(){

		$domain        = 'dev-iqc252su.eu.auth0.com';
		$key           =  api_key('auth0');
		$client_secret =  api_key('auth0_sec');
		$redirect_uri  = 'http://localhost/framework/FW_PHP_OO_MVC_AJS/web/backend/index.php?module=login&function=social_data';
		$audience      = 'https://' . 'dev-iqc252su.eu.auth0.com' . '/userinfo';
	  
		$auth0 = new Auth0([
		  'domain' => $domain,
		  'client_id' => $key,
		  'client_secret' => $client_secret,
		  'redirect_uri' => $redirect_uri,
		  'audience' => $audience,
		  'scope' => 'openid profile',
		  'persist_id_token' => true,
		  'persist_access_token' => true,
		  'persist_refresh_token' => true
		]);
	  
		$userInfo = $auth0->getUser();
		return $userInfo;

	}

	

	
	
	