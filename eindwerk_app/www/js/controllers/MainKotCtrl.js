angular.module('starter.controllers', [])

.controller('MainKotCtrl', function($scope,$http,$window,$ionicScrollDelegate,$ionicLoading,$timeout,$state) {
  $scope.loading=true;
  $scope.extraInfo=false;
  $scope.noResult=false;

  var kotids = [];
  var currCenter;
  var map;
  var userdata = JSON.parse(window.localStorage['userdata']);
  $scope.user = userdata;

  getKot();

  $scope.change_image = function($event){
      angular.element(document.getElementById('main_image')).attr("src", angular.element($event.target).attr('src'));  
  };

  function setMap(location){
    var mapOptions = {
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    currCenter = location;
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    map.setCenter(location);

    var marker = new google.maps.Marker({
        map: map,
        animation: google.maps.Animation.DROP,
        position: location
    });
  };

  function getKot()
  {
    var schoolLatlng;
    var adressLatlng;
    var geocoder = new google.maps.Geocoder();
    
    $http({method: "post",dataType: "jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/getkot.php',data: {userid: userdata['id'],kotids: kotids},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          console.log(data);
          if(data['kot'] != null)
          {
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
                        lenght = google.maps.geometry.spherical.computeDistanceBetween(adressLatlng,schoolLatlng)/1000;
                        lenght = lenght.toFixed(2);
                        if(lenght <= data['filter']['distance'])
                        {
                          $scope.loading=false;
                          $scope.include='templates/card.html';
                          google.maps.event.addDomListener($window, "load",setMap(results[0].geometry.location));
                          $scope.kot = data['kot'];
                          $scope.lenght = lenght;
                          if(document.querySelectorAll('td-card')[0] !== undefined && document.querySelectorAll('td-card')[0] !== undefined){
                            document.querySelectorAll('td-card')[0].removeAttribute("style");
                          }
                          $scope.$apply();
                        }
                        else
                        {
                          kotids.push(data['kot']['id']);
                          getKot();
                        }
                    } else {
                      console.log('Geocode was not successful for the following reason: ' + status);
                  }
              });
            $scope.map = map;
          }
          else
          {
            $scope.loading = false;
            $scope.noResult = true;
          }
          
      });
  };

  $scope.vote = function(vote,kotid)
  {
    $http({method: "post",dataType: "jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/vote.php',data : {userid: userdata['id'],kotid: kotid,vote: vote},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          if(data)
          {
            getKot();
          }
      });
  };

  $scope.info = function()
  {
    $scope.extraInfo=true;
    console.log(map);
    google.maps.event.trigger(map, 'resize');
    map.setCenter(currCenter);
    var info = document.getElementById('extraInfo');
    var openInfo = document.getElementById('openInfo');
    var closeInfo = document.getElementById('closeInfo');
  };

  $scope.closeInfo = function()
  {
    $scope.extraInfo=false;
    var info = document.getElementById('extraInfo');
    var openInfo = document.getElementById('openInfo');
    var closeInfo = document.getElementById('closeInfo');
  };

  $scope.cardSwipedLeft = function(id) {
    $timeout.cancel(timeout);// in case the drage event gets fired
    $scope.vote('dislike',id);
  };

  $scope.cardSwipedRight = function(id) {
    $timeout.cancel(timeout);// in case the drage event gets fired
    $scope.vote('like',id);
  };

  // in case swipe is slow and not recognized as a swipe
  var timeout;
  $scope.onDragLeft= function(id){
      if(document.querySelectorAll('td-card')[0].getBoundingClientRect()['left'] < -75)
      {
        $timeout.cancel(timeout);
        timeout = $timeout(function() {
          $scope.vote('dislike',id);
        }, 800);
      }
  };

  $scope.onDragRight= function(id){
    if(document.querySelectorAll('td-card')[0].getBoundingClientRect()['right'] > 435)
    {
      $timeout.cancel(timeout);
      timeout = $timeout(function() {
        $scope.vote('like',id);
      }, 800);
    }
  };

});