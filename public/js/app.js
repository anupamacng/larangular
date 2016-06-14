//initialise a angular application 
var userApp = angular.module('userApp', ['userService']); 
// main controller
userApp.controller('mainController', function($scope, $http, User) {
    // object to hold all the data for the new users
    $scope.userData = {};
    // make login form visible
    $scope.frm_login = true;
    // loading variable to show the spinning loading icon
    $scope.loading = true;
    // initialise the map
    $scope.map1 ;


// display single user information
//Return : single user object containing all the information
//@Param : user id
    $scope.viewSingleUser = false;
    $scope.myFunction = function(id) {
       User.individualUser(id)
        .success(function(data) {
            $scope.single = data.data;
            $scope.viewSingleUser = !$scope.viewSingleUser;
            console.log($scope.single);
        });
    };


// send a friend request to a user
//Return : single user object containing all the information
//@Param : user id
    $scope.addFriend = function(id) {
       User.sendRequest(id)
        .success(function(data) {
             User.get()
		        .success(function(data) {
		            $scope.users = data.data;
		            console.log($scope.users);
		        });
        });
    };
/*
@Param: user loging form
@retuen: User info
*/
    $scope.getLogin = function(user) {
    	 // read form data to user data 
    	$scope.userData = angular.copy(user);
		//  call service login
			User.login($scope.userData)
            .success(function(data) {
	            $scope.userInfo = data.data;
	            $scope.map = !$scope.map;
	            document.userId = $scope.userInfo.id;
	            // make login form invisible
	            $scope.frm_login = !$scope.frm_login;
	        	// login success load all the users
		        User.get()
		        .success(function(data) {
		            $scope.users = data.data;
		            console.log($scope.users);
		        });
		        // create the logged users points
		        var myLatLng = new google.maps.LatLng($scope.userInfo. latitude, $scope.userInfo.longitude);
		        // initialise the map with center point and other 
		        var mapOptions = {
		        zoom: 4,
		        center: myLatLng,
		        mapTypeId: google.maps.MapTypeId.TERRAIN
		   		 };
		   		 // define the map
    			$scope.map1 = new google.maps.Map(document.getElementById('map1'), mapOptions);
    			// create a marker for the logged in user -red
	    		marker = createMarker(myLatLng,"me","http://maps.google.com/mapfiles/ms/icons/red-dot.png");
	    		// set the marker
	    		marker.setMap($scope.map1);
	    		// get the logged in users friend list
	    		 User.friendList()
		        .success(function(data) {
		            $scope.friends = data.data;
		            // set markers for all the friends
		            for (i = 0; i < $scope.friends.length; i++){
		         		var friendPoint = new google.maps.LatLng($scope.friends[i].latitude, $scope.friends[i].longitude);
				        marker = createMarker(friendPoint,$scope.friends[i].name,"http://maps.google.com/mapfiles/ms/icons/blue-dot.png");
	    				marker.setMap($scope.map1);
				    }
		            $scope.friendList =!$scope.friendList;
		        });
	            })
            .error(function(data) {
                console.log(data);
            });
    };

// function to create marker
// @param : point, title , and image for marker
// @Return : marker
    var createMarker = function(latlang,title,path){
    	var marker = new google.maps.Marker({
		    position: latlang,
		    title: title,
		    icon: path
		  });
    	return marker;
    }
});
 
 