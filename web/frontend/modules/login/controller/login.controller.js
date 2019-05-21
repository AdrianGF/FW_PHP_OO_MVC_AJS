unlimty.controller('loginCtrl', function ($scope, services, toastr, localstorageService, $timeout, loginService, googleService) {

	$scope.inputType1 = 'password';
	$scope.inputType2 = 'password';


	$scope.hideShowPassword1 = function(){
		if ($scope.inputType1 == 'password'){
			$scope.inputType1 = 'text';
		}else{
			$scope.inputType1 = 'password';
		}
	};

	$scope.hideShowPassword2 = function(){
		if ($scope.inputType2 == 'password'){
			$scope.inputType2 = 'text';
		}else{
			$scope.inputType2 = 'password';
		}
	};

	
	$scope.submitLogin = function(){
		services.put('login','validate_login',{'login_data':JSON.stringify({'login_user':$scope.login.login_user,'login_password':$scope.login.login_password})})
		.then(function (response) {
			console.log(response);
			if (response.valido) {
					localstorageService.setUsers(response.token_log);
					toastr.success('Inicio de sesion correcto', 'Perfecto',{
                    closeButton: true
                });
                $timeout( function(){
                	loginService.login();
		            //location.href = '.';
		        }, 3000 );
			}else{
				if (response.error.login_user) {
					toastr.error(response.error.login_user, 'Error invalid user',{
	                	closeButton: true
	            	});
				}

				if (response.error.login_password) {
					toastr.error(response.error.login_password, 'Error datos incorrectos',{
	                	closeButton: true
	            	});
				}
			}
		});
	};
	

    $scope.submitRegister = function(){
		var data = {'reg_user':$scope.register.reg_user,'reg_email':$scope.register.reg_email,'reg_password':$scope.register.reg_password};
		services.post('login','validate_register',{'reg_data':JSON.stringify(data)}).then(function (response) {
			console.log(response);
			if (response.valido) {
				localstorageService.setUsers(response.tokenlog);
				toastr.success('Registrado correctamente', 'Success',{
					closeButton: true
				});
				$timeout( function(){
		            location.href = '#/';
		        }, 3000 );
			}else{
				//console.log(response.error);
				if (response.error.reg_user) {
					toastr.error(response.error.reg_user, 'Error invalid user',{
	                	closeButton: true
	            	});
				}
				if (response.error.reg_email) {
					toastr.error(response.error.reg_email, 'Error invalid email',{
	                	closeButton: true
	            	});
				}
				if (response.error.reg_password) {
					toastr.error(response.error.reg_password, 'Error invalid password',{
	                	closeButton: true
	            	});
				}
			}

		});
	}

	$scope.logGoogle = function(){
		googleService.login();
	};


	$scope.recPass = function(){
		var user = $scope.recover.rpuser
		services.post('login','recover_pass_email',{'rpuser':JSON.stringify(user)}).then(function (response) {
			console.log(response);
			if (response.valido === true) {
				toastr.success('Revisa tu correo electronico', 'Perfecto',{
                    closeButton: true
                });
                $timeout( function(){
		            location.href = '#/';
		        }, 3000 );
			}else{
				toastr.error(response.error.rpuser, 'Error',{
                	closeButton: true
            	});
			}
		});
	}
    
});

unlimty.controller('changepassCtrl', function($scope,services,$route,toastr,$timeout) {
	$scope.submitRecPass = function(){
		services.put('login','update_password',
		{'rec_pass':JSON.stringify({'rec_password':$scope.recpass.inputPassword,'token':$route.current.params.token})})
		.then(function (response) {
			console.log(response);
			if (response === 'true') {
					toastr.success('Contraseña cambiada correctamente', 'Perfecto',{
					closeButton: true
				});
				$timeout( function(){
					location.href = '#/login';
				}, 3000 );
			}else{
				toastr.error('Error al cambiar la contraseña', 'Error',{
					closeButton: true
				});
			}
		});
	}
});
