"use strict";

myAdminApp.service("Categories",function ($http) {
   return {
        fetch : function() {
            return $http.get("/rest/getCategories.php");
        },
       changeStatus : function(status){
            return $http.get("/rest/changeStatusGuide.php", {params: {status: status}});
       },
       del : function(id) {
           return $http.get("/rest/deleteCategory.php", {params: {id: id}});
       }
    };
});
