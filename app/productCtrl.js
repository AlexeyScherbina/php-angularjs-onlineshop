app.controller('productCtrl', function ($scope, $rootScope, $location, $http) {

    if(typeof $rootScope.productToChangeOrUpdate == "undefined"){
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
    }
    $scope.file = [];
    $scope.categories = [];
    $http.get('api/category/getCategories.php').then(function(result) {
        $scope.categories = result.data.data;
        });
        for(var i =0; i<$scope.categories.length;i++){
            if($rootScope.productToChangeOrUpdate.CategoryID == $scope.categories[i].CategoryID){
                $rootScope.productToChangeOrUpdate.Category = $scope.categories[i].CategoryName;
            }
        }
        if($rootScope.productToChangeOrUpdate.CategoryID>0){
        var myEl = angular.element( document.querySelector("#i"+$rootScope.productToChangeOrUpdate.CategoryID) );
        myEl.attr('selected',"selected");
        }

    $scope.addProduct = function () {
        $http.post("api/product/addProduct.php",$rootScope.productToChangeOrUpdate).then(function (results) {
            if (results.data.status == "success") {
                alert(results.data.message);
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
            }
        });

    };
    $scope.updateProduct = function () {

        $http.post("api/product/updateProduct.php",$rootScope.productToChangeOrUpdate).then(function (results) {
            if (results.data.status == "success") {
                alert(results.data.message);
            }
        });

    };
    $scope.applyData = function(){
        $rootScope.productToChangeOrUpdate.ProductImage = $scope.file.base64;
        for(var i =0; i<$scope.categories.length;i++){
            if($rootScope.productToChangeOrUpdate.Category == $scope.categories[i].CategoryName){
                $rootScope.productToChangeOrUpdate.CategoryID = $scope.categories[i].CategoryID;
            }
        }
        if($rootScope.productToChangeOrUpdate.ProductID>0){
            $scope.updateProduct();
        }
        else{
            $scope.addProduct();
        }
    }
});