app.controller('homeCtrl', function ($scope, $rootScope, $routeParams, $location, $http, cartService) {
    $scope.data = [];
    $scope.categories = [];
    $scope.page = 1;
    $scope.searchText = '';
    $scope.category = {};

    $scope.totalItems = 0;

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
            $scope.data = result.data.data;
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



    /*
    $scope.saveAdd = function(){
        $http.post(URL + '/api/product/add.php','POST',{},$scope.form).then(function(data) {
        $scope.data.push(data);
        $(".modal").modal("hide");
        });
    }

    $scope.edit = function(id){
        $http.post(URL + '/api/product/edit.php?id='+id).then(function(data) {
            console.log(data);
            $scope.form = data;
        });
    }

    $scope.saveEdit = function(){
        $http.post(URL + '/api/product/update.php?id='+$scope.form.id,'POST',{},$scope.form).then(function(data) {
            $(".modal").modal("hide");
            $scope.data = apiModifyTable($scope.data,data.id,data);
        });
    }

    $scope.remove = function(item,index){
        var result = confirm("Are you sure delete this item?");
        if (result) {
            $http.post(URL + '/api/product/delete.php?id='+item.id,'DELETE').then(function(data) {
            $scope.data.splice(index,1);
        });
        }
    }*/
    
});