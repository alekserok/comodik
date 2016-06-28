app.controller('MainController', function ($http, $scope, toastr) {
    $scope.flag = false;
    $scope.mainMenu = [];
    $scope.categories = [];

    $http({
        method: 'GET',
        url: '/menu'
    }).then(function (data) {
        for (var i in data.data.types){
            if (data.data.types[i].parent_id == null)
                $scope.mainMenu.push(data.data.types[i]);
            else $scope.categories.push(data.data.types[i]);
        }
        console.log($scope.mainMenu);
    }, function (data) {
        console.log(data);
    });
});