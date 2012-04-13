FlatTurtle
==========

Requirements
------------

- PHP
- MySQL
- Underscore.js
- Backbone.js
- jQuery

Underscore and Backbone form the spine of our javascript framework that will load and grow the turtles. jQuery is used to load the turtle's script.

PHP and MySQL are necessary for the system to load the required environment to grow the turtles.

Installation
------------

1. Copy all files to your webserver
2. Set up the database by executing the supplied flatturtle.sql file
3. Rename config.example.php to config.php and modify the settings to your environment
4. Add an infoscreen and it's turtles to the database (manually for now)
5. Point your browser to your webserver

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
	
*A model class with default members*
	
Collection
----------

Methods: http://documentcloud.github.com/backbone/#Collection

Example:

	var Library = Backbone.Collection.extend({
	  model: Book,
	  initialize : function(models, options) {
	  		// fetch collection when born
			this.bind("born", this.fetch);
		},
	  url : function() {
			return "http://api.yourlibrary.com";
		}
	});
	
*A library class that contains a number of Book objects fetched from a remote source (check the backbone documentation for more information about remote collections)*
	
Events:

- refresh: the frameworks requests to refresh your collection
- born: your turtle fully grown (post-constructor)
- destroy: your turtle is destroyed
	
View
----

Methods: http://documentcloud.github.com/backbone/#View

Example (using jQuery and jQuery.tmpl):

	var BookShelf = Backbone.View.extend({
	  initialize : function() {
	  	// render when born (collection may be empty)
	    this.bind("born", this.render);
	    // render whenever the collection changes
	    this.collection.bind("reset", this.render);
	  },
	  render: function() {
		$(this.el).html($.tmpl('<li>${author} - ${title}</li>', this.collection.toJSON()));
	  }
	});
	
*A view class that uses jQuery.tmpl to render the collection when the turtle is born and whenever the collection is modified*
	
Events:

- refresh: the frameworks requests to refresh your collection
- born: your turtle fully grown (post-constructor)
- destroy: your turtle is destroyed

Registering a turtle module
---------------------------

All turtle modules are initially registered with the global Turtles object before you can start growing them. You can register a turtle like this:

	Turtles.register("books", {
	  collection : Library,
	  view : BookShelf,
	  model : Book
	});
	
Once your turtle is registered you can create multiple instances by passing the turtle name and optional options:	

	Turtles.grow("books", { limit : 10 });

The options are then passed to your Collection and View object on creation. Some functionality is support trough these options by our custom loader, for example:

- source: "..."  
  Turtles may be located from a remote location. The script located at this url will be automatically loaded. If the source option is not passed, it will try to load the turtle's script from the turtles folder.
- group: "..."
  When you grow multiple instances of 1 turtle they will be automatically grouped and switched by a timer. If you don't want the turtle to be grouped you may specify a custom group for this turtle that prevents this.

NOTE: We override the basic grow method with our own grow method that automatically loads the turtle's javascript file and creates a placeholder (with jQuery).

InfoScreen
----------

The purpose of this project is to give more visibility to public transport around your office. Using an adminscreen you can specify your location and the desired stations you want to display on the screen which may be placed at the entrance.

This is a project started by the FlatTurtle bvba. It's the back-end for our mobility-screen products. FlatTurtle is member of the iRail NPO. The copyright of this software is maintained by the non profit organisation and licensed under AGPL. We do not however include the designs which contain company logos and styles from the companies we work for. You are free however to make this code better and/or to use it for your own project (as long as you respect the AGPL).

Development
-----------

We like design patterns and we Object Oriented Programming. Nonetheless we believe one should stay pragmatic. Therefore we always work according to an Model-View-Controller design pattern. The mod rewrite plugin for apache will take care of the url handling: a request to the root of your instance will trigger the controller. The controller will ask the model which data it should retrieve according to the given GET-parameters. Thereafter the view will generate the output according to the templates directory.

Designs
-------

We include one default template according the the iRail NPO style. It is licensed under the Creative Commons By Sa license. This means you are free to alter it, change it or remix it, as long as you add the iRail NPO as original creator and share it under the same license.

iRail
-----

More information can be found on [Project iRail](http://project.irail.be/).

License
-------

This branch has been written from scratch and therefor relicensed to: AGPL

(c) 2011-2012 iRail vzw/asbl

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
 * API: <http://data.irail.be/>
 * BeTrains: <http://betrains.mobi/>
 * FlatTurtle: <http://flatturtle.com/>
 * InfoScreen demo: <http://s.flatturtle.com/stable/demo>
