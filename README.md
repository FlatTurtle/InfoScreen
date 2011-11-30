FlatTurtle
==========

Requirements
------------

- Underscore.js
- Backbone.js
- jQuery (optional)

Turtle modules
--------------

Each turtle module represents a Backbone.Model, Backbone.Collection and Backbone.View. By passing these constructor functions to the framework, your turtle is created. The framework will breed your turtle and couple your model, collection and view. It will also create a placeholder element that will be available to your view.

Model
-----

Methods: http://documentcloud.github.com/backbone/#Model

Example:

	var Book = Backbone.Model.extend({
	  defaults: {
		"author": "unknown",
		"title": "no title",
		"pages": 0
	  }
	});
	
Collection
----------

Methods: http://documentcloud.github.com/backbone/#Collection

Example:

	var Library = Backbone.Collection.extend({
	  model: Book
	});
	
Events:
- refresh: the frameworks requests to refresh your collection
- born: your turtle fully grown (post-constructor)
- destroy: your turtle is killed
	
View
----

Methods: http://documentcloud.github.com/backbone/#View

Example (using jQuery and jQuery.tmpl):

	var BookShelf = Backbone.View.extend({
	  initialize : function() {
	    this.bind("born", this.render);
	  },
	  render: function() {
		$(this.el).html($.tmpl('<li>${author} - ${title}</li>', this.collection.toJSON()));
	  }
	});
	
Events:
- refresh: the frameworks requests to refresh your collection
- born: your turtle fully grown (post-constructor)
- destroy: your turtle is killed

Spawning a turtle
-----------------

To spawn a turtle you can use the global 'turtles' object, you can pass a set of constructor functions:

	turtles.grow("books", {
	  collection : Library,
	  view : BookShelf,
	  model : Book
	});
	
Your turtle will now be created and the spawned event will be triggered.

Available methods:

- trigger(id, event)
  Trigger a specific event for a turtle module
  
- trigger(event)
  Trgger a global event for all turtle modules
  
- kill(id)
  completely remove a turtle, this will trigger the destroy event before completely removing it

# InfoScreen

The purpose of this project is to give more visibility to public transport around your office. Using an adminscreen you can specify your location and the desired stations you want to display on the screen which may be placed at the entrance.

This is a project started by the Flat Turtle bvba. It's the back-end for our mobility-screen products. Flut Turtle is member of the iRail NPO. The copyright of this software is maintained by the non profit organisation and licensed under AGPL. We do not however include the designs which contain company logos and styles from the companies we work for. You are free however to make this code better and/or to use it for your own project (as long as you respect the AGPL).


# Development

We like design patterns and we Object Oriented Programming. Nonetheless we believe one should stay pragmatic. Therefore we always work according to an Model-View-Controller design pattern. The mod rewrite plugin for apache will take care of the url handling: a request to the root of your instance will trigger the controller. The controller will ask the model which data it should retrieve according to the given GET-parameters. Thereafter the view will generate the output according to the templates directory.

# Designs

We include one default template according the the iRail NPO style. It is licensed under the Creative Commons By Sa license. This means you are free to alter it, change it or remix it, as long as you add the iRail NPO as original creator and share it under the same license.

# iRail

More information can be found on [Project iRail](http://project.irail.be/).

# License

This branch has been written from scratch and therefor relicensed to: AGPL

(c) 2011 iRail vzw/asbl

# Installation

Adjust config.php to your needs and copy the entire repository to your server.

You need:

 * PHP5
 * (url rewrite mod)
 * http request
 * a database

# Some interesting links:

 * Source: <http://github.com/iRail/iRail>
 * Mailing: <http://list.irail.be/>
 * Trac: <http://project.irail.be/>
 * API: <http://api.irail.be/>
 * BeTrains: <http://betrains.mobi/>
