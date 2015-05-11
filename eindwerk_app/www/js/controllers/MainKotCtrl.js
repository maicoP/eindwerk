angular.module('starter.controllers', [])

.controller('MainKotCtrl', function($scope,$http,$window,$ionicScrollDelegate,$ionicLoading,$timeout) {
    
  userdata = JSON.parse(window.localStorage['userdata']);
  $scope.change_image = function($event){
      console.log(document.getElementById('main_image'));
      console.log(angular.element(document.getElementById('main_image')).attr("src"));
      angular.element(document.getElementById('main_image')).attr("src", angular.element($event.target).attr('src'));
      
  };
  var currCenter;
  var schoolLatlng;
  var adressLatlng;
  var myLatlng = new google.maps.LatLng(51.301137, 4.733754);
  var mapOptions = {
      center: myLatlng,
      zoom: 16,
      mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById("map"), mapOptions);
  var geocoder = new google.maps.Geocoder();
  $http({method: "post",dataType: "jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/getkot.php',data: {userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
      .success(function(data, status, headers, config) {
        console.log(data);
        $scope.kot = data['kot'];
        adress = $scope.kot.city+' '+$scope.kot.zipcode+' '+$scope.kot.streatname+' '+$scope.kot.housenumber;

        geocoder.geocode( { 'address':  userdata['school']}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                  schoolLatlng = results[0].geometry.location;
              } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });

         geocoder.geocode( { 'address': adress}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                  adressLatlng = results[0].geometry.location;
                  map.setCenter(results[0].geometry.location);
                  currCenter = results[0].geometry.location;
                          var marker = new google.maps.Marker({
                              map: map,
                              animation: google.maps.Animation.DROP,
                              position: results[0].geometry.location
                          });
                  $scope.lenght = google.maps.geometry.spherical.computeDistanceBetween(adressLatlng,schoolLatlng)/1000;
                  $scope.lenght = $scope.lenght.toFixed(2);
              } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });

        $scope.map = map;
    });

  $scope.vote = function(vote,kotid)
  {
    
    $http({method: "post",dataType: "jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/vote.php',data : {userid: userdata['id'],kotid: kotid,vote: vote},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          if(data)
          {
            $window.location.reload(true);
          }
      });
  }

  $scope.info = function()
  {
    var info = document.getElementById('extraInfo');
    var openInfo = document.getElementById('openInfo');
    var closeInfo = document.getElementById('closeInfo');
    $ionicScrollDelegate.scrollBottom(true);
    google.maps.event.trigger($scope.map, 'resize');
    $scope.map.setCenter(currCenter);
    angular.element(info).removeClass('hidden'); 
    angular.element(closeInfo).removeClass('hidden'); 
    angular.element(openInfo).addClass('hidden');
    angular.element(info).removeClass('animated fadeOutUp'); 
    angular.element(info).addClass('animated fadeInDown'); 
  }
  $scope.closeInfo = function()
  {
    var info = document.getElementById('extraInfo');
    var openInfo = document.getElementById('openInfo');
    var closeInfo = document.getElementById('closeInfo');

    angular.element(info).removeClass('animated fadeInDown');
    angular.element(info).addClass('animated fadeOutUp');
    angular.element(closeInfo).addClass('hidden');
    $ionicScrollDelegate.scrollTop(true); 
    $timeout(function() {
      angular.element(info).addClass('hidden');
      angular.element(openInfo).removeClass('hidden');
     },200);
  }
});