unlimty.controller('homeCtrl', function ($scope, services, projects, autocomplete, toastr) {
    cont = 4;
    $scope.autocomplete = autocomplete;
    $scope.projects1 = projects.slice(0,cont);
    console.log(projects[0].percent);
  
    
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
        }
        if (name) {
          location.href = '#/donations/' + name;
        }
    }

    $scope.ProjectDonate = function(idproject){
      //console.log(idproject);
      location.href = '#/donations/' + idproject;
    }

    $scope.like_project = function(idproject){
      $token_log = localStorage.getItem("token");
      $token_log = JSON.parse($token_log);


      services.post('login','favs_project_validate',{'idproject': idproject, 'token_log': $token_log}).then(function (response) {
        console.log(response);
        if(response[0].num != '0' ){
					toastr.error('Ya está en tus favoritos', 'Error',{
            closeButton: true
          });
        }else{
          
          services.post('login','favs_project_insert',{'idproject': idproject, 'token_log': $token_log}).then(function (response2) {
            console.log(response2);
            if(response2){
              toastr.success('Añadido a tus favoritos', 'Perfecto',{
                closeButton: true
              });
            }
          });

        }
        
      });

    }
    

});

unlimty.controller('menuCtrl', function(loginService) {
  loginService.login();
});
