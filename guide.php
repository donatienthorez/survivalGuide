<?php
include 'includes/connection/session.php';
?>
<html ng-app="myAdminApp" xmlns="http://www.w3.org/1999/html">
	<head>
		<meta charset="utf-8">

		<title>ESN - Survival Guide</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">

		<link rel="shortcut icon" href="css/img/logo.ico" type="image/vnd.microsoft.icon" />

		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="css/font-awesome.css" rel="stylesheet">

		<link href="css/pages/signin.css" rel="stylesheet">
		<link href="css/pages/dashboard.css" rel="stylesheet">

		<link href="css/style.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">

        <script src="bower_components/jquery/dist/jquery.min.js"></script>
		<script src="js/jquery-1.7.2.min.js"></script>

       	<script src="bower_components/angular/angular.min.js"></script>
		<script src="bower_components/ckeditor/ckeditor.js"></script>

		<script src="js/angularApp/app.js"></script>
		<script src="js/angularApp/controllers.js"></script>
		<script src="js/angularApp/services.js"></script>
		<script src="js/ng-ckeditor.js"></script>
        <script src="js/bootstrap.js"></script>

	</head>

	<body>
		<?php include 'includes/partials/navbar.php'; ?>
		<div class="subnavbar">
		    <div class="subnavbar-inner">
				<div class="container">
					<ul class="mainnav">
						<li class="active"><a href="index.php"><i class="icon-list-alt"></i><span>Survival Guide</span> </a> </li>
						<li class=""><a href="notifications.php"><i class="icon-exclamation-sign"></i><span>Notifications</span> </a> </li>
					</ul>
				</div>
			</div>
		</div>
		<div ng-controller="categoriesController">
            <div class = "main-inner">
                <div class="container"</div>
                <div class="span5">
                    <div class="widget">
                        <div class="widget-header">
                            <i class="icon-book"></i>
                            <h3>Menu List Tree</h3>
                            <span>
                                <a href="#Add" role="button" data-toggle="modal" style="margin-bottom : 15px;">
                                <button type="button" class="btn btn-default">Add Category</button></a>
                            </span>
                            <span>
                                <div class="onoffswitch">
                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" ng-model="confirmed" ng-change="changeGuideStatus(confirmed)" checked>
                                    <label class="onoffswitch-label" for="myonoffswitch">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </span>
                        </div>
                        <div class="widget-content">
                            <ul ng-repeat="categorie in categories | orderBy:'+position'">
                                <a class="categorie"><li ng-click="getCategorie(categorie.id);">{{categorie.name}}</li></a>
                                <ul ng-repeat="categorie2 in categorie.categories | orderBy:'+position'">
                                    <a class="categorie"><li ng-click="getCategorie(categorie2.id);">{{categorie2.name}}</li></a>
                                    <ul ng-repeat="categorie3 in categorie2.categories | orderBy:'+position'">
                                        <a class="categorie"><li ng-click="getCategorie(categorie3.id);">{{categorie3.name}}</li></a>
                                    </ul>
                                </ul>
                            </ul>
                        </div>
                    </div>
                </div>
			    <div class="span5">
                    <div class="widget">
                        <form name="form" method="post" action="saveCategory.php">
                            <div class="widget-header">
                                <i class="icon-book"></i>
                                <h3 ng-if="categorie.id"> {{ categorie.name }} </h3>
                                <h3 ng-if="!categorie.id"> Welcome to the survival guide tool</h3>
                                <span ng-if="categorie.id">
                                    <input type="submit" class="btn btn-default" value="Save">
                                    <a href="#delete" role="button" class="btn btn-default" data-toggle="modal">Delete</a>
                                </span>
                            </div>
                            <!-- end widget head -->

                            <div class="widget-content">

                                    <div ng-if="categorie.id">
                                        <input type="hidden" value="{{categorie.id}}" id="id" required name="id"/>
                                        <label for="name"  style="display:block;float:left;width:100px;position:relative;top:4px;">Titre : </label>
                                        <input type="text" ng-model="categorie.name" id="name" required name="title"/><br/>

                                        <label for="position" style="display:block;float:left; width:100px;position:relative;top:4px;">Position : </label>
                                        <input type="number" ng-model="categorie.position" id="position" required name="position"/><br/>
                                    </div>
                                        <div ng-cloak ng-show="categorie.categories.length==0 && !isReady" class="highlight">
                                            Initialising ...
                                        </div>
                                        <div ng-cloak ng-show="isReady && categorie.categories.length==0">

                                            <textarea ckeditor="editorOptions" name="content" ng-model="categorie.content"></textarea>
                                        </div>

                                        <div ng-if="categorie.categories.length>0">
                                            <ul ng-repeat="categorie2 in categorie.categories" style="margin: 4.5px 0 4.5px 0;">
                                                <a class="categorie"><li ng-click="getCategorie(categorie2.id);">{{categorie2.name}}</li></a>
                                                <ul ng-repeat="categorie3 in categorie2.categories">
                                                    <a class="categorie"><li ng-click="getCategorie(categorie3.id);">{{categorie3.name}}</li></a>
                                                </ul>
                                            </ul>
                                        </div>

                                    <div ng-if="!categorie.id">
                                        <p>Welcome, </p><p> You survival guide is empty. </p><p> You can fill it by clicking on "Add Category"</p>
                                    </div>
                            </div>
                            <!-- end widget content -->
                        </form>
                        <div id="delete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 id="myModalLabel">Delete category</h3>
                            </div>
                            <div class="modal-body">
                                <div class="control-group">
                                    <label class="control-label" for="name">{{ categorie.name }}</label>
                                    <div class="controls">
                                        <p> Are you sure to delete this category (and this subcategory) ?
                                    </div> <!-- /controls -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" ng-click="deleteCategory(categorie.id);">Delete</button>
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                            </div>
                        </div>

                        <div id="Add" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <form name="form" method="post" action="addCategory.php">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3 id="myModalLabel">Add category</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="control-group">
                                        <label class="control-label" for="name">Title</label>
                                        <div class="controls">
                                            <input type="text" class="span5" id="title" name="title">
                                        </div> <!-- /controls -->
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="Parent">Parent</label>
                                        <div class="controls">
                                            <select ng-model="parent" id="parent" name="parent">
                                                <option value="">-- Root --</option>
                                                <option ng-repeat="categorie in categories" value="{{categorie.id}}"> {{ categorie.name }}</option>
                                                <optgroup ng-if="categorie.categories.length" ng-repeat="categorie in categories" label="{{ categorie.name }}">
                                                    <option ng-repeat="categorie2 in categorie.categories" value="{{categorie2.id}}">{{ categorie2.name }}</option>
                                                </optgroup>
                                            </select><br/>
                                        </div> <!-- /controls -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-primary" value="Add">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                                </div>
                            </form>
                        </div>
				    </div>
			    </div>
		    </div>
	    </div>
	</body>
</html>
