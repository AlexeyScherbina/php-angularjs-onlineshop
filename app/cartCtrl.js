app.controller('cartCtrl', function ($scope, $rootScope, $http) {
    $scope.data = [];
    $scope.addToCart = function(prod){
        $scope.data.push(prod);
    }

});