unlimty.controller('donationsCtrl', function ($scope, services, all_projects) {

    
    $scope.all_projects = all_projects;
    $scope.currentPage = 1;
    $scope.project_page = $scope.all_projects.slice(0,4);
    $scope.bootpageV = true;

    
    console.log(all_projects);
    
    $scope.pageChanged = function() {
        var startPos = ($scope.currentPage - 1) * 4;
        $scope.project_page = $scope.all_projects.slice(startPos, startPos + 4);
        console.log($scope.currentPage);
    };

});

unlimty.controller('donationsOneCtrl', function ($scope, services, one_project) {
    
    $scope.one_project_data = one_project;
    
    console.log(one_project);


});
