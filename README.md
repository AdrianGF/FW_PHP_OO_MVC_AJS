#################################################################
########################## Unlimty ##############################
#################################################################

Una apliacación enfocada al inicio de nuevos proyectos para 
obtener donaciones y así poder subencionarlos.
También permite ver los proyectos y los objetivos de estos,
con la opcion de donar al iniciar sesión en una cuenta.


########################## Tecnologies #########################

    -PHP
    -AngularJS


################################################################
######################## BE FW_PHP_OO_MVC ######################
################################################################

##########################  FW_PHP_OO_MVC ######################

    -Router
    -Utils
    -Paths
    -Utils -> secret.inc.php*

    *Contiene las credenciales de las API.

######################### modules ##############################
    
########################## login ###############################

    -controller
    -model -> BLL, Model, DAO
    -resources
    -utils*

    *contiene una validación, creación del token JWT y el Social
    Login por auth0.
    El login tiene algunos detalles como mostrar las
    contraseñas, y un toaster avisando en cada momento de las
    operaciones realizadas y la validación por correo del 
    MailGun.
    Los datos de los usuarios se guardan en dos tablas.



############################ home ##############################

    -controller
    -model -> BLL, Model, DAO
    -resources

    El home está compuesto por un infinite scroll y un
    buscador de los proyectos.
    


########################## donations ###########################

    -controller
    -model -> BLL, Model, DAO
    -resources

    Esta parte es equivalente a la tiena, solo que con 
    proyectos a los cuales peudes donar.
    Tiene un buscador y una paginación de los proyectos.


########################## profile #############################

    -controller
    -model -> BLL, Model, DAO
    -resources
    -utils*

    *contiene una validación, creación del token JWT y el 
    Social Login.
    Comparte modulo con el del Login.
    El profile está compuesto por la visata de los datos del
    usuario, la modificación de los mismos.
    Además el formulario de edicion de datos contiene un
    Dropzone y Dependent Drop Down.


################################################################
######################## FE ANGULARJS 1.4 ######################
################################################################

    -app.js
    -apiconector.js

########################## assets ##############################

    -css/fonts/js/img*
    -inc -> views
    -utils -> secret.factory.js**

    *Contiene lo necesario para la template.
    **Contiene una factoria para el uso de las credenciales.

######################### modules ##############################

########################## login ###############################

    -controller
    -directives*
    -services**
    -view

    *Contiene una directiva del DropZone.
    **Compuesto por los servicios de Login, las localizaciones
    del País y operaciones sobre el Token

    Puedes hacer un Login, Register, Social Login y un Recover
    Password.



############################ home ##############################

    -controller
    -view

    Contiene los calculos del Infinite Scroll.

########################## donations ###########################

    -controller
    -view

    Tiene los datos de todos los proyectos, y también
    la información individualemte de cada uno de ellos.

########################## profile #############################

    -controller
    -directives
    -services
    -view

    Comparte modulo con el Login, y contiene los datos de el
    usuario con la sesión iniciada.