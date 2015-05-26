angular.module('starter.controllers')
.controller('StartCtrl', function($scope,$location,$http) {
  $scope.loading = true;
  if(window.localStorage.hasOwnProperty('userdata'))
  {
      userdata = JSON.parse(window.localStorage['userdata']);
      $http({method: "get",dataType: "jsonp",url:'http://kotterapp.be/api/checkuser',params : {userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          if(data.succes)
          {
            $location.path('/main');
          }
          else
          {
            $scope.loading = false;
            console.log($scope.loading);
          }  
      });   
  }
  else
  {
    $scope.loading = false;
    console.log($scope.loading);
  }
});