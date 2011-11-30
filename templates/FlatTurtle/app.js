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

	// keep track of turtle boards
	var turtles = [];

	// switch to the next board
	var rotate = function() {
		var that = this;

		$(rootElement).find("section").each(function() {
			var turtle = $(this);
			var index = turtle.index();
			var boards = turtle.find(".board").size();

			// turtle has multiple boards
			if (boards > 1) {
				if (turtles[index] == null)
					turtles[index] = 0;
				else
					turtles[index]++;
			}

			display(turtle);
		});
	}

	var initializeHtml = function() {
		$(rootElement).find("section").each(function() {
			var turtle = $(this);
			turtle.bind("rendered", function() {
				display(turtle);
			});
		});
	}

	// displays the correct board
	var display = function(turtle) {
		var turtle = turtle;
		var index = turtle.index();

		if (turtles[index] == null)
			turtles[index] = 0;

		// check if active board exists
		if (turtle.find(".board:nth-child(" + (turtles[index] + 1) + ")").length == 0)
			turtles[index] = 0;

		// display correct board
		turtle.find(".board").each(function() {
			if ($(this).index() == turtles[index])
				$(this).show();
			else
				$(this).hide();
		});

		tick(turtle);
	}

	var tick = function(turtle) {
		var turtle = turtle;
		var index = turtle.index();
		var boards = turtle.find(".board").size();

		if (turtles[index] == null)
			turtles[index] = 0;

		if (boards > 1) {
			var active = turtle.find(".board:nth-child(" + (turtles[index] + 1)
					+ ")");

			// ticker placeholder
			var header = active.find("h3");
			if (header.find("ol").length != 0)
				var ol = header.find("ol").html("");
			else {
				var ol = $("<ol>");
				header.append(ol);
			}

			// generate ticker
			for ( var i = 0; i < boards; i++) {
				var li = $("<li>");
				if (turtles[index] === i) {
					li.addClass('current');
				}
				li.html('&nbsp;');
				ol.append(li);
			}
		}
	}

	var initialize = function() {
		initializeHtml();
		addBehaviours();
	};

	var addBehaviours = function() {
		rotateInterval = window.setInterval(rotate, 5000);
		refreshInterval = window.setInterval(function() {
			Turtles.trigger("refresh");
		}, 120000);
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
