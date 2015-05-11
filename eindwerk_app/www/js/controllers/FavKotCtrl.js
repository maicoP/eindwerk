angular.module('starter.controllers')
.controller('FavKotCtrl', function($scope, $stateParams,$http) {
  userdata = JSON.parse(window.localStorage['userdata']);
  $http({method: "post",dataType: "jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/getFavKot.php',data : {userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
      .success(function(data, status, headers, config) {
        $scope.favKot = data;
        console.log(data); 
    });
});