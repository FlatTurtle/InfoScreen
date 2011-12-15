var Clock = function(rootElement) {

	var rootElement = rootElement;
	var interval;
	var refreshInterval;
	var that = this;
	var ticker = true;

	var refresh = function() {
		$(rootElement).html(time);
	};

	var time = function() {
		var now = new Date(), hours = now.getHours(), minutes = now
				.getMinutes();
		if (ticker) {
			ticker = false;
			return (hours < 10 ? '0' : '') + hours
					+ "<span style='visibility:visible;'>:</span>"
					+ (minutes < 10 ? '0' : '') + minutes;
		} else {
			ticker = true;
			return (hours < 10 ? '0' : '') + hours
					+ "<span style='visibility:hidden;'>:</span>"
					+ (minutes < 10 ? '0' : '') + minutes;
		}
	};

	var initialize = function() {
		initializeHtml();
		addBehaviours();
	};

	var initializeHtml = function() {
		rootElement.html(that.time);
	};

	var addBehaviours = function() {
		interval = window.setInterval(refresh, 500);
	};

	var removeBehaviours = function() {
		window.clearInterval(interval);
	};

	this.destroy = function() {
		removeBehaviours();

		rootElement.empty();
		rootElement = null;
	}

	this.update = function() {
		this.destroy();
		initialize();
	}

	initialize.apply(this, arguments);
};

var App = function(rootElement) {

	var rootElement = rootElement;
	var rotateInterval, refreshInterval;

	// keep track of groups, each items represents a group and its current
	// active index
	var groups = {};

	// switch to the next pane
	var rotate = function() {
		var rotated = {};
		
		$(rootElement).find("section").each(function() {
			var turtle = $(this);
			var group = turtle.attr("class");
			var panes = rootElement.find("section." + group).size();

			// multiple turtles in 1 group
			if (panes > 1) {
				
				// first rotate
				if (groups[group] == null) {
					groups[group] = 0;
					rotated[group] = true;
				}
				else if (!rotated[group]) {
					groups[group]++;
					rotated[group] = true;
					
					// check if next element exists
					if (groups[group] >= panes)
						groups[group] = 0;
				}
				
				// check if current turtle is the active turtle
				var index = rootElement.find("section." + group).index(turtle);
				if (index == groups[group]) {
					// check if active turtle has a ticker
					if(turtle.find("h3 ol").length == 0)
						tick(turtle);
					
					$(this).show();
				}
				else
					$(this).hide();
			}
			// always show if only 1 turtle in group
			else
				turtle.show();
		});
	};

	var initializeHtml = function() {
		$(rootElement).find("section").each(function() {
			var turtle = $(this);
			
			// an initial rotate is called to activate the first turtle
			rotate(turtle);
			
			// when the turtle triggers the 'rendered' event we will add the ticker
			turtle.bind("rendered", function() {
				tick(turtle);
			});
		});
	};

	// add ticker to turtle
	var tick = function(turtle) {
		var group = turtle.attr("class");
		var panes = rootElement.find("section." + group).size();

		if (panes > 1) {
			// ticker placeholder
			var header = turtle.find("h3");
			if (header.find("ol").length != 0)
				var ol = header.find("ol").html("");
			else {
				var ol = $("<ol>");
				header.append(ol);
			}

			// generate ticker
			var index = rootElement.find("section." + group).index(turtle);
			for ( var i = 0; i < panes; i++) {
				var li = $("<li>");
				if (i == index)
					li.addClass('current');
				li.html('&nbsp;');
				ol.append(li);
			}
		}
	};

	var initialize = function() {
		initializeHtml();
		addBehaviours();
	};

	var addBehaviours = function() {
		rotateInterval = window.setInterval(rotate, 8000);
	};

	var removeBehaviours = function() {
		window.clearInterval(rotateInterval);
		window.clearInterval(refreshInterval);
	};

	this.destroy = function() {
		removeBehaviours();

		rootElement.empty();
		rootElement = null;
	}

	this.update = function() {
		this.destroy();
		initialize();
	}

	initialize.apply(this, arguments);
};

$(document).ready(function() {

	clock = new Clock($("#clock"));
	app = new App($("#main"));

});