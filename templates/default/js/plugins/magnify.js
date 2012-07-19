
var Magnify = {
	runningTimeout : null,	
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
			Magnify.group(parent.attr("id"), duration);
		}
	},
	
	group : function(id, duration) {
		// default duration
		if (duration == undefined)
			duration = 10000;
		
		var element = $('.group#' + id);
		if (element.length != 0) {
			
			var border = element.find(".turtle").css("border-left-width");
			
			$(".group").each(function() {
				if ($(this)[0] == element[0]) {
					element.animate({"width": "100%"}, 400, function() {
						// trigger manual resize event
						element.find(".turtle").addClass("magnified").trigger("resize");
					});
				} else {
					$(this).animate({"width": "0%"});
				}
			});
		}
		
		clearTimeout(this.runningTimeout);
		this.runningTimeout = setTimeout(Magnify.reset, duration);
	},
	
	reset : function() {
		$(".group").each(function() {
			$(this).animate({"width": $(this).attr("data-width") + "%"}, 400, function() {
				$(this).find(".turtle").removeClass("magnified").trigger("resize");
			});
		});
	}

};
