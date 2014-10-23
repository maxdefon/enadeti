var ApiConnect = angular.module('ApiConnect', [
    'HttpSerializer'
]);

ApiConnect.factory('ApiConnectService', [
    '$http',
    '$q',
    '$rootScope',
    'HttpSerializerService',

    function($http, $q, $rootScope, HttpSerializerService) {

        return {

            connect: function(method, url, params, config) {

                var deferred = $q.defer();

                method = method || 'GET';
                url = url || '';

                if (!config)
                    config = {};

                if (params) {

                    if (method.toLowerCase() == 'get')
                        config.params = params;
                    else {
                        config.headers = {
                            'Content-type': 'application/x-www-form-urlencoded; charset=utf-8'
                        };
                        config.data = params;
                        config.transformRequest = HttpSerializerService;
                    }

                }

                config.method = method;
                config.url = $rootScope.api_url + '/' + url;
                config.withCredentials = true;

                function handleSuccessHttp(cb) {
                    deferred.resolve(cb.data);
                }

                function handleErrorHttp(cb) {
                    deferred.reject({
                        'data': cb.data,
                        'status': cb.status,
                        'headers': cb.headers,
                        'config': cb.config
                    });
                }

                $http(config).then(handleSuccessHttp, handleErrorHttp);

                return deferred.promise;
            }
        };

    }
]);
