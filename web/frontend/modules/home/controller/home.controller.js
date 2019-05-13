unlimty.controller('homeCtrl', function ($scope, services, projects, autocomplete) {
    cont = 4;
    $scope.autocomplete = autocomplete;
    var percent = [];
    $scope.projects1 = projects.slice(0,cont);
    console.log(projects);
    console.log(autocomplete);

    console.log((projects[10].ProDonate*100)/projects[10].ProPrice);

    console.log(projects.length)

    for ($i = 0; $i < projects.length; $i++){
        percent.push({"ProPercent": (projects[$i].ProDonate*100)/projects[$i].ProPrice});
        //console.log($scope.percent);
    }

    
    $scope.showMore = function(){
        cont=cont+2;
        $scope.projects1 = projects.slice(0,cont);
        if (cont == 8) {
          var prov = document.querySelector('#click_scroll');
          prov.remove();
        }
    }

    $scope.ProjectSearch = function(){
        if ($scope.ProjectName.name) {
          name = $scope.ProjectName.name;
        }else if($scope.ProjectName){
          name = $scope.ProjectName;
        }else{
          console.log("hola2")
        }
        if (name) {
          location.href = '#/donations/' + name;
        }
    }

    $scope.ProjectDonate = function(idproject){
      //console.log(idproject);
      location.href = '#/donations/' + idproject;
    }


    

});
