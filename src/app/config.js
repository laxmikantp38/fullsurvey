(function ()
{
    'use strict';
    /**
     * Provides the main configuration interface and information for the app.
     *
     * Environment, in this context, means the server endpoint as well as endpoints behind the server that will be used (SAP, SQL db's, etc.)
     */
    angular.module("fuse")
    .constant("configConstant", {
      prd: {
        text: "Production",
        server: "",
      },
      test: {
        text: "Testing",
        server: "",
      },
      local: {
        text: "Localhost",
        server: "http://localhost:3001",
      },
      currEnvironment: "local"
    })
    
    .service("environment", function(configConstant){
        var selectedEnv = configConstant.currEnvironment;
        var selectedEnvObj = configConstant[selectedEnv];
        return selectedEnvObj;
    });
    


})();