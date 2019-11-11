var app = angular.module('styleQ', ["ngRoute"]);

app.config(function($routeProvider){
  $routeProvider
    .when("/", {
      templateUrl: "views/home.html",
      controller: "HomeController"
    })
    .when("/search", {
      templateUrl: "views/profiles/search.html",
      controller: "HomeController"
    })
    .when("/salon", {
      templateUrl: "views/profiles/salon.html",
      controller: "HomeController"
    })
    .when("/learnMore", {
      templateUrl: "views/login/learnMore.html",
      controller: "HomeController"
    })
    .when("/login", {
      templateUrl: "views/login/login.html",
      controller: "loginController"
    })
    .when('/logout', {
      template: '',
      controller: 'logoutController'
    })
    .when("/signUp", {
      templateUrl: "views/login/signUp.html"
    })
    .when("/thankyou", {
      templateUrl: "views/login/thankyou.html"
    })

    .when("/dashboard", {
      templateUrl: "views/dashboard.html",
      controller: "dashboardController",
    })

    .when("/dashboard-owner", {
      templateUrl: "views/salon/dashboard.html",
      controller: "dashboardController",
    })

    .when("/stylists", {
      templateUrl: "views/salon/stylists.html",
      controller:"stylistController"
    })
    .when("/addStylist", {
      templateUrl: "views/salon/addStylist.html",
      controller:"stylistController"
    })
    .when("/appointments", {
      templateUrl: "views/salon/calendar.html"
    })
    .when("/profile", {
      templateUrl: "views/salon/profile.html"
    })
    .when("/settings", {
      templateUrl: "views/salon/settings.html"
    })
    .when("/services", {
      templateUrl: "views/salon/salonServices.html"
    })


    .when("/dashboard-independent", {
      templateUrl: "views/independent/independentDashboard.html",
      controller: "dashboardController",
    })



    .when("/dashboard-stylist", {
      templateUrl: "views/stylist/stylistDashboard.html",
      controller: "dashboardController",
    })



    .when("/admin", {
      templateUrl: "views/admin/admin.html",
      controller:"userController"
    })
    .when("/addUser", {
      templateUrl: "views/admin/addUser.html",
      controller:"userController"
    })



    .when("/newClient", {
      templateUrl: "views/newClients/newClient.html"
    })
    .when("/consultation", {
      templateUrl: "views/newClients/newClientConsultation.html"
    })
    .when("/hairConsultation", {
      templateUrl: "views/newClients/hairConsultation.html"
    })
    .when("/makeupConsultation", {
      templateUrl: "views/newClients/makeupConsultation.html"
    })

    .when("/confirmed", {
        templateUrl: "views/profiles/confirmed.html"
    })
    .when("/nailsConsultation", {
      templateUrl: "views/newClients/nailConsultation.html"
    })
    .when("/skinConsultation", {
      templateUrl: "views/newClients/skinConsultation.html"
    })


    .when("/myClients", {
      templateUrl: "views/existingClients/myClients.html"
    })
    .when("/editClient/:id/", {
      templateUrl: "views/existingClients/editClient.html",
      controller:"clientController"
    })
    .when("/hairCard", {
      templateUrl: "views/existingClients/hairCard.html",
      controller:"hairController"
    })
    .when("/makeupCard", {
      templateUrl: "views/existingClients/makeupCard.html",
      controller:"makeupController"
    })
    .when("/transactions", {
      templateUrl: "views/existingClients/transactions.html"
    })
    .otherwise({
      redirectTo: "/"

    });
});


app.controller("HomeController", ["$scope", function($scope){

}]);
