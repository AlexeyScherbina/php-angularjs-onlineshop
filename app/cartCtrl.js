app.controller('cartCtrl', function ($scope, $rootScope, $http, cartService) {
    $scope.getTotal = function(){
        return cartService.getTotal();
    }
});