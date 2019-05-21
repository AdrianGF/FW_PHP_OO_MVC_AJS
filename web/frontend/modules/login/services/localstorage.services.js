unlimty.factory("localstorageService", ['$timeout', '$filter', '$q', function ($timeout, $filter, $q) { 
	var service = {};
	service.getUsers = getUsers;
    service.setUsers = setUsers;
    service.clearUsers = clearUsers;
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

}]);
