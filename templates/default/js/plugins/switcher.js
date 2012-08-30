var Switcher = {
	
	root : $("#main"),
	interval : false,
	timer : null,
	
	rotate : function() {
		// iteratie each group
		$(".group").each(function() {
			
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
					var next = $(this).find(".turtle").first();
				} else {
					var next = previous.next();
					if (next.length == 0) {
						next = $(this).find(".turtle").first();
					}
				}
				
				var index = $(this).find(next).index();
				
				// change turtle
				$(this).find(".turtle").removeClass("active").hide().trigger("hide");
				next.addClass("active").show().trigger("show");
				
				// change orb
				orbs.find("li").removeClass("active");
				orbs.find("li").eq(index - 1).addClass("active");
			}
		});
	},
	
	to : function(id) {
		// stop timer
		Switcher.stop();
		
		var turtle = $(".turtle#" + id);
		
		if (turtle.length == 0)
			return false;
		
		var group = turtle.parent();
		var orbs = group.find("ol");
		var index = group.find(turtle).index();
		
		// change orb
		orbs.find("li").removeClass("active");
		orbs.find("li").eq(index - 1).addClass("active");
		
		// change turtle
		group.find(".turtle").removeClass("active").hide().trigger("hide");
		turtle.show().trigger("show");
		
		// start timer
		Switcher.start();
	},
	
	start : function() {
		if(!Switcher.timer) {
			Switcher.timer = window.setInterval(Switcher.rotate, infoScreen.interval);
		}
	},
	
	stop : function() {
		clearInterval(Switcher.timer);
		Switcher.timer = false;
	}
};

$(document).ready(function() {
	// start switcher
	Switcher.rotate();
	Switcher.start();
});