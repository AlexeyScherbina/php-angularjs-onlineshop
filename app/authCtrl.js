app.controller('authCtrl', function ($scope, $rootScope, $routeParams, $location, $http) {

    $scope.login = {};
    $scope.signup = {};


    $scope.doLogin = function (customer) {

        $http.post("api/auth/login.php",customer).then(function (results) {
            if (results.data.status == "success") {
                $location.path('dashboard');
            }
        });

    };


    $scope.signup = {UserEmail:'',UserPassword:'',UserName:'',UserPhone:'',UserAddress:''};


    $scope.signUp = function (customer) {

        $http.post("api/auth/signup.php",customer).then(function (results) {
            if (results.data.status == "success") {
                $location.path('dashboard');
            }
        });

    };

    $scope.logout = function () {

        $http.get("api/auth/logout.php").then(function (results) {
            if (results.data.status == "success") {
                $location.path('login');
            }
        });

    }
});