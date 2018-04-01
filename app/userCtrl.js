app.controller('userCtrl', function ($scope, $rootScope, $location, $http) {
    $scope.data = [];
    $http.get('api/user/getUserdata.php').then(function(result) {
        $scope.data = result.data.data;
    });
    $scope.logout = function () {

        $http.get("api/auth/logout.php").then(function (results) {
            if (results.data.status == "success") {
                $location.path('home');
            }
        });

    }
    $scope.applyData() = function (customer) {

        $http.post("api/user/updateCabData.php",customer).then(function (results) {
            if (results.data.status == "success") {
                $location.path('dashboard');
            }
        });

    };
});