unlimty.controller('homeCtrl', function ($scope, services, projects, autocomplete, toastr, $timeout, localstorageService) {
  cont = 4;
  $scope.autocomplete = autocomplete;
  $scope.projects1 = projects.slice(0,cont);
  
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
    location.href = '#/donations/' + idproject;
  }

  $scope.like_project = function(idproject){
    $token_log = localStorage.getItem("token");
    $token_log = JSON.parse($token_log);

    if(!$token_log){

      toastr.error('Inicia sesión', 'Error',{
        closeButton: true
      });
      $timeout( function(){
        location.href = '#/login';
      }, 3000 );

    }else{

      services.post('home','select_IDuser',{'token_log': $token_log}).then(function (IDuser) {
        $IDuser = IDuser[0].IDuser;

        services.post('login','favs_project_validate',{'idproject': idproject, 'token_log': $token_log, 'IDuser': $IDuser}).then(function (response) {
          $new_token_log = response.new_token[0].token_log;
          localstorageService.setUsers($new_token_log);

          if(response[0].num != '0' ){
            toastr.error('Ya está en tus favoritos', 'Error',{
              closeButton: true
            });

          }else{
            services.post('login','favs_project_insert',{'idproject': idproject, 'token_log': $new_token_log}).then(function (response2) {
              
              if(response2){
                toastr.success('Añadido a tus favoritos', 'Perfecto',{
                  closeButton: true
                });
              }

            });
          }
        });
      });

    }
  }

  $scope.details_home = function(idproject){
    console.log(idproject);
    $timeout( function(){
      location.href = '#/details'+idproject;
    }, 20 );
  }

  $scope.api_prod = function(type){
    console.log(type);
    location.href = '#/donations/api/' + type;
  }
    

});

unlimty.controller('detailsCtrl', function ($scope, services, toastr, $timeout, idproject) {

  services.post('home','load_details',{'idproject': idproject}).then(function (response) {
    $scope.details = response;
  });

  $scope.home = function(){
    $timeout(function(){
      location.href = '#/donations';
    }, 20 );
  }

});

unlimty.controller('menuCtrl', function(loginService) {
  loginService.login();
});
