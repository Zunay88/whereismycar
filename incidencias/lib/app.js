var app = angular.module('App', []);

app.controller('TaskController', ['$scope', '$http', function ($scope, $http) {

    // List of task
    $scope.tasks = [];

    // Task Object
    $scope.task = {};

    // Task Details
    $scope.task_details = {};
$
    // Errors Array
    $scope.errors = [];

    // read records
    $scope.listTasks = function () {
        $http.get('script/list.php', {})
            .then(function success(e) {
                $scope.tasks = e.data.tasks;
            }, function error(e) {

            });
    };
    $scope.listTasks();

    // Add new task
    $scope.addTask = function () {
        $http.post('script/create.php', {
            task: $scope.task
        })
            .then(function success(e) {

                $scope.errors = [];

                $scope.tasks.push(e.data.task);

                var modal_element = angular.element('#add_new_task_modal');
                modal_element.modal('hide');

            }, function error(e) {
                $scope.errors = e.data.errors;
            });
    };

    // open edit task details popup
    $scope.edit = function (index) {
        $scope.task_details = $scope.tasks[index];
        var modal_element = angular.element('#modal_update_task');
        modal_element.modal('show');
    };

    // update the task
    $scope.updateTask = function () {
        $http.post('script/update.php', {
            task: $scope.task_details
        })
            .then(function success(e) {

                $scope.errors = [];

                var modal_element = angular.element('#modal_update_task');
                modal_element.modal('hide');

            }, function error(e) {
                $scope.errors = e.data.errors;
            });
    };

    // delete the task
    $scope.delete = function (index) {

        var conf = confirm("Do you really want to delete the task?");

        if (conf == true) {
            $http.post('script/delete.php', {
                task: $scope.tasks[index]
            })
                .then(function success(e) {

                    $scope.errors = [];

                    $scope.tasks.splice(index, 1);

                }, function error(e) {
                    $scope.errors = e.data.errors;
                });
        }
    };
}]);