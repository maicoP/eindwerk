angular.module('starter.controllers')
.controller('FavKotCtrl', function($scope, $stateParams,$http) {
  userdata = JSON.parse(window.localStorage['userdata']);
  $scope.loading= true;
  $http({method: "post",dataType: "jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/getFavKot.php',data : {userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
      .success(function(data, status, headers, config) {
        $scope.favKot = data;
        angular.forEach($scope.favKot, function(value, key) {
		  console.log(value);
		});
        $scope.loading= false;
        console.log(data); 
    });
});