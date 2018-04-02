var app = angular.module('myApp', ['ngRoute', 'ngAnimate','naif.base64']);

app.config(['$routeProvider',
  function ($routeProvider) {
        $routeProvider.
        when('/login', {
            title: 'Login',
            templateUrl: 'partials/login.html',
            controller: 'authCtrl'
        })
            .when('/logout', {
                title: 'Logout',
                templateUrl: 'partials/login.html',
                controller: 'logoutCtrl'
            })
            .when('/signup', {
                title: 'Signup',
                templateUrl: 'partials/signup.html',
                controller: 'authCtrl'
            })
            .when('/dashboard', {
                title: 'Dashboard',
                templateUrl: 'partials/dashboard.html',
                controller: 'authCtrl'
            })
            .when('/cabinet', {
                title: 'Cabinet',
                templateUrl: 'partials/cabinet.html',
                controller: 'userCtrl',
                role: 'user'
            })
            .when('/cart', {
                title: 'Cart',
                templateUrl: 'partials/cart.html',
                controller: 'cartCtrl'
            })
            .when('/product', {
                title: 'Admin',
                templateUrl: 'partials/product.html',
                controller: 'productCtrl',
                role: 'admin'
            })
            .when('/admin', {
                title: 'Admin',
                templateUrl: 'partials/admin.html',
                controller: 'adminCtrl',
                role: 'admin'
            })
            .when('/', {
                title: 'Home',
                templateUrl: 'partials/home.html',
                controller: 'homeCtrl'
            })
            
            .otherwise({
                redirectTo: '/'
            });
  }])
    .run(function ($rootScope, $location, $http) {
        $rootScope.$on("$routeChangeStart", function (event, next, current) {
            $rootScope.authenticated = false;
            $http.get("api/auth/session.php").then(function (results) {
                if (results.data.uid) {
                    $rootScope.authenticated = true;
                    $rootScope.uid = results.data.uid;
                    $rootScope.name = results.data.name;
                    $rootScope.email = results.data.email;
                    $rootScope.role = results.data.role;
                }
                if (next !== undefined) {
                    if ('role' in next) {
                        if(next.role == 'admin' && $rootScope.role != 'admin'){
                            $location.path("/login");
                        }
                        if(next.role == 'user' && $rootScope.role != 'user'){
                            $location.path("/login");
                        }
                    }
                }
            });
            
            //$location.path("/login");
            //var nextUrl = next.$$route.originalPath;
        });
    });