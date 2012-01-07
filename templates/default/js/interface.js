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
		var now = new Date(), hours = now.getHours(), minutes = now.getMinutes();
		if (ticker) {
			ticker = false;
			return (hours < 10 ? '0' : '') + hours
					+ '<span style="visibility:visible;">:</span>'
					+ (minutes < 10 ? '0' : '') + minutes;
		} else {
			ticker = true;
			return (hours < 10 ? '0' : '') + hours
					+ '<span style="visibility:hidden;">:</span>'
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

	var interval = 8000;
	
	var rootElement = rootElement;
	var rotateTimer;

	// keep track of groups, each items represents a group and its current active index
	var groups = {};

	// switch to the next pane
	var rotate = function() {
		$(rootElement).find(".group").each(function() {
			var group = $(this).attr("id");
			var panes = $(this).find(".turtle").size();

			if(panes > 1) {
				// first rotate
				if (groups[group] == null) {
					groups[group] = 0;
					
					var active = $(this).find(".turtle:nth-child(" + (groups[group] + 1) + ")");
					if (active.find("h3 ol").length == 0 || active.find("h3 ol li").length != panes) {
						tick(active);
					}
					active.show();
				}
				else {
					// hide active turtle
					var active = $(this).find(".turtle:nth-child(" + (groups[group] + 1) + ")");
					active.hide();
					
					// rotate
					groups[group]++;
					if (groups[group] >= panes) {
						groups[group] = 0;
					}
					
					// activate the ticker for the current turtle
					var active = $(this).find(".turtle:nth-child(" + (groups[group] + 1) + ")");
					tick(active);
					
					// display the active turtle
					active.show();
				}
			}
		});
	};

	var initializeHtml = function() {
		// an initial rotate to activate the first turtle
		rotate();
		
		// bind the turtle's rendered event to add the ticker
		$(rootElement).find(".turtle").each(function() {
			$(this).bind("rendered", function() {
				tick($(this));
			});
		});
	};

	// add ticker to turtle
	var tick = function(turtle) {
		var group = turtle.parent().attr("id");
		var panes = $(".group#" + group + " .turtle").size();
		
		if (panes > 1) {
			var header = turtle.find("h3");
			
			// ticker placeholder
			if (header.find("ol").length == 0) {
				var ol = $("<ol>");
				header.append(ol);
			}
			else {
				var ol = header.find("ol");
			}
			
			// re-render orbs because number of orbs does not equal number of panes
			if(ol.find("li").length != panes) {
				// clear previous orbs
				ol.empty();
				
				// generate ticker
				var index = turtle.index();
				for (var i = 0; i < panes; i++) {
					var li = $("<li>");
					if (i == index) {
						li.addClass("current");
					}
					li.html("&nbsp;");
					ol.append(li);
				}
			}
			
			// add animation
			var active = ol.find("li.current");
			
			// remove animation (needed to restart animation)
			active.css("-moz-animation", "none");
			active.css("-webkit-animation", "none");
			active.css("-ms-animation", "none");
			
			// add animation
			setTimeout(function() {
				active.css("-moz-animation", "spinner " + interval/1000 + "s 1");
				active.css("-webkit-animation", "spinner " + interval/1000 + "s 1");
				active.css("-ms-animation", "spinner " + interval/1000 + "s 1");
			}, 10);
			
			/* -moz-animation: spinner 8s 1;
			 * -webkit-animation: spinner 8s 1;
			 * -ms-animation: spinner 8s 1; */
		}
	};

	var initialize = function() {
		initializeHtml();
		addBehaviours();
	};

	var addBehaviours = function() {
		// set rotate timer
		rotateTimer = window.setInterval(rotate, interval);
	};

	var removeBehaviours = function() {
		window.clearInterval(rotateTimer);
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