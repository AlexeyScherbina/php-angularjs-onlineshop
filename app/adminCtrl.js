app.controller('adminCtrl', function ($scope, $rootScope, $routeParams, $location, $http) {
    $scope.tab = 1;
    $scope.products = [];
    $scope.orders = [];
    $scope.categories = [];

    $scope.page = 1;
    $scope.searchText = '';
    $scope.category = {};

    $scope.totalItems = 0;

    $scope.getCatName = function(id){
        for(var i in $scope.categories){
            if($scope.categories[i].CategoryID == id){
                return $scope.categories[i].CategoryName;
            }
        }
    }

    $scope.getTimes=function(){
        var pagecount = Math.ceil($scope.totalItems/6);       
        return new Array(pagecount);
    };

    getCategories();

    $scope.addToCart = function(prod){
        cartService.addProduct(prod);
    }

    $scope.getResultsPage = function(pageNumber) {
        $http.get('api/product/getProducts.php?search='+$scope.searchText+'&page='+pageNumber+'&category='+$scope.category.CategoryID).then(function(result) {
            $scope.products = result.data.data;
            $scope.totalItems = result.data.total;
        });
        if(pageNumber >= 1){
        $scope.page = pageNumber;
        }
    }
    $scope.getResultsPage(1);

    function getCategories() {
        $http.get('api/category/getCategories.php').then(function(result) {
            $scope.categories = result.data.data;
            });
    }


    $scope.setCategory = function(cat){
        $scope.category = cat;
        $scope.getResultsPage(1);
    }

    $scope.searchDB = function(){
        $scope.getResultsPage(1);
    }

});