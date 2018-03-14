(function ()
{
    'use strict';

    angular
        .module('app.todo')
        .factory('TodosService', TodosService);

    /** @ngInject */
    function TodosService(msApi, $q, $http, environment)
    {
        var service = {
            data      : [],
            addTodo   : addTodo,
            updateTodo: updateTodo,
            deleteTodo: deleteTodo,
            getData   : getData,
			getTagData : getTagData
        };

        /**
         * Add Note
         * @param note
         */
        function addTodo(todo)
        {
            service.data.push(todo);
        }

        /**
         * Update Note
         * @param note
         */
        function updateTodo(todo)
        {
            for ( var i = 0; i < service.data.length; i++ )
            {
                if ( service.data[i].id === todo.id )
                {
                    service.data[i] = todo;
                }
            }
        }

        /**
         * Delete Note
         * @param note
         */
        function deleteTodo(todo)
        {
            for ( var i = 0; i < service.data.length; i++ )
            {
                if ( service.data[i].id === todo.id )
                {
                    service.data.splice(i, 1);
                }
            }
        }

        /**
         * Get service data
         * @returns {Array}
         */
        function getData()
        {
            // Create a new deferred object
            var deferred = $q.defer();
            $http.get(environment.server+'/api/todos?method=get').then(function(response){
              var responseData = response.data;
                if(responseData.status == 200){
                  // Attach the data
                    service.data = responseData.data;

                    // Resolve the promise
                    deferred.resolve(responseData.data);
                  //vm.labels = LabelsService.data;
                }
            }, function(error){
              
            });

            return deferred.promise;
        }
		
		/**
         * Get service data
         * @returns {Array}
         */
        function getTagData()
        {
            // Create a new deferred object
            var deferred = $q.defer();
            $http.get(environment.server+'/api/tag?method=get').then(function(response){
              var responseData = response.data;
                if(responseData.status == 200){
                  // Attach the data
                    service.data = responseData.data;

                    // Resolve the promise
                    deferred.resolve(responseData.data);
                  //vm.labels = LabelsService.data;
                }
            }, function(error){
              
            });

            return deferred.promise;
        }

        return service;

    }
})();