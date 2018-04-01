app.controller('cartCtrl', function ($scope, $rootScope, $http,$location, cartService) {
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
        $http.post("api/orders/addOrder.php",$scope.getProducts()).then(function (results) {
            if (results.data.status == "success") {
                alert("Your order is pending");
                $location.path('home');
                cartService.clearCart();
            }
        });
    }
});