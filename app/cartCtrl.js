app.controller('cartCtrl', function ($scope, $rootScope, $http, cartService) {
    $scope.getTotal = function(){
        return cartService.getTotal();
    }
    $scope.getProducts = function(){
        return cartService.products;
    }
    $scope.addProduct = function(prod){
        cartService.addProduct(prod);
    }
    $scope.deleteProduct = function(prod){
        cartService.deleteProduct(prod);
    }
    $scope.sendRequest = function(){

    }
});