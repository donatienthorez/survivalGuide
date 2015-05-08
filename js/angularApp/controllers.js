"use strict";

myAdminApp.controller("categoriesController" ,function ($scope, Categories) {

    $scope.categories=[];
    $scope.categorie="";
    $scope.editorOptions = {
                language: 'en'
            };
    $scope.guideActivate = "";
     
    Categories.fetch().success(function(resp){
        
        //on recupere les categories
        $scope.categories = resp.categories;
        
        // on selectionne le premier
        if($scope.categories.length>0) {
            $scope.getCategorie($scope.categories[0].id);
        }
    });

    Categories.isActivate().success(function(resp){

        $scope.guideActivate = resp.isActivated;
    });

    $scope.changeGuideStatus = function (guideActivate)
    {
        if(guideActivate){
            Categories.changeStatus('ON').success(function(){});
        }
        else
        {
            Categories.changeStatus('OFF').success(function(){});
        }
    }

    $scope.$on("ckeditor.ready", function( event ) {
                $scope.isReady = true;
            });
            
     $scope.getCategorie = function(id)
     {
         var index,index2,index3;
         for(index=0; index<$scope.categories.length;++index)
         {
             if($scope.categories[index].id == id)
             {
                 $scope.categorie=$scope.categories[index];
        
             }
             if(($scope.categories[index].categories).length>0)
             {
                 for(index2=0;index2<$scope.categories[index].categories.length;++index2)
                 {
                     if($scope.categories[index].categories[index2].id== id)
                     {
                         $scope.categorie=$scope.categories[index].categories[index2];
                     }
                     if($scope.categories[index].categories[index2].categories.length>0)
                     {
                        for(index3=0;index3<$scope.categories[index].categories[index2].categories.length;++index3)
                        {
                           if($scope.categories[index].categories[index2].categories[index3].id == id)
						   {
                                $scope.categorie=$scope.categories[index].categories[index2].categories[index3];
						   }
                        } 
                     }   
                 }
             }
         }
     };

    $scope.deleteCategory = function(id) {
        Categories.del(id).success(function (resp) {
            window.location.reload();
        });
    }

    $scope.isInteger = function(integer) {
	 if(isNaN(integer)) {
	 	return false;
	 }
	 else {
		return true;
	 }
    }
});

