unlimty.factory("loginService", ['$location', '$rootScope', 'services','localstorageService',
function ($location, $rootScope, services,localstorageService, socialService) {
	var service = {};
	service.login = login;
	service.logout = logout;
    return service;

    function login() {
        var token = localstorageService.getUsers();
        console.log(token);
        if (token) {
            services.get('login', 'typeuser',token).then(function (response) {
                console.log(response[0].type);
                var type = response[0].type;
                if (type === '1') {
                    console.log("user");
	            } else if (type === '0') {
                    console.log("admin");
	            }else{
                    $rootScope.loginV = true;
                }


            });
        } else {
            $rootScope.loginV = true;
        }
    }

    function logout() {
    	localstorageService.clearUsers();
    }
}]);
