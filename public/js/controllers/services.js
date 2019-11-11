app.factory('global_state', function() {
  var state;
  //factory function body that constructs a new state object
  return state || {};
});

app.controller("signupController", function($scope, $http, $location){
    $http({
      method: 'GET',
      url: '/signup'
    }).then(function successCallback(response) {
      $scope.signups = response.data;
    });

    $scope.addSignup = function() {
      var signup = {
          first: $scope.newSignupFirst,
          last: $scope.newSignupLast,
          business: $scope.newSignupBusiness,
          email: $scope.newSignupEmail,
          phone: $scope.newSignupPhone,
          role: $scope.newSignupRole
      };


      $scope.signups.push(signup);

      $http.post('/signup', signup);

      $location.path('/thankyou', signup);

    };
});

app.controller("loginController", function($scope, $http, $location){


    $scope.addLogin = function() {
      var login = {
          email: $scope.loginEmail,
          password: $scope.loginPassword
      };

      $http.post('/login', login).then(function(response) {
        if (response.data.success == true && response.data.role == "admin")
        {
          $location.path('/admin', login);
        }
        else if (response.data.success == true && response.data.role == "owner")
        {
          $location.path('/dashboard-owner', login);
        }
        else if (response.data.success == true && response.data.role == "independent")
        {
          $location.path('/dashboard-independent', login);
        }
        else if (response.data.success == true && response.data.role == "stylist")
        {
          $location.path('/dashboard-stylist', login);
        }
        else
        {
          alert(response.data.message);
        }
      });

    };
});

app.controller("logoutController", function($scope, $http, $location){

      $scope.logout = function() {

        $http({
          method: 'GET',
          url: '/client'
        }).then(function successCallback(response) {
          $scope.clients = response.data;
          $location.path('/login');
        });
      };
});

app.controller("userController", ['$scope', '$http', '$location', function($scope, $http, $location){
    $http({
      method: 'GET',
      url: '/user'
    }).then(function successCallback(response) {
      $scope.users = response.data;
    });

    $http({
      method: 'GET',
      url: '/roles'
    }).then(function successCallback(response) {
      $scope.roles = response.data;
    });

    $scope.addUser = function() {
      var user = {
          name: $scope.userBusiness,
          first: $scope.userFirst,
          last: $scope.userLast,
          email: $scope.userEmail,
          password: $scope.userPassword,
          role_id: $scope.userRole,
      };

      $scope.users.push(user);

      $http.post('/user', user);

      $location.path('/admin', user);

    };

    $scope.updateUser = function() {
      var user = {
          email: $scope.userEmail,
          password: $scope.userPassword,
      };

      $scope.users.push(user);

      $http.post('/updateUser', user);

      $location.path('/dashboard', user);

    };
}]);

app.controller("stylistController", ['$routeParams', '$scope', '$http', '$location', function($routeParams, $scope, $http, $location){
    $http({
      method: 'GET',
      url: '/stylists'
    }).then(function successCallback(response) {
      $scope.stylists = response.data;
    });

    $scope.addStylist = function() {
      var stylist = {
          first: $scope.stylistFirst,
          last: $scope.stylistLast,
          email: $scope.stylistEmail,
          password: $scope.stylistPassword,
      };

      $scope.stylists.push(stylist);

      $http.post('/stylists', stylist);


      $location.path('/stylists', stylist);

    };
}]);

app.controller("clientController", ['global_state', '$scope', '$http', '$location', '$routeParams', function(global_state, $scope, $http, $location, $routeParams){
    $http({
      method: 'GET',
      url: '/client'
    }).then(function successCallback(response) {
      $scope.clients = response.data;
    });

    $http({
      method: 'GET',
      url: '/client/' + $routeParams.id
    }).then(function successCallback(response) {
      $scope.client = response.data;
    });

    $scope.addClient = function() {
      var client = {
          first: $scope.clientFirst,
          last: $scope.clientLast,
          dob: $scope.clientDob,
          phone: $scope.clientPhone,
          email: $scope.clientEmail,
          address: $scope.clientAddress,
          photo: $scope.clientPhoto
      };

      $scope.clients.push(client);

      $http.post('/client', client).then(function successCallback(response) {
        global_state.currentClient = response.data;
      });


      $location.path('/consultation', client);

    };
}]);

app.controller("appointmentController", ['global_state', '$scope', '$http', '$location', function(global_state, $scope, $http, $location){
    $http({
      method: 'GET',
      url: '/appointment'
    }).then(function successCallback(response) {
      $scope.appointments = response.data;
    });

    $http({
      method: 'GET',
      url: '/stylist'
    }).then(function successCallback(response) {
      $scope.stylist = response.data;
    });

    $http({
      method: 'GET',
      url: '/stylists'
    }).then(function successCallback(response) {
      $scope.stylists = response.data;
    });

    $http({
      method: 'GET',
      url: '/service'
    }).then(function successCallback(response) {
      $scope.services = response.data;
    });

    $http({
      method: 'GET',
      url: '/clients'
    }).then(function successCallback(response) {
      $scope.client = response.data;
    });

    $scope.addAppointment = function() {
      var appointment = {
          client_id: global_state.currentClient.id,
          user_id: $scope.appointmentStylist,
          date: $scope.appointmentDate,
          time: $scope.appointmentTime,
          service: $scope.appointmentService,
      };

      $scope.appointments.push(appointment);

      $http.post('/appointment', appointment).then(function (response) {
        appointment.id = response.data.id;
      });

      $location.path('/dashboard', appointment);

    };

    $scope.removeAppointment = function(appointment) {
        var index = $scope.appointments.indexOf(appointment);
        $scope.appointments.splice(index, 1);

        $http.delete('/appointment/' + appointment.id, appointment);
    };
}]);

app.controller("hairController", ['$routeParams', '$scope', '$http', '$location', function($routeParams, $scope, $http, $location){

    $http({
      method: 'GET',
      url: '/hair'
    }).then(function successCallback(response) {
      $scope.hairs = response.data;
    });

    $http({
      method: 'GET',
      url: '/hair/' + $routeParams.id
    }).then(function successCallback(response) {
      $scope.hairCard = response.data;
    });


    $scope.addHair = function() {
      var hair = {
          condition: $scope.hairCondition,
          scalp: $scope.hairScalp,
          texture: $scope.hairTexture,
          porosity: $scope.hairPorosity,
          products: $scope.hairProducts,
          allergies: $scope.hairAllergies,
          base: $scope.hairBase,
          tonal: $scope.hairTonal,
          color: $scope.hairColor,
          perm: $scope.hairPerm,
          notes: $scope.hairNotes,
          client_id: $routeParams.id
      };

      $scope.hairs.push(hair);

      $http.post('/hair', hair);

      $location.path('/dashboard', hair);

    };
}]);

app.controller("makeupController", ['$routeParams', '$scope', '$http', '$location', function($routeParams, $scope, $http, $location){

    $http({
      method: 'GET',
      url: '/makeup'
    }).then(function successCallback(response) {
      $scope.makeups = response.data;
    });

    $http({
      method: 'GET',
      url: '/makeup/' + $routeParams.id
    }).then(function successCallback(response) {
      $scope.makeupCard = response.data;
    });

    $scope.allergies = [
      'Cosmetics',
      'Medicine',
      'Food',
      'Animals',
      'Sunscreens',
      'Iodine',
      'Polien',
      'AHAs',
      'Fragrance',
      'Shellfish',
      'Latex',
      'Drugs',
      'Other',
    ];

    $scope.concerns = [
      'Breakouts/Acne',
      'Blackheads/Whiteheads',
      'Excessive Oil/Shine',
      'Rosacea',
      'Broken Capillaries',
      'Redness/Ruddiness',
      'Sun Spot/Liver Spot/Brown Spot',
      'Uneven Skin Tone',
      'Sun Damage',
      'Wrinkles/Fine Lines',
      'Dull/Dry Skin',
      'Flaky Skin',
      'Dehydrated',
      'Other',
    ];

    $scope.eyes = [
      'Dehydrated',
      'Wrinkles',
      'Puffiness',
      'Dark Circles',
      'Broken Capillaries',
      'Other',
    ];

    $scope.lips = [
      'Dehydrated',
      'Cracked/Chapped',
      'Other',
    ];

    $scope.addMakeup = function() {
      var makeup = {
          complexion: $scope.makeupComplexion,
          tone: $scope.makeupTone,
          type: $scope.makeupType,
          texture: $scope.makeupTexture,
          products: $scope.makeupProducts,
          allergies: $scope.makeupAllergies,
          concerns: $scope.makeupConcerns,
          goal: $scope.makeupGoal,
          notes: $scope.makeupNotes,
          client_id: $routeParams.id
      };

      $scope.makeups.push(makeup);

      $http.post('/makeup', makeup);

      $location.path('/dashboard', makeup);

    };
}]);

app.controller("servicesController", function($scope, $http){

    $http({
      method: 'GET',
      url: '/service'
    }).then(function successCallback(response) {
      $scope.services = response.data;
    });


    $scope.addService = function() {
      var service = {
          name: $scope.newServiceName,
          category: $scope.newServiceCategory,
          duration: $scope.newServiceDuration,
          price: $scope.newServicePrice,
          description: $scope.newServiceDescription
      };

      $scope.services.push(service);

      $http.post('/service', service).then(function (response) {
        service.id = response.data.id;
      });

    };

    $scope.editService = function() {
      var service = {
          name: $scope.editServiceName,
          category: $scope.editServiceCategory,
          duration: $scope.editServiceDuration,
          price: $scope.editServicePrice,
          description: $scope.editServiceDescription
      };
      $scope.services.push(service);
      $http.post('/editService', service);
    };

    $scope.removeService = function(service) {
        var index = $scope.services.indexOf(service);
        $scope.services.splice(index, 1);

        $http.delete('/service/' + service.id, service);
    };

});

app.controller("salonController", function($scope, $http, $location){
    $http({
      method: 'GET',
      url: '/salon'
    }).then(function successCallback(response) {
      $scope.salons = response.data;
    });

    $scope.addSalon = function() {
      var salon = {
          logo: $scope.salonLogo,
          address1: $scope.salonAddress1,
          address2: $scope.salonAddress2,
          city: $scope.salonCity,
          state: $scope.salonState,
          zip: $scope.salonZip,
          phone: $scope.salonPhone,
      };
      $scope.salons.push(salon);
      $http.post('/salon', salon);
    };
});

app.controller("groupController", function($scope, $http){
    $http({
      method: 'GET',
      url: '/groups'
    }).then(function successCallback(response) {
      $scope.groups = response.data;
    });

    $scope.addGroup = function() {
      var group = {
          name: $scope.newGroup
      };

      $scope.groups.push(group);

      $http.post('/groups', group);

    };
});

app.controller("confirmedController", function($scope, $http, $location){
    $http({
        method: 'GET',
        url: '/confirmed'
    }).then(function successCallback(response) {
        $scope.confirmed = response.data;
    });

    $scope.addConfirmed = function() {
        var confirmed = {
            name: $scope.confirmed
        };

        $scope.confirmed.push(confirmed);

        $http.post('/confirmed', confirmed);
        $location.path('/confirmed', confirmed);
    };
});

app.controller("dashboardController", ['$scope', '$location', '$http', function($scope, $location, $http){

  $http({
    method: 'GET',
    url: '/auth'
  }).then(function (response) {
    if(response.data == "owner")
    {
      $location.path('/dashboard-owner');
    }
    else if(response.data == "independent")
    {
      $location.path('/dashboard-independent');
    }
    else if(response.data == "stylist")
    {
      $location.path('/dashboard-stylist');
    }
  });

  $http({
    method: 'GET',
    url: '/appointments'
  }).then(function successCallback(response) {
    $scope.appointments = response.data;
  });


}]);
