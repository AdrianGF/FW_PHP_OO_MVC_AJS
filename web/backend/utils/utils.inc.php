<?php
function debugPHP($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function redirect($url) {
    die('<script>window.location.href="' . $url . '";</script>');
}

function close_session() {
    $_SESSION = array(); // Destruye todas las variables de la sesión
    session_destroy(); // Destruye la sesión
}

function amigable($url, $return = false) {
    $amigableson = URL_AMIGABLES;
    $link = "";
    if ($amigableson) {
        $url = explode("&", str_replace("?", "", $url));
        foreach ($url as $key => $value) {
            $aux = explode("=", $value);
            $link .=  $aux[1]."/";
        }
    } else {
        $link = "index.php" . $url;
    }
    if ($return) {
        return SITE_PATH . $link;
    }
    echo SITE_PATH . $link;
}

function api_key($apitype){

    switch ($apitype) {
        case 'mailgun':
            $key = 'a6180ee7215e526dae4eac261ad61457-3fb021d1-9a5ace19';
            return $key;
        break;

        case 'auth0':
            $key = 'c1edVGYNoQvam3vZdxDbvtZCflNmGZip';
            return $key; 
        break;  

        case 'maps':
            $key = 'AIzaSyApv8j1gETrOGrElf9VUH678ph_ib8t-bk';
            return $key;
        break;
        
        default:
            $key = 'error';
        break;
    }

}
