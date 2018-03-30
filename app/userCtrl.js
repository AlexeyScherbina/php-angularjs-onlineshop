app.controller('userCtrl', function ($scope, $rootScope, $http) {
    $scope.data = [];
    $http.get('api/user/getUserdata.php').then(function(result) {
        $scope.data = result.data;
    });
});