var Magnify = {

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
			Magnify.group(parent.attr('id'), duration);
		}
	},
	
	group : function(id, duration) {
		// default duration
		if (duration == undefined)
			duration = 10000;
		
		var element = $('.group#' + id);
		if (element.length != 0) {
			$(".group").each(function() {
				if ($(this)[0] == element[0]) {
					element.animate({"width": "100%"}, 400, function() {
						// trigger manual resize event
						element.find('.turtle').trigger('resize');
					});
				} else {
					$(this).animate({"width": "0%"});
				}
			});
		}
		
		setTimeout(Magnify.reset, duration);
	},
	
	reset : function() {
		$(".group").each(function() {
			$(this).animate({"width": $(this).attr("data-width") + "%"});
		});
	}

};