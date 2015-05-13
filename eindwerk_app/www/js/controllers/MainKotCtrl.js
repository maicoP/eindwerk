angular.module('starter.controllers', [])

.controller('MainKotCtrl', function($scope,$http,$window,$ionicScrollDelegate,$ionicLoading,$timeout) {
  $scope.loading=true;
  userdata = JSON.parse(window.localStorage['userdata']);
  $scope.change_image = function($event){
      angular.element(document.getElementById('main_image')).attr("src", angular.element($event.target).attr('src'));  
  };
  var kotids = [];
  var currCenter;
  getKot();
  function getKot()
  {
      
    var schoolLatlng;
    var adressLatlng;
    var mapOptions = {
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    var geocoder = new google.maps.Geocoder();
    $http({method: "post",dataType: "jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/getkot.php',data: {userid: userdata['id'],kotids: kotids},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          console.log(data);
          adress = data['kot']['city']+' '+data['kot']['zipcode']+' '+data['kot']['streatname']+' '+data['kot']['housenumber'];

          geocoder.geocode( { 'address':  userdata['school']}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                    schoolLatlng = results[0].geometry.location;
                } else {
                  console.log('Geocode was not successful for the following reason: ' + status);
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
                    lenght = google.maps.geometry.spherical.computeDistanceBetween(adressLatlng,schoolLatlng)/1000;
                    lenght = lenght.toFixed(2);
                    if(lenght <= data['filter']['distance'])
                    {
                      $scope.loading=false;
                      $scope.kot = data['kot'];
                      $scope.lenght = lenght;
                      $scope.$apply();
                    }
                    else
                    {
                      kotids.push(data['kot']['id']);
                      console.log(kotids);
                      getKot();
                    }
                } else {
                  console.log('Geocode was not successful for the following reason: ' + status);
              }
          });

          $scope.map = map;
      });
  }


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