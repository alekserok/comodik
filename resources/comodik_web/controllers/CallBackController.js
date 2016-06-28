app.controller('CallBackController', function ($scope, $http, toastr) {
    $scope.callBack = function (data) {
        if (data == undefined) toastr.error('Введите пожалуйста Ваши данные!');
        else if (data.phone == undefined) toastr.error('Введите пожалуйста номер телефона!');
        else if (data.name == undefined) toastr.error('Введите пожалуйста Ваше имя');
        else {
            $scope.flag = true;
            $http({
                method: 'POST',
                url: '/callback',
                data: data
            }).then(function (data) {
                $scope.flag = false;
                toastr.success('Мы свяжемся с Вами в ближайшее время!');
            }, function (data) {
                $scope.flag = false;
                toastr.warning('')
            });
        }
    }
});