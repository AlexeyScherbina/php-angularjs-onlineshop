app.controller('userCtrl', function ($scope, $rootScope, $http) {
    $http.get('api/user/getUserdata').then(function(result) {
        $scope.data = result.data;
    });
});