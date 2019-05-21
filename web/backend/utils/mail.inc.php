<?php
    function enviar_email($arr) {
        $html = '';
        $subject = '';
        $body = '';
        $ruta = '';
        $return = '';
        $key = $arr['key'];

        switch ($arr['type']) {
            case 'reg':
                $subject = 'Tu Alta';
                $ruta = '<a href="http://' . $_SERVER['HTTP_HOST'] . '/framework/FW_PHP_OO_MVC_AJS/web/#/login/active_user/' . $arr['token'] .'">aqu&iacute;</a>';
                $body = 'Gracias por unirte.<br> Para finalizar el registro, pulsa ' . $ruta;
                break;
                
            case 'recover':
                $subject = 'Tu Nueva Contraseña';
                $ruta = '<a href="http://' . $_SERVER['HTTP_HOST'] . '/framework/FW_PHP_OO_MVC_AJS/web/#/login/recover_password/' . $arr['token'] .'">aqu&iacute;</a>';
                $body = 'Para recordar tu password pulsa ' . $ruta;
                break;
                
            case 'contact':
                $subject = 'Tu Petici&oacute;n a Unlimty ha sido enviada';
                $ruta = '<a href=' . 'http://localhost/framework/FW_PHP_OO_MVC_JQUERY_V2/web/contact/content/'. '>aqu&iacute;</a>';
                $body = 'Para visitar nuestra web, pulsa ' . $ruta;
                break;
    
            case 'admin':
                $subject = $arr['inputSubject'];
                $body = 'inputName: ' . $arr['inputName']. '<br>' .
                'inputEmail: ' . $arr['inputEmail']. '<br>' .
                'inputSubject: ' . $arr['inputSubject']. '<br>' .
                'inputMessage: ' . $arr['inputMessage'];
                break;
        }
        
        $html .= "<html>";
        $html .= "<body>";
	       $html .= "<h4>". $subject ."</h4>";
	       $html .= $body;
	       $html .= "<br><br>";
	       $html .= "<p>Sent by test</p>";
		$html .= "</body>";
		$html .= "</html>";

        //set_error_handler('ErrorHandler');
        try{
            if ($arr['type'] === 'admin')
                $address = 'gramaferre@gmail.com';
            else
                $address = $arr['inputEmail'];
            $result = send_mailgun('gramaferre@gmail.com', $address, $subject, $html, $key);    
        } catch (Exception $e) {
			$return = 0;
		}
		//restore_error_handler();
        return $result;
    }
    
    function send_mailgun($from, $to, $subject, $html, $key){
        	$config = array();
        	$config['api_key'] = $key; //API Key
        	$config['api_url'] = "https://api.mailgun.net/v3/sandboxbcbc34072662484abee8f10fe392d631.mailgun.org/messages"; //API Base URL
    
        	$message = array();
        	$message['from'] = $from;
        	$message['to'] = $to;
        	$message['h:Reply-To'] = "gramaferre@gmail.com";
        	$message['subject'] = $subject;
        	$message['html'] = $html;
         
        	$ch = curl_init();
        	curl_setopt($ch, CURLOPT_URL, $config['api_url']);
        	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        	curl_setopt($ch, CURLOPT_USERPWD, "api:{$config['api_key']}");
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        	curl_setopt($ch, CURLOPT_POST, true); 
        	curl_setopt($ch, CURLOPT_POSTFIELDS,$message);
        	$result = curl_exec($ch);
        	curl_close($ch);
        	return $result;
        }

