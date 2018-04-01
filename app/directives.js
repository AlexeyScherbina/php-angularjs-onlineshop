app.directive('focus', function() {
    return function(scope, element) {
        element[0].focus();
    }      
});

app.directive('passwordMatch', [function () {
    return {
        restrict: 'A',
        scope:true,
        require: 'ngModel',
        link: function (scope, elem , attrs,control) {
            var checker = function () {
 
                //get the value of the first password
                var e1 = scope.$eval(attrs.ngModel); 
 
                //get the value of the other password  
                var e2 = scope.$eval(attrs.passwordMatch);
                if(e2!=null)
                return e1 == e2;
            };
            scope.$watch(checker, function (n) {
 
                //set the form control to valid if both 
                //passwords are the same, else invalid
                control.$setValidity("passwordNoMatch", n);
            });
        }
    };
}]);


app.directive('cartBar', [function () {
    return {
        restrict : 'E',
        controller : 'cartCtrl',
        scope: {},
        template: "<div class='navbar-header navbar-right nav-item'><a class='navbar-brand' title='Cart' ng-href='#/cart'>Cart {{getTotal() | currency}}</a></div>",
        link:function(scope, element, attrs){

        }
    };
}]);

/*
app.directive('addCartBtn', [function () {
    return {
        restrict : 'E',
        controller : 'cartCtrl',
        scope: {
            prodt:'@'
        },
        template: "<button class='btn' style='width:100%;' ng-click='addToCart({{prodt}})'>Add to cart</button>",
        link:function(scope, element, attrs){

        }
    };
}]);*/
