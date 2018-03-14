(function ()
{
    'use strict';

    angular
        .module('app.contacts')
		.controller('ContactsController', ContactsController);
		
        

    /** @ngInject */
    function ContactsController($scope, $mdSidenav, Contacts, User, msUtils, $http, $mdDialog, $document, environment)
    {

        var vm = this;

        // Data
        
        vm.filterIds = null;
        vm.listType = 'all';
        vm.listOrder = 'name';
        vm.listOrderAsc = false;
        vm.selectedContacts = [];
        vm.newGroupName = '';

        // Methods
        vm.filterChange = filterChange;
        vm.openContactDialog = openContactDialog;
        vm.deleteContactConfirm = deleteContactConfirm;
        vm.deleteContact = deleteContact;
        vm.deleteSelectedContacts = deleteSelectedContacts;
        vm.toggleSelectContact = toggleSelectContact;
        vm.deselectContacts = deselectContacts;
        vm.selectAllContacts = selectAllContacts;
        vm.deleteContact = deleteContact;
        vm.addNewGroup = addNewGroup;
        vm.deleteGroup = deleteGroup;
        vm.toggleSidenav = toggleSidenav;
        vm.toggleInArray = msUtils.toggleInArray;
        vm.exists = msUtils.exists;
        
        
        $http.get(environment.server+'/api/contact?method=get').then(function(response){
          var responseData = response.data;
            if(responseData.status == 200){
              vm.contacts = responseData.data;
            }
        }, function(error){
          
        });
      
        
        
        

        //////////

        /**
         * Change Contacts List Filter
         * @param type
         */
        function filterChange(type)
        {

            vm.listType = type;

            if ( type === 'all' )
            {
                vm.filterIds = null;
            }
            else if ( type === 'frequent' )
            {
                vm.filterIds = vm.user.frequentContacts;
            }
            else if ( type === 'starred' )
            {
                vm.filterIds = vm.user.starred;
            }
            else if ( angular.isObject(type) )
            {
                vm.filterIds = type.contactIds;
            }

            vm.selectedContacts = [];

        }

        /**
         * Open new contact dialog
         *
         * @param ev
         * @param contact
         */
        function openContactDialog(ev, contact)
        {
            $mdDialog.show({
                controller         : 'ContactDialogController',
                controllerAs       : 'vm',
                templateUrl        : 'app/main/apps/contacts/dialogs/contact/contact-dialog.html',
                parent             : angular.element($document.find('#content-container')),
                targetEvent        : ev,
                clickOutsideToClose: true,
                locals             : {
                    Contact : contact,
                    User    : vm.user,
                    Contacts: vm.contacts
                }
            });
        }
		
		
        
		
        /**
         * Delete Contact Confirm Dialog
         */
        function deleteContactConfirm(contact, ev)
        {
            var confirm = $mdDialog.confirm()
                .title('Are you sure want to delete the contact?')
                .htmlContent('<b>' + contact.name + ' ' + contact.lastName + '</b>' + ' will be deleted.')
                .ariaLabel('delete contact')
                .targetEvent(ev)
                .ok('OK')
                .cancel('CANCEL');

            $mdDialog.show(confirm).then(function ()
            {
                console.log("delete contact",contact);
                deleteContact(contact);
                

            }, function ()
            {

            });
        }

        /**
         * Delete Contact
         */
        function deleteContact(contact)
        {
            var data = $.param({
                id: contact.id
            });
            var config = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }
            $http.post(environment.server + '/api/contact?method=delete', data, config).then(function(response) {
                console.log("delete response", response);
                vm.contacts.splice(vm.contacts.indexOf(contact), 1);  
                vm.selectedContacts = [];  
            })
            
        }

        /**
         * Delete Selected Contacts
         */
        function deleteSelectedContacts(ev)
        {
            var confirm = $mdDialog.confirm()
                .title('Are you sure want to delete the selected contacts?')
                .htmlContent('<b>' + vm.selectedContacts.length + ' selected</b>' + ' will be deleted.')
                .ariaLabel('delete contacts')
                .targetEvent(ev)
                .ok('OK')
                .cancel('CANCEL');

            $mdDialog.show(confirm).then(function ()
            {

                vm.selectedContacts.forEach(function (contact)
                {
                    deleteContact(contact);
                });

                vm.selectedContacts = [];

            });

        }

        /**
         * Toggle selected status of the contact
         *
         * @param contact
         * @param event
         */
        function toggleSelectContact(contact, event)
        {
            if ( event )
            {
                event.stopPropagation();
            }

            if ( vm.selectedContacts.indexOf(contact) > -1 )
            {
                vm.selectedContacts.splice(vm.selectedContacts.indexOf(contact), 1);
            }
            else
            {
                vm.selectedContacts.push(contact);
            }
        }

        /**
         * Deselect contacts
         */
        function deselectContacts()
        {
            vm.selectedContacts = [];
        }

        /**
         * Sselect all contacts
         */
        function selectAllContacts()
        {
            vm.selectedContacts = $scope.filteredContacts;
        }

        /**
         *
         */
        function addNewGroup()
        {
            if ( vm.newGroupName === '' )
            {
                return;
            }

            var newGroup = {
                'id'        : msUtils.guidGenerator(),
                'name'      : vm.newGroupName,
                'contactIds': []
            };

            vm.user.groups.push(newGroup);
            vm.newGroupName = '';
        }

        /**
         * Delete Group
         */
        function deleteGroup(ev)
        {
            var group = vm.listType;

            var confirm = $mdDialog.confirm()
                .title('Are you sure want to delete the group?')
                .htmlContent('<b>' + group.name + '</b>' + ' will be deleted.')
                .ariaLabel('delete group')
                .targetEvent(ev)
                .ok('OK')
                .cancel('CANCEL');

            $mdDialog.show(confirm).then(function ()
            {

                vm.user.groups.splice(vm.user.groups.indexOf(group), 1);

                filterChange('all');
            });

        }

        /**
         * Toggle sidenav
         *
         * @param sidenavId
         */
        function toggleSidenav(sidenavId)
        {
            $mdSidenav(sidenavId).toggle();
        }

    }

})();