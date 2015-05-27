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
    
    $http({method: "get",dataType: "jsonp",url:'http://kotterapp.be/api/getKot',params: {userid: userdata['id'],kotids: kotids},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          console.log(data);
          if(data['kot'] == false)
          {
            $scope.loading = false;
            $scope.noResult = true;
            
          }
          else
          {
            $scope.include='templates/card.html';
            var location = new Array();
            location['lat'] = data['kot']['lat'];
            location['lng'] = data['kot']['lng'];
            google.maps.event.addDomListener($window, "load",setMap(location));
            $scope.kot = data['kot'];
            $scope.lenght = data['kot']['distance'];
            if(document.querySelectorAll('td-card')[0] !== undefined && document.querySelectorAll('td-card')[0] !== undefined){
              document.querySelectorAll('td-card')[0].removeAttribute("style");
            }
            $scope.loading=false;
          }
          
      });
  };

  $scope.vote = function(vote,kotid)
  {
    $http({method: "get",dataType: "jsonp",url:'http://kotterapp.be/api/vote',params : {userid: userdata['id'],kotid: kotid,vote: vote},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          if(data)
          {
            console.log('test');
            $scope.loading = true;
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

  var timeout;
  $scope.onRelease = function(id)
  {
    console.log(document.querySelectorAll('td-card')[0].getBoundingClientRect()['right']);
    if(document.querySelectorAll('td-card')[0].getBoundingClientRect()['right'] > 435)
    {

      $timeout.cancel(timeout);
      timeout = $timeout(function() {
        $scope.vote('like',id);
      }, 800);
    }

    if(document.querySelectorAll('td-card')[0].getBoundingClientRect()['left'] < -75)
      {
        $timeout.cancel(timeout);
        timeout = $timeout(function() {
          $scope.vote('dislike',id);
        }, 800);
      }
  }

});