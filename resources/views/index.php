<!DOCTYPE html>
<html ng-app="styleQ">
  <head>
    <meta charset="utf-8">
    <title>Style Q</title>

    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

  </head>

  <body>
    <div class="container-fluid">
      <nav class="navbar navbar-light bg-faded">
        <a class="navbar-brand" href="/">
          StyleQ
        </a>
      </nav>
    </div>

    <div class="container" ng-view>


    </div>



    <script src="lib/jquery-3.2.1.min.js"></script>
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <script src="lib/bootstrap.min.js"></script>
    <script src="lib/angular.min.js"></script>
    <script src="lib/angular-route.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/controllers/services.js"></script>

    <script type="text/javascript">
    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
    })
    </script>


  </body>
</html>
