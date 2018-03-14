(function ()
{
    'use strict';

    angular
        .module('app.notes')
        .factory('LabelsService', LabelsService);

    /** @ngInject */
    function LabelsService(msUtils, NotesService, msApi, $q, $http, environment)
    {
        var service = {
            data       : [],
            addLabel   : addLabel,
            updateLabel: updateLabel,
            deleteLabel: deleteLabel,
            getData    : getData
        };

        /**
         * Add label
         * @param newLabel
         */
        function addLabel(newLabel)
        {
            if ( newLabel.name === '' )
            {
                return;
            }

            service.data.push({
                id   : msUtils.guidGenerator(),
                name : newLabel.name,
                color: newLabel.color || ''
            });
        }

        /**
         * Update Label
         * @param note
         */
        function updateLabel(note)
        {
            for ( var i = 0; i < service.data.length; i++ )
            {
                if ( service.data[i].id === note.id )
                {
                    service.data[i] = note;
                }
            }
        }

        /**
         * Delete Label
         * @param label
         */
        function deleteLabel(label)
        {
            var notes = NotesService.data;

            // Look for all notes if they have the labels
            for ( var j = 0; j < notes.length; j++ )
            {
                if ( notes[j].labels.indexOf(label.id) > -1 )
                {
                    notes[j].labels.splice(notes[j].labels.indexOf(label.id), 1);
                }
            }

            // Delete label from service data
            for ( var i = 0; i < service.data.length; i++ )
            {
                if ( service.data[i].id === label.id )
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

            $http.get(environment.server+'/api/label?method=get').then(function(response){
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