"use strict";
myAdminApp.service("Categories",function ($http) {
   return {
        fetch : function() {
            return $http.get("/rest/getCategories.php");
        },
       del : function(id) {
           console.log(id);
           return $http.get("/rest/deleteCategory.php", {params: {id: id}});
       }
    };
});
