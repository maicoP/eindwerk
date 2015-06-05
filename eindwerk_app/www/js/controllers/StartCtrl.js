angular.module('starter.controllers')
.controller('StartCtrl', function($scope,$location,UserService) {
  $scope.loading = true;

  // if user has user data in local storage and it matches its values in db then user still logdin else show tutorial page
  if(window.localStorage.hasOwnProperty('userdata'))
  {
      userdata = JSON.parse(window.localStorage['userdata']);
      UserService.checkUser(userdata).then(function(response){
        data = response.data;
        if(data.succes)
        {
          $location.path('/main');
        }
        else
        {
          $scope.loading = false;
        } 
      }) 
  }
  else
  {
    $scope.loading = false;
  }
});