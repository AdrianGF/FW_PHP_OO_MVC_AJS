
# **UNLIMTY**

Una aplicación enfocada al inicio de nuevos proyectos y financiarlos con donaciones.
También permite ver los proyectos y los objetivos de estos.
Iniciar la sesión para crear tus proyectos o bien guardarlos en tus favoritos...


################################################################
## **TECNOLOGIES** 
################################################################

    -PHP 5.6.32
    -AngularJS 1.4
    -MySQL 5.6.38


################################################################
## **BE FW_PHP_OO_MVC** 
################################################################

##########################  **FW_PHP_OO_MVC** #######################

    -Router
    -Utils
    -Paths
    -Utils -> secret.inc.php*
    -sql**

    *Contiene las credenciales de las API.
    **Está compuesta por las tablas de usuarios, favoritos
    y proyectos, estas mismas tablas divididas en varias tablas
    con los datos.

    Con el JWT creo tokens de las operaciones críticas y así asegurar la información.
    Un toaster avisando de las operaciones realizadas.


################################################################
### **modules** 
################################################################

########################## login #################################

    -controller
    -model -> BLL, Model, DAO
    -resources
    -utils*

    *Contiene una validación, creación del token JWT y el Social
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
    buscador de proyectos.
    Y listado de distintos tipos de proyectos de la API.
    


########################### donations ###########################

    -controller
    -model -> BLL, Model, DAO
    -resources

    Esta parte es equivalente a la tienda, solo que con 
    los proyectos a los cuales puedes donar.
    Tiene un buscador y una paginación de los proyectos.


########################## profile ##############################

    -controller
    -model -> BLL, Model, DAO
    -resources
    -utils*

    *contiene una validación, creación del token JWT y el 
    Social Login.

    Comparte modulo con el del Login.
    El profile está compuesto por la vista de los datos del
    usuario, la modificación de los mismos.
    Además el formulario de edición de datos contiene un
    Dropzone y Dependent Drop Down.




################################################################
## **FE ANGULARJS 1.4** 
################################################################


    -app.js*
    -apiconnector.js**

    *Donde se realiza el enruta de las módulos.
    **Conecta el backend y el frontend.

################################################################ 
### **assets**
################################################################

    -css/fonts/js/img*
    -inc -> views
    -utils -> secret.factory.js**

    *Contiene lo necesario para la template.
    **Contiene una factoría para el uso de las credenciales.

################################################################
### **modules** 
################################################################

############################ login ###############################

    -controller
    -directives*
    -services**
    -view***

    *Contiene una directiva del DropZone.
    **Compuesto por los servicios de Login, las localizaciones
    del País y operaciones sobre el Token. Un único "services" para visualizar un menú para cada típo de usuario.
    ***Tiene tres vistas diferentes, la del profile, recover 
    password y la del login.

    Puedes hacer un Login, Register, Social Login y un Recover
    Password.



############################ home ###############################

    -controller
    -view*

    *Dos vistas, details, home.

    Contiene los cálculos del Infinite Scroll y tiene la vista
    de al hacer click en un proyecto "details".

########################### donations #############################

    -controller
    -view*

    *Contiene dos vistas, la de proyectos de api y la lista de
    proyectos de la web.

    Tiene los datos de todos los proyectos, y también
    la información individualmente de cada uno de ellos además 
    de listar los proyectos de la api.
API: [fundsurfer](https://www.fundsurfer.com/api/projects/json)

############################ profile ##############################

    -controller
    -directives
    -services
    -view*

    *Contiene vista del profile, que dentro de ella se divide en:
        Los datos del usuario, y poder editarlos.
        Ver los proyectos, crearlos, borrarlos y listar.
        Y tu lista de tus favoritos. 

    Comparte modulo con el Login, y contiene los datos de el
    usuario con la sesión iniciada.