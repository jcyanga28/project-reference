$(document).ready(function(){
	$.fn.ajaxsearch = function(option) {
		$(this).focus();
		var myTimer = 0;
		$(this).on('keyup',function(){
			var search = $(this).val();
			// cancel any previously-set timer
			if (myTimer) {
				clearTimeout(myTimer);
			}
			
			if (search == '') {
				$(option.result).fadeOut();
			}else{
				myTimer = setTimeout(function() {
					$.get(option.url,{ project: option.project, group: option.group, search: search }, function(response){
						$(option.result).fadeIn();
						$(option.result).html(response);

						$(".contact-info").each(function() {
							$(this).submit(function( event ) {
								event.preventDefault();
								// console.log($(this));
								var a = $(this).serialize();
								$.ajax({
									type:'post',
									url: option.post_url,
									data:a,
									beforeSend:function(){
										// launchpreloader();
									},
									complete:function(){
										// stopPreloader();
									},
									success:function(result){
										// window.parent.update_contact();
										parent.$.colorbox.close();
									}
								});
								// parent.$.colorbox.close();
							});
						});
					});
				}, 200);
			   
			};
		});
	};


	
	
});