var unlimty = angular.module('unlimty',['ngRoute', 'ui.bootstrap']);
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
    }]);


