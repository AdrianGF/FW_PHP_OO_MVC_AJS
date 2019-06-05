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
                    //console.log("user");
                    $rootScope.login_type = false;
                    $rootScope.profile_type = true;
                    $rootScope.logout_type = true;

	            } else if (type === '0') {
                    //console.log("admin");
                    $rootScope.login_type = false;
                    $rootScope.profile_type = true;
                    $rootScope.logout_type = true;
	            }else{
                    $rootScope.login_type = true;
                    $rootScope.logout_type = false;
                }


            });
        } else {
            $rootScope.login_type = true;
        }
    }

    function logout() {
    	localstorageService.clearUsers();
    }
}]);
