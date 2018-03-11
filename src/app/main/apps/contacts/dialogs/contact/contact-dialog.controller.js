(function ()
{
    'use strict';

    angular
        .module('app.contacts')
        .directive('customOnChange', function() {
          return {
            restrict: 'A',
            link: function (scope, element, attrs) {
              var onChangeHandler = scope.$eval(attrs.customOnChange);
              element.on('change', onChangeHandler);
              element.on('$destroy', function() {
                element.off();
              });
        
            }
          };
        })
        .controller('ContactDialogController', ContactDialogController);

    /** @ngInject */
    function ContactDialogController($mdDialog, Contact,$http, Contacts, User, msUtils, environment)
    {
        var vm = this;
        
    
        // Data
        vm.title = 'Edit Contact';
        vm.contact = angular.copy(Contact);
        vm.contacts = Contacts;
        vm.user = User;
        vm.newContact = false;
        vm.allFields = false;

        if ( !vm.contact )
        {
            vm.contact = {
                'id'      : msUtils.guidGenerator(),
                'name'    : '',
                'lastName': '',
                'avatar'  : 'assets/images/avatars/profile.jpg',
                'nickname': '',
                'company' : '',
                'jobTitle': '',
                'email'   : '',
                'phone'   : '',
                'address' : '',
                'birthday': null,
                'notes'   : ''
            };

            vm.title = 'New Contact';
            vm.newContact = true;
            vm.contact.tags = [];
        }

        // Methods
        vm.addNewContact = addNewContact;
        vm.saveContact = saveContact;
        vm.deleteContactConfirm = deleteContactConfirm;
        vm.closeDialog = closeDialog;
        vm.toggleInArray = msUtils.toggleInArray;
        vm.exists = msUtils.exists;
        vm.openImageSelector = openImageSelector;
        vm.fileChange = fileChange;
        
        
        function openImageSelector(){
          console.log('clicked...');
          document.getElementById('contactImage').click();
        }
        
        
        function fileChange(event){
          console.log('event', event.target.files);
          var file = event.target.files[0];
          
          var reader = new FileReader();
          reader.readAsDataURL(file);
          reader.onload = function () {
            console.log(reader.result);
            vm.contact.avatar = reader.result;
          };
          reader.onerror = function (error) {
            console.log('Error: ', error);
          };
       }

        //////////

        /**
         * Add new contact
         */
        function addNewContact()
        {
            vm.contacts.unshift(vm.contact);

            closeDialog();
			
			var data = $.param(vm.contact);			
		
			var config = {
				headers : {
					'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				}
			}
      
			$http.post(environment.server+'/api/contact?method=post', data, config)
			.success(function (data, status, headers, config) {
				
				
			})
			.error(function (data, status, header, config) {
			});
        }

        /**
         * Save contact
         */
        function saveContact()
        {
            // Dummy save action
			
            for ( var i = 0; i < vm.contacts.length; i++ )
            {
                if ( vm.contacts[i].id === vm.contact.id )
                {
                    vm.contacts[i] = angular.copy(vm.contact);
					 //closeDialog();				 
                     
					
					var datac = $.param({
						'id'      : vm.contacts[i].id,
						'name'    : vm.contacts[i].name,
						'lastName': vm.contacts[i].lastName,
						'avatar'  : vm.contacts[i].avatar,
						'nickname': vm.contacts[i].nickname,
						'company' : vm.contacts[i].company,
						'jobTitle': vm.contacts[i].jobTitle,
						'email'   : vm.contacts[i].email,
						'phone'   : vm.contacts[i].phone,
						'address' : vm.contacts[i].address,
						'birthday': null,
						'notes'   : vm.contacts[i].notes
					});	

						$http(
							{
							   method: 'POST',
							   url: environment.server+'/api/contact?method=update',  /*You URL to post*/
							   data: datac,  /*You data object/class to post*/
							   headers : {
									'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'
								},
							 dataType: 'json'
							}).then(function successCallback(response) {
							   // this callback will be called asynchronously
							   // when the response is available
							   console.log(response);

							}, function errorCallback(response) {
							   // called asynchronously if an error occurs
							   // or server returns response with an error status.
							console.log(response);
						   });
                  	
                    break; 
                }
            }

            closeDialog();		
			
        }

        /**
         * Delete Contact Confirm Dialog
         */
        function deleteContactConfirm(ev)
        {
            var confirm = $mdDialog.confirm()
                .title('Are you sure want to delete the contact?')
                .htmlContent('<b>' + vm.contact.name + ' ' + vm.contact.lastName + '</b>' + ' will be deleted.')
                .ariaLabel('delete contact')
                .targetEvent(ev)
                .ok('OK')
                .cancel('CANCEL');

            $mdDialog.show(confirm).then(function ()
            {

                vm.contacts.splice(vm.contacts.indexOf(Contact), 1);

            });
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