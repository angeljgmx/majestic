/*Name : TweeCool
 *version: 1.5 
 *Description: get the latest tweets from twitter.
 *Website: www.tweecool.com
 *Licence: no licence, feel free to do whatever you want.
 * Author: TweeCool
 */
(function($) {
	$.fn.extend({

		tweecool : function(options) {

			var defaults = {
				username : 'BotaSaga',
				limit : 5,
				profile_image : true,
				show_time : true,
				show_media : false,
                                show_media_size: 'thumb'  //values: small, large, thumb, medium 

			}

			var options = $.extend(defaults, options);

			function xTimeAgo(time) {
				var nd = new Date();
				//var gmtDate = Date.UTC(nd.getFullYear(), nd.getMonth(), nd.getDate(), nd.getHours(), nd.getMinutes(), nd.getMilliseconds());
				var gmtDate = Date.parse(nd);
				var tweetedTime = time * 1000; //convert seconds to milliseconds
				var timeDiff = (gmtDate - tweetedTime) / 1000; //convert milliseconds to seconds
				
				var second = 1, minute = 60, hour = 60 * 60, day = 60 * 60 * 24, week = 60 * 60 * 24 * 7, month = 60 * 60 * 24 * 30, year = 60 * 60 * 24 * 365;

				if (timeDiff > second && timeDiff < minute) {
					return Math.round(timeDiff / second) + " segundos antes";
				} else if (timeDiff >= minute && timeDiff < hour) {
					return Math.round(timeDiff / minute) + " minutos antes";
				} else if (timeDiff >= hour && timeDiff < day) {
					return Math.round(timeDiff / hour) + " horas antes";
				} else if (timeDiff >= day && timeDiff < week) {
					return Math.round(timeDiff / day) + " d&iacute;s antes";
				} else if (timeDiff >= week && timeDiff < month) {
					return Math.round(timeDiff / week) + " semanas antes";
				} else if (timeDiff >= month && timeDiff < year) {
					return Math.round(timeDiff / month) + " meses antes";
				} else {
					return 'cerca de un a&ntilde;o atras';
				}

			}

			return this.each(function() {
				var o = options;
				var wrapper = $(this);
				var wInner = $('<ul class="tweet_list">').appendTo(wrapper);
				var urlpattern = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
                                var media = '';

				$.getJSON("https://www.api.tweecool.com/?screenname=" + o.username + "&count=" + o.limit, function(data) {

					if (data.errors || data == null) {
						wrapper.html('No tweets available.');
						return false;
					}

					if (o.profile_image) {
						var pIMG = '<a href="https://twitter.com/' + o.username + '" target="_blank"><img src="' + data.user.profile_image_url + '" alt="' + o.username + '" /></a>';
					} else {
						pIMG = '';
					}

					$.each(data.tweets, function(i, field) {

						if (o.show_time) {
							var timestamp = xTimeAgo(field.timestamp);
						} else {
							var timestamp = '';
						}
                                                
                                                if(o.show_media && field.media_url){
                                                    media =  '<a href="https://twitter.com/' + o.username + '" target="_blank"><img src="' + field.media_url + ':'+o.show_media_size+'" alt="' + o.username + '" class="media" /></a>';
                                                }else{
                                                   media = ''; 
                                                }

						wInner.append('<li class="tweet_odd">' + pIMG + '<div class="tweets_txt"><i class=\"icon-twitter\"></i>' + field.text.replace(urlpattern, '<a href="$1" target="_blank">$1</a>') + media + ' <span>' + timestamp + '</span></div></li>');
					});

				}).fail(function(jqxhr, textStatus, error) {
					//var err = textStatus + ', ' + error;
					wrapper.html('No tweets available');
				});

			});

		}
	});

})(jQuery); 
