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

	// keep track of groups, each items represents a group and its current active index
	var groups = {};

	// switch to the next pane
	var rotate = function() {
		$(rootElement).find(".group").each(function() {
			var group = $(this).attr("id");
			var panes = $(this).find(".turtle").size();

			if(panes > 1) {
				if (groups[group] == null)
					groups[group] = 0;
				
				// hide active turtle
				var active = $(".group#" + group +" .turtle:nth-child(" + (groups[group] + 1) + ")");
				active.hide();
				
				// rotate
				groups[group]++;
				if (groups[group] >= panes) {
					groups[group] = 0;
				}
				
				// check if active turtle has a ticker
				var active = $(".group#" + group +" .turtle:nth-child(" + (groups[group] + 1) + ")");
				if (active.find("h3 ol").length == 0 || active.find("h3 ol li").length != panes) {
					tick(active);
				}
				
				// show active
				active.show();
			}
		});
	};

	var initializeHtml = function() {
		$(rootElement).find(".turtle").each(function() {
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
		var group = turtle.parent().attr("id");
		var panes = $(".group#" + group + " .turtle").size();

		if (panes > 1) {
			// ticker placeholder
			var header = turtle.find("h3");
			if (header.find("ol").length != 0) {
				var ol = header.find("ol").html("");
			}
			else {
				var ol = $("<ol>");
				header.append(ol);
			}

			// generate ticker
			var index = turtle.index();
			for (var i = 0; i < panes; i++) {
				var li = $("<li>");
				if (i == index) {
					li.addClass('current');
				}
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
		// set rotate timer
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