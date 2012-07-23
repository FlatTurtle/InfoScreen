
var Magnify = {
	timer : null,
		
	turtle : function(id, duration) {
		// default duration
		if (duration == undefined)
			duration = 10000;
		
		var element = $(".turtle#" + id);

		if (element.length != 0) {
			var parent = element.parent();
			
			// switch to turtle
			Switcher.to(id);
			
			// magnify turtle
			Magnify.group(parent.attr("data-group"), duration);
		}
	},
	
	group : function(id, duration) {
		// default duration
		if (duration == undefined)
			duration = 10000;
		
		var element = $('.group[data-group="' + id + '"]');
		if (element.length != 0) {
			
			$(".group").each(function() {
				if ($(this)[0] != element[0]) {
					$(this).animate({"width": "0%"});
				}
			});
			
			element.animate({"width": "100%"}, 400, function() {
				// trigger manual resize event
				element.addClass("magnified").find(".turtle").addClass("magnified").trigger("resize");
			});
		}
		
		if (duration != 0) {
			clearTimeout(Magnify.timer);
			Magnify.timer = setTimeout(Magnify.reset, duration);
		}
	},
	
	reset : function() {
		$(".group").removeClass("magnified").each(function() {
			$(this).animate({"width": $(this).attr("data-width") + "%"}, 400, function() {
				$(this).removeClass("magnified").find(".turtle").trigger("resize");
			});
		});
	}

};
