"use strict";

var prefix = "/survivalGuide";

myAdminApp.service("Categories",function ($http) {
   return {
        fetch : function() {
            return $http.get(prefix + "/rest/getCategories.php");
        },
       changeStatus : function(status){
            return $http.get(prefix + "/rest/changeStatusGuide.php", {params: {status: status}});
       },
       del : function(id) {
           return $http.get(prefix + "/rest/deleteCategory.php", {params: {id: id}});
       },
       isActivate : function() {
           return $http.get(prefix + "/rest/isGuideActivated.php");
       }
    };
});
