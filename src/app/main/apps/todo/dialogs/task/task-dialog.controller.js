(function ()
{
    'use strict';

    angular
        .module('app.todo')
        .controller('TaskDialogController', TaskDialogController);

    /** @ngInject */
    function TaskDialogController($mdDialog, Task, Tasks, event, environment, TodosService, $timeout, $scope,$http)
    {
        var vm = this;

        // Data
        vm.title = 'Edit Task';
        vm.task = angular.copy(Task);
        //vm.tasks = Tasks;	  
	   getTodos();
        vm.newTask = false;

        if ( !vm.task )
        {
            vm.task = {
                'id'                : '',
                'title'             : '',
                'notes'             : '',
                'startDate'         : new Date(),
                'startDateTimeStamp': new Date().getTime(),
                'dueDate'           : '',
                'dueDateTimeStamp'  : '',
                'completed'         : false,
                'starred'           : false,
                'important'         : false,
                'deleted'           : false,
                'tags'              : []
            };
            vm.title = 'New Task';
            vm.newTask = true;
            vm.task.tags = [];
        }

        // Methods
        vm.addNewTask = addNewTask;
        vm.saveTask = saveTask;
        vm.deleteTask = deleteTask;
        vm.newTag = newTag;
        vm.closeDialog = closeDialog;
		
		
		function getTodos(){    
          $http.get(environment.server+'/api/todos?method=get').then(function(response){
            var responseData = response.data;
              if(responseData.status == 200){
                vm.tasks = responseData.data;
                //vm.labels = LabelsService.data;
              }
          }, function(error){
            
          });
      }

        //////////

        /**
         * Add new task
         */
        function addNewTask()
        {
            vm.tasks.unshift(vm.task);
			
			console.log(vm.task);
			
			var data = $.param(vm.task);
		
			var config = {
				headers : {
					'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				}
			};

          $http.post(environment.server+'/api/todos?method=post', data, config).then(function(response){
             // var responseData = response.data;
             // console.log('responseData', responseData);
             getTodos();
          });

            closeDialog();
        }

        /**
         * Save task
         */
        function saveTask()
        {
            // Dummy save action
            for ( var i = 0; i < vm.tasks.length; i++ )
            {
                if ( vm.tasks[i].id === vm.task.id )
                {
                    vm.tasks[i] = angular.copy(vm.task);
					
					var data = $.param(angular.copy(vm.task));
		
						var config = {
							headers : {
								'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
							}
						};

					  $http.post(environment.server+'/api/todos?method=update', data, config).then(function(response){
						  //var responseData = response.data;
						  //console.log('responseData', responseData);
						  getTodos();
					  });
					  
					  
                    break;
                }
            }

            closeDialog();
        }

        /**
         * Delete task
         */
        function deleteTask()
        {
            var confirm = $mdDialog.confirm()
                .title('Are you sure?')
                .content('The Task will be deleted.')
                .ariaLabel('Delete Task')
                .ok('Delete')
                .cancel('Cancel')
                .targetEvent(event);

            $mdDialog.show(confirm).then(function ()
            {
                // Dummy delete action
                for ( var i = 0; i < vm.tasks.length; i++ )
                {
                    if ( vm.tasks[i].id === vm.task.id )
                    {
                        vm.tasks[i].deleted = true;
						
						var data = $.param({id:vm.tasks[i].id});
		
						var config = {
							headers : {
								'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
							}
						};

					  $http.post(environment.server+'/api/todos?method=delete', data, config).then(function(response){
						  //var responseData = response.data;
						  //console.log('responseData', responseData);
						  getTodos();
					  });
		  
		  
                        break;
                    }
                }
            }, function ()
            {
                // Cancel Action
            });
        }


        /**
         * New tag
         *
         * @param chip
         * @returns {{label: *, color: string}}
         */
        function newTag(chip)
        {
            var tagColors = ['#388E3C', '#F44336', '#FF9800', '#0091EA', '#9C27B0'];

            return {
                name : chip,
                label: chip,
                color: tagColors[Math.floor(Math.random() * (tagColors.length))]
            };
        }

        /**
         * Close dialog
         */
        function closeDialog()
        {
            $mdDialog.hide();
        }
    }
})();