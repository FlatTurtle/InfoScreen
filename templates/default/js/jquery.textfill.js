(function($) {
	$.fn.textfill = function(options) {
		var defaults = {
			minSize: 3,
			innerTag: 'span'
		};
		var options = jQuery.extend(defaults, options);

		return this.each(function() {
			// get max font size
			if(options.maxSize === undefined) {
				options.maxSize = $(this).css('font-size').replace(/px/,'');
			}
			
			var fontSize = options.maxSize;
			var child = $(options.innerTag + ':visible:first', this);
			var maxHeight = $(this).height();
			var maxWidth = $(this).width();
			var textHeight;
			var textWidth;
			
			do {
				child.css('font-size', fontSize);
				textHeight = child.height();
				textWidth = child.width();
				fontSize = fontSize - 1;
			} while ((textHeight > maxHeight || textWidth > maxWidth) && fontSize > options.minSize);
		});
	};
})(jQuery);