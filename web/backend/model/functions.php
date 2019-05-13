<?php

    class functions{
      public static function validate_admin(){
        if((!$_SESSION)){
            $callback = 'index.php?page=404';
            die('<script>window.location.href="'.$callback .'";</script>');
        }else{
            if($_SESSION['type'] === "1"){
                $callback = 'index.php?page=404';
                die('<script>window.location.href="'.$callback .'";</script>');
            }
        }
    
      }
    }
?>


