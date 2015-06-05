angular.module('starter.controllers')
.controller('FavKotCtrl', function($scope, $stateParams,$ionicScrollDelegate,$timeout,KotService,VoteService) {

  var userdata = JSON.parse(window.localStorage['userdata']);
  var geocoder = new google.maps.Geocoder();
  var markers = new Array(); // for google markers
  var scrollTo;// for opening extra info

  $scope.loading= true;
  $scope.noResult= false;
  $scope.extraInfo= false;
  $scope.userdata = userdata;

  // get all the favorite koten of user
  KotService.getFavKoten(userdata).then(function(response){
    data = response.data;
    if(0<data['kotten'].length)
      {
        $scope.favKot = data['kotten'];
        $scope.loading= false;
        initMap();
      }
      else
      {
        $scope.loading= false;
        $scope.noResult = true;
      }
  })

  //init google map
  function initMap(){
    var mapOptions = {
        zoom: 15,
        center: $scope.favKot[0],
        draggable: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    $scope.map = new google.maps.Map(document.getElementById("favMap"), mapOptions);

  };

  // change main image
  $scope.change_image = function($event,id){
      angular.element(document.getElementById('main_image'+id)).attr("src", angular.element($event.target).attr('src'));   
  };

  $scope.vote = function(vote,kotid)
  { 
    VoteService.changeVote(userdata,vote,kotid).then(function(response){
      data = response.data;
      if(data)
      {
        window.location.reload(true);
      } 
    });
  };
  
  //open info tab
  $scope.info = function(id)
  {

    var info = document.getElementById("extraInfo");
    var kotten = document.getElementById("favKotten");
    var map = document.getElementById("favMap"); 

    $scope.kotExtra = $scope.favKot[id];
    scrollTo = angular.element(document.getElementById("card"+$scope.kotExtra.id)).prop('offsetTop')-50;
    //remove existing markers
    if(markers.length > 0)
    {
      markers[0].setMap(null);
      markers.splice(0,1);
    }
    
    var location = new Array();
    location['lat'] = $scope.favKot[id]['lat'];
    location['lng'] = $scope.favKot[id]['lng'];
    $scope.map.setCenter(location);
    $scope.map.draggable = true;

    var marker = new google.maps.Marker({
        map: $scope.map,
        animation: google.maps.Animation.DROP,
        position: location
    });
    //add to array of markers for delete
    markers.push(marker);

    angular.element(kotten).removeClass('animated fadeIn');
    angular.element(kotten).addClass('animated fadeOut'); 
    $timeout(function() {
      console.log('test');
      $scope.extraInfo = true;
      angular.element(info).removeClass('fadeOut animated '); 
      angular.element(info).addClass('fadeIn animated ');
      angular.element(map).removeClass('mapHidden fadeOut animated');
      angular.element(map).addClass('mapShow fadeIn animated');
      $ionicScrollDelegate.scrollTop();
     },500);
    
  };

  //close info tab
  $scope.closeInfo = function(id)
  {
    var info = document.getElementById("extraInfo");
    var map = document.getElementById("favMap");
    var kotten = document.getElementById("favKotten");
    $scope.map.draggable = false;

    angular.element(info).removeClass('animated fadeIn');
    angular.element(info).addClass('animated fadeOut');
    angular.element(map).removeClass('mapShow fadeIn animated');
    
    angular.element(map).addClass('fadeOut animated');
    $timeout(function() {
      $scope.extraInfo = false;
      $ionicScrollDelegate.scrollTo('center',scrollTo,false);
      angular.element(kotten).removeClass('animated fadeOut'); 
      angular.element(kotten).addClass('animated fadeIn');
      angular.element(map).addClass('mapHidden');
     },500);
  }
    
});