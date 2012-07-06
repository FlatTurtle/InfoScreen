var App = function(rootElement) {
	
	var rootElement = rootElement;
	var rotateTimer;

	// switch to the next turtle in the group (if > 1)
	var rotate = function() {
		$(rootElement).find(".group").each(function() {
			var panes = $(this).find(".turtle").size();

			if(panes > 1) {
				var previous = $(this).find(".turtle.active");
				
				// first rotate
				if(previous.length == 0) {
					active = $(this).find(".turtle").first();
					active.addClass("active");
					
					tick(active); // add ticker
					active.fadeIn(500);
				}
				else {
					var active = previous.next();
					
					// out of bounds
					if(active.length == 0) {
						active = $(this).find(".turtle").first();
					}
					
					// add or display ticker
					tick(active);

					// hide the previous turtle and trigger a jQuery event
					previous.hide();
					previous.trigger("hidden");
					
					// show the active turtle and trigger a jQuery event
					active.show();
					active.trigger("shown");
					
					active.addClass("active");
					previous.removeClass("active");
				}
			} else {
				// make the only turtle active
				var active = $(this).find(".turtle").first();
				active.addClass("active");
			}
		});
	};

	var initializeHtml = function() {
		// an initial rotate to activate the first turtle
		rotate();
	};

	// add ticker to turtle
	var tick = function(turtle) {
		var panes = turtle.parent().find(".turtle").size();
		
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
			
			/* REMOVING TICKER ANIMATION TEMPORARY ----------------------
			
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
			}, 50);
			
			-------------------------------------------------------------- */
		}
	};

	var initialize = function() {
		initializeHtml();
		addBehaviours();
	};

	var addBehaviours = function() {
		// set rotate timer
		rotateTimer = window.setInterval(rotate, infoScreen.interval);
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

	app = new App($("#main"));

});