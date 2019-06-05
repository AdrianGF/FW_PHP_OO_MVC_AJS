unlimty.factory("localstorageService", ['$timeout', '$filter', '$q', 'api_key', function ($timeout, $filter, $q, api_key) { 
	var service = {};
	service.getUsers = getUsers;
    service.setUsers = setUsers;
    service.clearUsers = clearUsers;
    service.clearSUsers = clearSUsers;
	return service;

    function getUsers() {
        if(!localStorage.token){
            localStorage.token = JSON.stringify(false);
        }
        return JSON.parse(localStorage.token);
    }
    
    function setUsers(token) {
        localStorage.token = JSON.stringify(token);
    }
    
    function clearUsers() {
        localStorage.token = JSON.stringify(false);
    }

    function clearSUsers() {
        var ID_client = api_key.get_key('auth0')

        var webAuth = new auth0.WebAuth({
            domain:       'dev-iqc252su.eu.auth0.com',
            clientID:     ID_client
        });
          
        webAuth.logout({
            returnTo: 'http://localhost/framework/FW_PHP_OO_MVC_AJS/web/',
            client_id: ID_client
        });



    }

}]);
