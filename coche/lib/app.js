var app = angular.module('App', []);

app.controller('CocheController', ['$scope', '$http', function ($scope, $http) {

    // List of coches
    $scope.coches = [];

    // Coche Object
    $scope.coche = {};

    // Coche Details
    $scope.coche_details = {};
$
    // Errors Array
    $scope.errors = [];

    // read records
    $scope.listCoches = function () {
        $http.get('script/list.php', {})
            .then(function success(e) {
                $scope.coches = e.data.coches;
            }, function error(e) {

            });
    };
    $scope.listCoches();

    // Add new coche
    $scope.addCoche = function () {
        $http.post('script/create.php', {
            coche: $scope.coche
        })
            .then(function success(e) {

                $scope.errors = [];

                $scope.coches.push(e.data.coche);

                var modal_element = angular.element('#add_new_coche_modal');
                modal_element.modal('hide');

            }, function error(e) {
                $scope.errors = e.data.errors;
            });
    };

    // open edit coche details popup
    $scope.edit = function (index) {
        $scope.coche_details = $scope.coches[index];
        var modal_element = angular.element('#modal_update_coche');
        modal_element.modal('show');
    };

    // update the coche
    $scope.updateCoche = function () {
        $http.post('script/update.php', {
            coche: $scope.coche_details
        })
            .then(function success(e) {

                $scope.errors = [];

                var modal_element = angular.element('#modal_update_coche');
                modal_element.modal('hide');

            }, function error(e) {
                $scope.errors = e.data.errors;
            });
    };

    // delete coche
    $scope.delete = function (index) {

        var conf = confirm("Estás seguro de borrar el coche?");

        if (conf == true) {
            $http.post('script/delete.php', {
                coche: $scope.coches[index]
            })
                .then(function success(e) {

                    $scope.errors = [];

                    $scope.coches.splice(index, 1);

                }, function error(e) {
                    $scope.errors = e.data.errors;
                });
        }
    };
}]);
