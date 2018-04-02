app.controller('adminCtrl', function ($scope, $rootScope, $routeParams, $location, $http) {
    $scope.tab = 1;

    $scope.products = [];
    $scope.orders = [];
    $scope.orderDetails = [];
    $scope.categories = [];

    $scope.page = 1;
    $scope.orderPage = 1;

    $scope.searchText = '';
    $scope.category = {};

    $scope.totalItems = 0;
    $scope.totalOrders = 0;

    
    $scope.getTimes=function(){
        var pagecount = Math.ceil($scope.totalItems/6);       
        return new Array(pagecount);
    };
    $scope.getOrderTimes=function(){
        var pagecount = Math.ceil($scope.totalOrders/5);       
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
    $scope.getOrders = function(pageNumber) {
        $http.get('api/orders/getOrders.php?page='+pageNumber).then(function(result) {
            $scope.orders = result.data.data;
            $scope.totalOrders = result.data.total;
            $scope.orderDetails = result.data.details;
            for(var o in $scope.orders){
                $scope.orders[o].details = [];
                $scope.orders[o].opened = false;
                for(var od in $scope.orderDetails){
                    if($scope.orders[o].OrderID == $scope.orderDetails[od].OrderID){
                        $scope.orders[o].details.push($scope.orderDetails[od]);
                    }
                }
            }
        });
        if(pageNumber >= 1){
        $scope.orderPage = pageNumber;
        }
    }
    $scope.getOrders(1);

    $scope.confirmOrder = function(order, event){
        event.stopPropagation();
        $http.get('api/orders/confirmOrder.php?id='+order.OrderID).then(function(result) {
            if (result.data.status == "success") {
                order.OrderConfirmed = 1;
            }
        });
    }

    $scope.orderSum = function(o){
        var sum = 0;
        for(var od in o.details){
            sum += o.details[od].DetailPrice* o.details[od].DetailCount;
        }
        return sum;
    }
    
    $scope.getCatName = function(id){
        for(var i in $scope.categories){
            if($scope.categories[i].CategoryID == id){
                return $scope.categories[i].CategoryName;
            }
        }
    }

    $scope.setCategory = function(cat){
        $scope.category = cat;
        $scope.getResultsPage(1);
    }


    $scope.addbuttonvisible = true;
    $scope.addCategoryClick = function (){
        $scope.addbuttonvisible = false;
        $scope.categories.push({CategoryID:'#'});
    }
    $scope.addCategory = function (cat) {

        cat.CategoryID  = '?';
        $http.post("api/category/addCategory.php",cat).then(function (results) {
            if (results.data.status == "success") {
                getCategories();
                $scope.addbuttonvisible = true;
            }
        });

    };
    $scope.updateCategory = function (cat) {

        $http.post("api/category/updateCategory.php",cat).then(function (results) {
            if (results.data.status == "success") {
                alert(results.data.message);
            }
        });

    };
    $scope.deleteCategory = function (cat) {

        $http.post("api/category/deleteCategory.php",cat).then(function (results) {
            if (results.data.status == "success") {
                $scope.categories.splice($scope.categories.indexOf(cat),1);
            }
            if (results.data.status == "error") {
                alert(results.data.message);
            }
        });

    };

    $scope.searchDB = function(){
        $scope.getResultsPage(1);
    }

    $scope.addProduct = function(){
        $rootScope.productToChangeOrUpdate = {
            ProductID: "",
            ProductName: "",
            ProductPrice: "",
            ProductCount: "",
            ProductDescription: "",
            CategoryID: "",
            Category: "",
            ProductImage: ""
        };
        $location.path("/product");
    }
    $scope.updateProduct = function(prod){
        $rootScope.productToChangeOrUpdate = prod;
        for(var i =0; i<$scope.categories.length;i++){
            if($rootScope.productToChangeOrUpdate.CategoryID == $scope.categories[i].CategoryID){
                $rootScope.productToChangeOrUpdate.Category = $scope.categories[i].CategoryName;
            }
        }
        $location.path("/product");
    }
    $scope.deleteProduct = function(prod){
        $http.post("api/product/deleteProduct.php",prod).then(function (results) {
            if (results.data.status == "success") {
                $scope.products.splice($scope.products.indexOf(prod),1);
            }
            if (results.data.status == "error") {
                alert(results.data.message);
            }
        });
    }
});