var unlimty = angular.module('unlimty',['ngRoute', 'toastr' ,'ui.bootstrap']);
unlimty.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            //home
            .when("/", {templateUrl: "frontend/modules/home/view/home.view.html", controller: "homeCtrl",
                resolve: {
                    projects: function (services) {
                        return services.get('home','top_projects');
                    },
                    autocomplete: function (services) {
                        return services.get('home','load_auto_name');
                    }
                }
            })

            // Contact
            .when("/contact", {templateUrl: "frontend/modules/contact/view/contact.view.html", controller: "contactCtrl"})

            // Donations
            .when("/donations", {templateUrl: "frontend/modules/donations/view/donations.view.html", controller: "donationsCtrl",
                resolve: {
                    all_projects: function (services) {
                        return services.get('donations','all_projects');
                    }
                }
            })

            .when("/donations/:id", {
                templateUrl: "frontend/modules/donations/view/donations.view.html",
                controller: "donationsOneCtrl",
                resolve: {
                    one_project: function (services, $route) {
                        return services.get('donations', 'load_project', $route.current.params.id);
                    }
                }
            })

            // Login
            .when("/login", {templateUrl: "frontend/modules/login/view/login.view.html", controller: "loginCtrl"
            })

            .when("/login/active_user/:token", {
                resolve: {
                    activate: function (services, $route) {
                        return services.put('login','active_user',{'token':JSON.stringify({'token':$route.current.params.token})})
                        .then(function(response){
                            console.log(response);
                            location.href = '#/login';
                        });
                    }
                }
            })

            .when("/login:logout", {
                resolve: {
                    logout: function (localstorageService, $timeout, toastr) {
                        toastr.info('Sesión cerrada', 'LogOut',{
                            closeButton: true
                        });
                        $timeout( function(){
                            localstorageService.clearSUsers();
                            localstorageService.clearUsers();
                            location.href = '#/home';
                        }, 2000 );
                    }
                }
            })

            .when("/login/social/:token_log", {templateUrl: "frontend/modules/login/view/login.view.html", 
                resolve: {
                    social_token: function ($route, toastr, localstorageService, $timeout, loginService) {
                        //return ($route.current.params.token_log);
                        var social_token = $route.current.params.token_log;
                        console.log(social_token);
                        var test = social_token;
                    
                        if((social_token) && (social_token === test)) {
                            test = "no";
                            localstorageService.setUsers(social_token);
                            toastr.success('Inicio de sesion correcto', 'Perfecto',{
                                closeButton: true
                            });
                            $timeout( function(){
                                loginService.login();
                                location.href = '#/home';
                                //localstorageService.clearUsers();
                            }, 200 );
                        }
                        
                    }
                }
            })

            .when("/login/recover_password/:token", {templateUrl: "frontend/modules/login/view/recover_password.view.html", controller: "changepassCtrl"
            })

            // Profile
            .when("/profile", {templateUrl: "frontend/modules/login/view/profile.view.html", controller: "profileCtrl"
            })


            



            .otherwise("/", {templateUrl: "frontend/modules/home/view/home.view.html", controller: "homeCtrl"});

    }]);


