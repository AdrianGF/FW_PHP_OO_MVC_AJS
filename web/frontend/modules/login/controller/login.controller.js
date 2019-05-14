unlimty.controller('loginCtrl', function ($scope, services, toastr) {

    console.log("hola");

    $scope.submitRegister = function(){
		var data = {'ruser':$scope.register.inputUser,'remail':$scope.register.inputEmail,'rpasswd':$scope.register.inputPassword};
		services.post('login','validate_register',{'total_data':JSON.stringify(data)}).then(function (response) {
			if (response.success) {
					toastr.success('Revisa tu correo electronico', 'Perfecto',{
                    closeButton: true
                });
                $timeout( function(){
		            location.href = '#/';
		        }, 3000 );
			}else{
				toastr.error(response.error.ruser, 'Error',{
                	closeButton: true
            	});
			}
		});
    }
    
    
});
