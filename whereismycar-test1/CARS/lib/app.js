var app = angular.module('App', []);

app.controller('CarController', ['$scope', '$http', function ($scope, $http) {

    // List of task
    $scope.cars = [];

    // Task Object
    $scope.car = {};

    // Task Details
    $scope.car_details = {};
$
    // Errors Array
    $scope.errors = [];

    // read records
    $scope.listCars = function () {
        $http.get('script/list.php', {})
            .then(function success(e) {
                $scope.cars = e.data.cars;
            }, function error(e) {

            });
    };
    $scope.listCars();

    // Add new task
    $scope.addCar = function () {
        $http.post('script/create.php', {
            car: $scope.car
        })
            .then(function success(e) {

                $scope.errors = [];

                $scope.cars.push(e.data.car);

                var modal_element = angular.element('#add_new_car_modal');
                modal_element.modal('hide');

            }, function error(e) {
                $scope.errors = e.data.errors;
            });
    };

    // open edit task details popup
    $scope.edit = function (index) {
        $scope.car_details = $scope.cars[index];
        var modal_element = angular.element('#modal_update_car');
        modal_element.modal('show');
    };

    // update the task
    $scope.updateCar = function () {
        $http.post('script/update.php', {
            car: $scope.car_details
        })
            .then(function success(e) {

                $scope.errors = [];

                var modal_element = angular.element('#modal_update_car');
                modal_element.modal('hide');

            }, function error(e) {
                $scope.errors = e.data.errors;
            });
    };

    // delete the task
    $scope.delete = function (index) {

        var conf = confirm("¿Estás seguro de eliminar el coche?");

        if (conf == true) {
            $http.post('script/delete.php', {
                car: $scope.cars[index]
            })
                .then(function success(e) {

                    $scope.errors = [];

                    $scope.cars.splice(index, 1);

                }, function error(e) {
                    $scope.errors = e.data.errors;
                });
        }
    };
}]);
