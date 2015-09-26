angular.module('algoliaTest', [])
    .controller('SearchController', ['$http', function  ($http) {
        var search = this;
        search.query   = '';
        search.results = [];
        search.update = function () {
            $http.get('/search?q=' + search.query).success(function (data) {
                search.results = data.hits;
            })
        };
        var onChangeDelay;
        search.onChange = function () {
            clearTimeout(onChangeDelay);
            onChangeDelay = setTimeout(search.update, 150);
        };
    }])
    .filter('image', function() { return function(img) {
        return img || 'http://bit.ly/1OXCxcY';
    }});
