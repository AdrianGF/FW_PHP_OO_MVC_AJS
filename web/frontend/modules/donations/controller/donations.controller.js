unlimty.controller('donationsCtrl', function ($scope, services, all_projects, $timeout, autocomplete) {

    $scope.autocomplete = autocomplete;
    $scope.all_projects = all_projects;
    $scope.currentPage = 1;
    $scope.project_page = $scope.all_projects.slice(0,4);
    $scope.bootpageV = true;

    
    console.log(all_projects);

    $scope.ProjectSearch = function(){
        //console.log();
        if ($scope.ProjectName.name) {
          name = $scope.ProjectName.name;
        }else if($scope.ProjectName){
          name = $scope.ProjectName;
        }
        if (name) {
          location.href = '#/donations/' + name;
        }
    }
    
    $scope.pageChanged = function() {
        var startPos = ($scope.currentPage - 1) * 4;
        $scope.project_page = $scope.all_projects.slice(startPos, startPos + 4);
        console.log($scope.currentPage);
    };

    $scope.details_donations = function(idproject){
        console.log(idproject);
        $timeout( function(){
          location.href = '#/details'+idproject;
        }, 20 );
      }

});

unlimty.controller('donationsOneCtrl', function ($scope, services, one_project, $timeout) {
    
    $scope.all_projects = one_project;
    $scope.currentPage = 1;
    $scope.project_page = $scope.all_projects.slice(0,4);
    $scope.bootpageV = true;

    
    //console.log(all_projects);

    $scope.details_donations = function(one_project){
      console.log(one_project);
      $timeout( function(){
        location.href = '#/details'+one_project;
      }, 20 );
    }
    
    $scope.pageChanged = function() {
        var startPos = ($scope.currentPage - 1) * 4;
        $scope.project_page = $scope.all_projects.slice(startPos, startPos + 4);
        console.log($scope.currentPage);
    };
    
    console.log($scope.all_projects);


});


