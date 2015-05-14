angular.module('starter.controllers')
.controller('StartCtrl', function($scope,$location,$http) {
  $scope.loading = true;
  if(window.localStorage.hasOwnProperty('userdata'))
  {
      userdata = JSON.parse(window.localStorage['userdata']);
      $http({method: "post",dataType: "jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/checkUser.php',data : {userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          if(data.succes)
          {
            $location.path('/main');
          }
          else
          {
            $scope.loading = false;
          }  
      });   
  }
  else
  {
    $scope.loading = false;
  }
});