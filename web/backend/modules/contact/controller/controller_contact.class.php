<?php
class controller_contact {

    function __construct() {
    }

    function content() { 
        require_once(VIEW_PATH_INC . "top_page_contact.php");
        require_once(VIEW_PATH_INC . "banner.php");
        require_once(VIEW_PATH_INC . "header.php");
        require_once(VIEW_PATH_INC . "menu.php");
        loadView('modules/contact/view/', 'main_contact.html');
        require_once(VIEW_PATH_INC . "footer.php");
        require_once(VIEW_PATH_INC . "bottom_page.php");

    }

    public function process_contact() {
        if($_POST['token'] === "contact_form"){

            
            
            //////////////// Envio del correo al usuario
            $arrArgument = array(
                                'type' => 'contact',
                                'token' => '',
                                'inputName' => $_POST['inputName'],
                                'inputEmail' => $_POST['inputEmail'],
                                'inputSubject' => $_POST['inputSubject'],
                                'inputMessage' => $_POST['inputMessage'],
                                'key' => api_key('mailgun')
                            );
            //set_error_handler('ErrorHandler');
            try{
                echo "<div class='alert alert-success'>".enviar_email($arrArgument)." </div>";
            } catch (Exception $e) {
                echo "<div class='alert alert-error'>Server error. Try later...</div>";
            }
            //restore_error_handler();
            
            
            //////////////// Envio del correo al admin de la web
            $arrArgument = array(
                                'type' => 'admin',
                                'token' => '',
                                'inputName' => $_POST['inputName'],
                                'inputEmail' => $_POST['inputEmail'],
                                'inputSubject' => $_POST['inputSubject'],
                                'inputMessage' => $_POST['inputMessage'],
                                'key' => api_key('mailgun')
                            );
            //set_error_handler('ErrorHandler');
            try{
                sleep(5);
                echo "<div class='alert alert-success'>".enviar_email($arrArgument)." </div>";
            } catch (Exception $e) {
                echo "<div class='alert alert-error'>Server error. Try later...</div>";
            }
            //restore_error_handler();
            
        }else{
            echo "<div class='alert alert-error'>Server error. Try later...</div>";
        }
    }
}