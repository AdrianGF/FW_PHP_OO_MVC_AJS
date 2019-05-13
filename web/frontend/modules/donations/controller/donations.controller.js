unlimty.controller('donationsCtrl', function ($scope, services, all_projects) {

    
    $scope.all_projects_data = all_projects;
    
    console.log(all_projects);

});

unlimty.controller('donationsOneCtrl', function ($scope, services, one_project) {
    
    console.log(one_project);

});
