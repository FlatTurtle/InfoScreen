var Twitter = {

	element : $("#twitter"),
	timer : null,
	showTimer:null,
	oldTweet: '',
	pendingTweets: new Array(),
	running: false,

	add : function(text, duration) {
		$.getScript("http://dinbror.dk/downloads/jquery.bpopup-0.7.0.min.js", function(data, textStatus, jqxhr) {
			   console.log(data); //data returned
			   console.log(textStatus); //success
			   console.log(jqxhr.status); //200
			   console.log('Load was performed.');
		});
		running = true;
		// default duration
		/*if (duration == undefined)
			duration = 30000;*/
		
		// start timer if needed
		if (Twitter.timer == null) {
			Twitter.timer = window.setInterval(function(){
				Twitter.refresh(text)
				}, 5000);
			}	
	},

	remove : function() {
		// hide message
		$('#popup').bPopup().close();	
		var tweet = Twitter.pendingTweets.shift();
		if(tweet !=undefined && running) Twitter.showMessage(tweet);
	},

	destroy : function() {
		// remove element
		$('#popup').bPopup().close();
		clearTimeout(Twitter.timer);
		Twitter.timer= null;
		running = false;
	},
	refresh : function(hashtag){
		$.ajax({
			url : 'http://data.irail.be/spectql/twitter/search/'+hashtag+'/results.limit(20):json',
			type : "GET",
			dataType: 'json',
			success : function(data, textStatus, xhr) {
				var id;
				var position = data.spectql.length;
				var oldTweet = Twitter.oldTweet;
				for(var x= (data.spectql.length-1) ; x >=0 ; x--){
					if(data.spectql[x].id == oldTweet){
						position = x;
						//console.log('position old tweet '+position);
					}
				}
				for(var i= (position-1); i >= 0 ; i--){
					Twitter.pendingTweets.push(data.spectql[i]);
				}
				Twitter.oldTweet = data.spectql[0].id;
				
				
				if(Twitter.element.css('display') != 'block'){
					var tweet = Twitter.pendingTweets.shift();
					if(tweet !=undefined) Twitter.showMessage(tweet);
				}
				console.log(Twitter.pendingTweets.length);
			},
			error : function(xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
			}
		});
	},
	showMessage: function(tweet){
		// check if message element exists
		if (Twitter.element.length == 0) {
			Twitter.element = $('<div id="popup" display="none"><div id="content"><img style="height:100px;width:100px"></img><div id="username"></div><div id="text"></div><div class="color" style="width:100%;height:5px;margin:5px"/></div></div>').hide();
			$("body").prepend(Twitter.element);
		}
		//var span = Twitter.element.find("#wrap");
		Twitter.element.find("#text").html(tweet.text);
		Twitter.element.find("img").attr('src',tweet.profile_image_url);
		Twitter.element.find("#username").html(tweet.from_user_name);
		/*var words = tweet.text.split(" ");
		for( x in words){
			if(words[x].indexOf("http://") !=-1) console.log(words[x]);
		}*/
		
		//Twitter.element.fadeIn();
		//span.css("margin-top", "-" + (span.height()/2) + "px");
		$('#popup').bPopup();

		clearTimeout(Twitter.showTimer);
		Twitter.showTimer = setTimeout(Twitter.remove, 15000);
	}

};