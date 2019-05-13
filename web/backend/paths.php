<?php
//PROYECTO
define('PROJECT', '/framework/FW_PHP_OO_MVC_AJS/web/backend/');

//SITE_ROOT
define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] . PROJECT);

//SITE_PATH
define('SITE_PATH', 'http://' . $_SERVER['HTTP_HOST'] . PROJECT);

//CSS
define('CSS_PATH', SITE_PATH . 'view/assets/css/');

//JS
define('JS_PATH', SITE_PATH . 'view/assets/js/');

//IMG
define('IMG_PATH', SITE_PATH . 'view/assets/images/');

//modules
define('MODULES_PATH', SITE_ROOT . 'modules/');

//model
define('MODEL_PATH', SITE_ROOT . 'model/');

//view
define('VIEW_PATH_INC', SITE_ROOT . 'view/inc/');

//utils
define('UTILS', SITE_ROOT . 'utils/');


//model home
define('HOME_JS_PATH', SITE_PATH . 'modules/home/view/js/');
//define('UTILS_HOME', SITE_ROOT . 'modules/home/utils/');
define('MODEL_PATH_HOME', SITE_ROOT . 'modules/home/model/');
define('MODEL_HOME', SITE_ROOT . 'modules/home/model/model/');
define('DAO_HOME', SITE_ROOT . 'modules/home/model/DAO/');
define('BLL_HOME', SITE_ROOT . 'modules/home/model/BLL/');

//model donations
define('DONATIONS_JS_PATH', SITE_PATH . 'modules/donations/view/js/');
//define('UTILS_DONATIONS', SITE_ROOT . 'modules/donations/utils/');
define('MODEL_PATH_DONATIONS', SITE_ROOT . 'modules/donations/model/');
define('MODEL_DONATIONS', SITE_ROOT . 'modules/donations/model/model/');
define('DAO_DONATIONS', SITE_ROOT . 'modules/donations/model/DAO/');
define('BLL_DONATIONS', SITE_ROOT . 'modules/donations/model/BLL/');

//model contact
define('CONTACT_JS_PATH', SITE_PATH . 'modules/contact/view/js/');
//define('UTILS_CONTACT', SITE_ROOT . 'modules/contact/utils/');
define('MODEL_PATH_CONTACT', SITE_ROOT . 'modules/contact/model/');
define('MODEL_CONTACT', SITE_ROOT . 'modules/contact/model/model/');
define('DAO_CONTACT', SITE_ROOT . 'modules/contact/model/DAO/');
define('BLL_CONTACT', SITE_ROOT . 'modules/contact/model/BLL/');
define('CONTACT_LIB_PATH', SITE_PATH . 'modules/contact/view/lib/');

//model login
define('LOGIN_JS_PATH', SITE_PATH . 'modules/login/view/js/');
define('UTILS_LOGIN', SITE_ROOT . 'modules/login/utils/');
define('MODEL_PATH_LOGIN', SITE_ROOT . 'modules/login/model/');
define('MODEL_LOGIN', SITE_ROOT . 'modules/login/model/model/');
define('DAO_LOGIN', SITE_ROOT . 'modules/login/model/DAO/');
define('BLL_LOGIN', SITE_ROOT . 'modules/login/model/BLL/');


//amigables
define('URL_AMIGABLES', TRUE);

