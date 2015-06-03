angular.module('starter.controllers')
.controller('FavKotCtrl', function($scope, $stateParams,$http,$ionicScrollDelegate,$timeout) {
  var userdata = JSON.parse(window.localStorage['userdata']);
  var geocoder = new google.maps.Geocoder();
  $scope.loading= false;
  $scope.noResult= false;
  $scope.userdata = userdata;

  $http({method: "get",dataType: "jsonp",url:'http://kotterapp.be/api/favkotten',params : {userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
    .success(function(data, status, headers, config) {
      if(0<data['kotten'].length)
      {
        $scope.favKot = data['kotten'];
        $scope.loading= false;
      }
      else
      {
        console.log('test');
        $scope.loading= false;
        $scope.noResult = true;
      }
  });
  $scope.change_image = function($event,id){
      angular.element(document.getElementById('main_image'+id)).attr("src", angular.element($event.target).attr('src'));
      
  };

  $scope.vote = function(vote,kotid)
  {
    
    $http({method: "get",dataType: "jsonp",url:'http://kotterapp.be/api/changevote',params : {userid: userdata['id'],kotid: kotid,vote: vote},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          if(data)
          {
            window.location.reload(true);
          }
      });
  };

  $scope.info = function(id)
  {
    var mapOptions = {
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementsByClassName("map"+id)[0], mapOptions);

    var info = document.getElementById("extraInfo"+id);
    var openInfo = document.getElementById("openInfo"+id);
    var closeInfo = document.getElementById("closeInfo"+id);

    var location = new Array();
    location['lat'] = $scope.favKot[id]['lat'];
    location['lng'] = $scope.favKot[id]['lng'];

    map.setCenter(location);
    var marker = new google.maps.Marker({
        map: map,
        animation: google.maps.Animation.DROP,
        position: location
    });
    google.maps.event.trigger(map, "resize");
    map.setCenter($scope.favKot[id]['location']);
    angular.element(info).removeClass('hidden'); 
    angular.element(closeInfo).removeClass('hidden'); 
    angular.element(openInfo).addClass('hidden');
    angular.element(info).removeClass('animated fadeOutUp'); 
    angular.element(info).addClass('animated fadeInDown');
    var scroll = angular.element(document.getElementById("card"+id)).prop('offsetTop') + document.getElementById("card"+id).getBoundingClientRect()['height']-600;
    $ionicScrollDelegate.scrollTo('center',scroll,true); 
  };

  $scope.closeInfo = function(id)
  {
    var info = document.getElementById("extraInfo"+id);
    var openInfo = document.getElementById("openInfo"+id);
    var closeInfo = document.getElementById("closeInfo"+id);
    $ionicScrollDelegate.scrollTo('center',angular.element(document.getElementById("card"+id)).prop('offsetTop')-50,true);
    angular.element(info).removeClass('animated fadeInDown');
    angular.element(info).addClass('animated fadeOutUp');
    angular.element(closeInfo).addClass('hidden');
    $timeout(function() {
      var scroll =angular.element(document.getElementById("card"+id)).prop('offsetTop')-50;
      $ionicScrollDelegate.scrollTo('center',scroll,true);
      angular.element(openInfo).removeClass('hidden');
      angular.element(info).addClass('hidden');
     },200);
  }
    
});