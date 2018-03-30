<!DOCTYPE html>
<html lang="en" ng-app="myApp">

  <head>
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
          <title>MySHOP</title>
          <!-- Bootstrap -->
          <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/custom.css" rel="stylesheet">

              </head>

  <body ng-cloak="">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="row">
          <div class="navbar-header navbar-left nav-item">
            <a class="navbar-brand" rel="home" title="Home Page" ng-href="#/">MySHOP</a>
          </div>
          <div class="navbar-header navbar-right nav-item" ng-if="authenticated == true">
            <a class="navbar-brand" rel="home" title="Cart" href="">Cart</a>
          </div>
          <div class="navbar-header navbar-right nav-item" ng-if="authenticated == true">
            <a class="navbar-brand" rel="home" title="Cabinet" ng-href="#/cabinet">Cabinet</a>
          </div>
          <div class="navbar-header navbar-right nav-item" ng-if="authenticated == false">
            <a class="navbar-brand" rel="home" title="Login" ng-href="#/login">Login</a>
          </div>
        </div>
      </div>
    </div>
    <div >
      <div class="container" style="margin-top:20px;">

        <div data-ng-view="" id="ng-view"></div>

      </div>
    </body>
  <!-- Libs -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  <script src="js/angular.min.js"></script>
  <script src="js/angular-route.min.js"></script>
  <script src="js/angular-animate.min.js" ></script>

  <script src="app/app.js"></script>
  <script src="app/directives.js"></script>
  <script src="app/authCtrl.js"></script>
  <script src="app/homeCtrl.js"></script>
  <script src="app/adminCtrl.js"></script>
  <script src="app/userCtrl.js"></script>
</html>

