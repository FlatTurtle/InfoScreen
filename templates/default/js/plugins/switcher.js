var Switcher = {
	
	root : $('#main'),
	interval : false,
	
	rotate : function(id) {
		// iteratie each group
		Switcher.root.find(".group").each(function() {
			
			// number of panes in this turtle group
			var panes = $(this).find(".turtle").size();
			
			if (panes == 1) {
				// mark first turtle as active
				$(this).find(".turtle").first().addClass("active");
				
			} else {
				var orbs = $(this).find("ol");
				
				// check if orbs container exists
				if (orbs.length == 0) {
					orbs = $("<ol>");
					$(this).prepend(orbs);
				}
				
				// wrong number of orbs
				while (orbs.find("li").length < panes) {
					orbs.append("<li>");
				}
				while (orbs.find("li").length > panes) {
					orbs.last("<li>").remove();
				}
				
				// detect next turtle
				var previous = $(this).find(".turtle.active");
				if (previous.length == 0) {
					var active = $(this).find(".turtle").first();
				} else {
					var active = previous.next();
					if (active.length == 0) {
						active = $(this).find(".turtle").first();
					}
				}
				
				if (previous.length != 0) {
					previous.removeClass("active");
					previous.trigger("hidden");
					previous.hide();
				}
				
				// switch classes and trigger events
				active.addClass("active");
				active.trigger("show");
				active.show();
				
				// change orb
				var index = $(this).find(active).index();
				orbs.find("li").removeClass("active");
				orbs.find("li").eq(index - 1).addClass("active");
			}
		});
	},
	
	to : function(id) {
		var turtle = $(root).find('.turtle#' + id);
		
		if (turtle.length == 0)
			return false;
		
		var group = turtle.parent('.group');
		
		// TODO
	},
	
	start : function() {
		Switcher.rotate();
		Switcher.timer = window.setInterval(Switcher.rotate, infoScreen.interval);
	},
	
	stop : function() {
		clearInterval(Switcher.timer);
		Switcher.timer = false;
	}
};

$(document).ready(function() {
	// start switcher
	Switcher.start($("#main"));
});