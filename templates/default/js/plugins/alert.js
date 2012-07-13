var Alert = {

	first : true,

	add : function(url) {
		// check if overlay element exists
		if (Alert.first || $('#overlaymessage').css('display') == 'none') {
			Alert.first = false;
			Alert.element = $('<div class=\'overlaymessage\' id=\'overlaymessage\' style=\'display:none;\'></div><div class=\'boxmessage\' id=\'boxmessage\'><a class=\'boxmessageclose\' id=\'boxclose\'></a><p>'+url+'</p></div>');
			$('body').prepend(Alert.element);
            $('#overlaymessage').fadeIn('fast',function(){
                $('#boxmessage').animate({'top':'160px'},500);
            });
            setTimeout(function() {
                $('#boxmessage').animate({'top':'-200px'},500,function(){
                    $('#overlaymessage').fadeOut('fast');
                });
            },5000);
		}

		//Msg.element.text(url);

		// show element
		//Msg.element.show();
	},

	remove : function() {
		// hide overlay
		Alert.element.hide();
	},

	destroy : function() {
		// remove element
		Alert.element.remove();
	}

}
