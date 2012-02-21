(function($) {
	$.fn.textfill = function(options) {
		var settings = {
			minSize : 3,
			wrapperTag : 'span',
			wrapperClass : 'auto-sized'
		};

		if (options) {
			$.extend(settings, options);
		}

		return this.each(function() {
			var parent = $(this);

			// check if this has been auto-sized already
			if (parent.is(':visible') && parent.find(settings.wrapperTag + '.' + settings.wrapperClass).length == 0) {
				
				// wrap children, nice and cosy
				parent.wrapInner('<' + settings.wrapperTag + ' class="' + settings.wrapperClass + '" />');
				var wrapper = parent.find(settings.wrapperTag + '.' + settings.wrapperClass);

				// get max font size from parent or settings
				if (settings.maxSize === undefined) {
					var fontSize = parseInt(parent.css('font-size'));
				} else {
					var fontSize = settings.maxSize;
				}

				// calculate the prison dimensions
				var maxHeight = parent.height();
				var maxWidth = parent.width();
				var textHeight, textWidth;

				// ready, set, go!
				do {
					wrapper.css('font-size', fontSize);
					textHeight = wrapper.height();
					textWidth = wrapper.width();
					fontSize = fontSize - 1;
				} while ((textHeight > maxHeight || textWidth > maxWidth) && fontSize > settings.minSize);
			}
		});
	};
})(jQuery);