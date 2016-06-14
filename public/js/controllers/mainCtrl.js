// public/js/controllers/mainCtrl.js

angular.module('mainCtrl', [])
.controller('mainController', function($scope, $http, User) {
    // object to hold all the data for the new comment form
    $scope.userData = {};
    $scope.frm_login = true;
    // loading variable to show the spinning loading icon
    $scope.loading = true;
    $scope.map1 ;
    $scope.markers = [];

    
    
    // get all the comments first and bind it to the $scope.comments object
    // use the function we created in our service
    // GET ALL COMMENTS ==============
    $scope.viewSingleUser = false;
    $scope.myFunction = function(id) {
       User.individualUser(id)
        .success(function(data) {
            $scope.single = data.data;
            $scope.viewSingleUser = !$scope.viewSingleUser;
            console.log($scope.single);
        });
    };

    $scope.getLogin = function(user) {
        $scope.userData = angular.copy(user);

            User.login($scope.userData)
            .success(function(data) {

            $scope.userInfo = data.data;
            console.log($scope.userInfo);
            $scope.map = !$scope.map;
            $scope.frm_login = !$scope.frm_login;
            
            User.get()
            .success(function(data) {
                $scope.users = data.data;
                console.log($scope.users);
            });
             var myLatLng = new google.maps.LatLng($scope.userInfo. latitude, $scope.userInfo.longitude);
            var mapOptions = {
            zoom: 4,
            center: myLatLng,
            mapTypeId: google.maps.MapTypeId.TERRAIN
             };

            $scope.map1 = new google.maps.Map(document.getElementById('map1'), mapOptions);

            marker = createMarker(myLatLng,"me","http://maps.google.com/mapfiles/ms/icons/red-dot.png");
            marker.setMap($scope.map1);

             User.friendList($scope.userInfo.id)
            .success(function(data) {
                $scope.friends = data.data;

                for (i = 0; i < $scope.friends.length; i++){
             var friendPoint = new google.maps.LatLng($scope.friends[i].latitude, $scope.friends[i].longitude);

                    marker = createMarker(friendPoint,$scope.friends[i].name,"http://maps.google.com/mapfiles/ms/icons/blue-dot.png");
                    marker.setMap($scope.map1);
                }
                $scope.friendList =!$scope.friendList;

            console.log($scope.friends);




                
            });

            })
            .error(function(data) {
                console.log(data);
            });
    };


    var createMarker = function(latlang,title,path){
        var marker = new google.maps.Marker({
            position: latlang,
            title: title,
            icon: path
          });
        return marker;
    }

   
});
