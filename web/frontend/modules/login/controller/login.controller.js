unlimty.controller('loginCtrl', function ($scope, services, toastr, localstorageService, $timeout, loginService) {

	$scope.inputType1 = 'password';
	$scope.inputType2 = 'password';
	//console.log(api_key.get_key('auth0'));

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
		            location.href = '#/home';
		        }, 1500 );
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
					toastr.info('Revise el correo electrónico', 'Activación',{
						closeButton: true
					});
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

	$scope.recPass = function(){
		var user = this.recover.rpuser
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

unlimty.controller('profileCtrl', function ($scope, services, localstorageService, load_pais_prov_poblac, toastr, $timeout, loginService) {
  


	var token_log = localstorageService.getUsers();
	//console.log(token_log);

	services.post('login','user_info',{'token_log':token_log}).then(function (response) {
		console.log(response);
		$scope.info_user = response[0];
		
		if($scope.info_user){
			services.post('login','user_favs',{'IDuser': $scope.info_user.user }).then(function (favs) {
				console.log(favs);
				
				if(favs){
					console.log(favs[0].idproject);
					idproject = favs[0].idproject;

					services.post('login','favs_project',{'idproject': idproject }).then(function (project) {
						console.log(project);
						
						if(project){
							$scope.project = project;
							$scope.currentPage = 1;
							$scope.project_page = $scope.project.slice(0,4);
							$scope.bootpageV = true;
							
							$scope.pageChanged = function() {
								var startPos = ($scope.currentPage - 1) * 4;
								$scope.project_page = $scope.project.slice(startPos, startPos + 4);
								console.log($scope.currentPage);
							};

						}else{
							$scope.info_favs = "No tines favoritos.";
						}
						
						
					});

				}else{
					toastr.error('Favoritos no encontrados', 'Error',{
						closeButton: true
					});
				}
				
			});
		}else{
			toastr.error('Datos de usuarios no encontrados', 'Error',{
				closeButton: true
			});
		}
		

	});




    


	//rellenar pais, provincias y poblaciones
    load_pais_prov_poblac.load_pais()
    .then(function (response) {
		//console.log(response);
        if(response.success){
            $scope.paises = response.datas;
        }else{
            $scope.AlertMessage = true;
            $scope.pais_error = "Error al recuperar la informacion de paises";
            $timeout(function () {
                $scope.pais_error = "";
                $scope.AlertMessage = false;
            }, 8000);
        }
	});
	
	$scope.resetPais = function () {
        //console.log(this.pais);
        if (this.pais.sISOCode == 'ES') {
            load_pais_prov_poblac.loadProvincia()
            .then(function (response) {
                if(response.success){
                    $scope.provincias = response.datas;
                }else{
                    $scope.AlertMessage = true;
                    $scope.prov_error = "Error al recuperar la informacion de provincias";
                    $timeout(function () {
                        $scope.prov_error = "";
                        $scope.AlertMessage = false;
                    }, 2000);
                }
            });
            $scope.poblaciones = null;
        }else {
            //$scope.provincias = null;
            //$scope.poblaciones = null;
        }
	};
	
	$scope.resetValues = function () {
        var datos = {idPoblac: this.provincia.id};
        load_pais_prov_poblac.loadPoblacion(datos)
        .then(function (response) {
            if(response.success){
                $scope.poblaciones = response.datas;
            }else{
                $scope.AlertMessage = true;
                $scope.pob_error = "Error al recuperar la informacion de poblaciones";
                $timeout(function () {
                    $scope.pob_error = "";
                    $scope.AlertMessage = false;
                }, 2000);
            }
        });
    };


	//dropzone
    $scope.dropzoneConfig = {
        'options': {
            'url': 'backend/index.php?module=login&function=upload_avatar',
            addRemoveLinks: true,
            maxFileSize: 1000,
            dictResponseError: "Ha ocurrido un error en el server",
            acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.rar,application/pdf,.psd'
        },
        'eventHandlers': {
            'sending': function (file, formData, xhr) {},
            'success': function (file, response) {
                console.log(response);
                response = JSON.parse(response);
                //console.log(response);
                if (response.resultado) {
                    $(".msg").addClass('msg_ok').removeClass('msg_error').text('Success Upload image!!');
                    $('.msg').animate({'right': '300px'}, 300);

					//console.log(response.name);
					$scope.nameAvatar = response.name;
                    $scope.avatar = response.datos;
					//console.log($scope.avatar);

                    loginService.login();
                } else {
                    $(".msg").addClass('msg_error').removeClass('msg_ok').text(response['error']);
                    $('.msg').animate({'right': '300px'}, 300);
                }
            },
            'removedfile': function (file, serverFileName) {
                if (file.xhr.response) {
                    $('.msg').text('').removeClass('msg_ok');
                    $('.msg').text('').removeClass('msg_error');
                    var data = jQuery.parseJSON(file.xhr.response);
                    services.post("login", "delete_avatar", JSON.stringify({'filename': data}));
                }
            }
    }};
	
	$scope.submit = function () {
		var avatar = $scope.nameAvatar;
        var prov = null;
        var pob = null;
        var token = localstorageService.getUsers();

        if(this.pais.sISOCode === 'ES'){
            if (!this.provincia.nombre) {
                prov = "";
            }else{ 
                prov = this.provincia.nombre;
            }
    
            if (!this.poblacion.poblacion) {
                pob = " ";
            }else{
                pob = this.poblacion.poblacion;
            }
        }

        var data = {"IDuser": $scope.info_user.user ,"Name": this.profile.Name, "Surname1": this.profile.Surname1, "Surname2": this.profile.Surname2, "Birthday": this.profile.Birthday, "Country": this.pais.sName, "Province": prov, "City": pob, "Token_log": token, "Avatar": avatar };
        var data1 = JSON.stringify(data);
        console.log(data1);

        services.put("login", "edit_profile", data1).then(function (response) { 
			//var avatar = response.datos[0].avatar;
			console.log(avatar);
			//console.log(response);
			toastr.success('Cambios guardados correctamante', 'Perfecto',{
				closeButton: true
			});
			$timeout( function(){
				location.href = '#/';
			}, 3000 );
        });

	};

});
