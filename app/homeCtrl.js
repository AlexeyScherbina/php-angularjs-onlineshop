app.controller('homeCtrl', function ($scope, $rootScope, $routeParams, $location, $http) {
    $scope.data = [];
    $scope.categories = [];
    $scope.page = 1;


    $scope.libraryTemp = {};
    $scope.totalItemsTemp = {};

    $scope.totalItems = 0;
    $scope.pageChanged = function(newPage) {
        getResultsPage(newPage);
    };

    getCategories();
    getResultsPage(1);
    function getResultsPage(pageNumber) {
        if(! $.isEmptyObject($scope.libraryTemp)){
            $http.get('api/product/getProducts.php?search='+$scope.searchText+'&page='+pageNumber).then(function(result) {
                $scope.data = result.data;
                $scope.totalItems = result.total;
            });
        }else{
            $http.get('api/product/getProducts.php?page='+pageNumber).then(function(result) {
            $scope.data = result.data.data;
            for(var i in $scope.data){
                console.log(i);
            }
            $scope.totalItems = result.data.total;
            });
        }
    }

    function getCategories() {
        $http.get('api/category/getCategories.php').then(function(result) {
            $scope.categories = result.data.data;
            for(var i in $scope.categories){
                console.log(i);
            }
            });
    }

    $scope.searchDB = function(){
        if($scope.searchText.length >= 3){
            if($.isEmptyObject($scope.libraryTemp)){
                $scope.libraryTemp = $scope.data;
                $scope.totalItemsTemp = $scope.totalItems;
                $scope.data = {};
            }
            getResultsPage(1);
        }else{
            if(! $.isEmptyObject($scope.libraryTemp)){
                $scope.data = $scope.libraryTemp ;
                $scope.totalItems = $scope.totalItemsTemp;
                $scope.libraryTemp = {};
            }
        }
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