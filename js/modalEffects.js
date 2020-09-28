$(".media_poster").click(function(){
    var modal_id=$(this).attr("data-modal");
		$("#"+modal_id).toggleClass("md-show");

		$(".md-close").click(function(){
				$("#"+modal_id).removeClass("md-show");
				$("#"+modal_id+" iframe").attr('src', $("#"+modal_id+" iframe").attr('src'));
		});

		$(".md-overlay").click(function(){
				$("#"+modal_id).removeClass("md-show");
				$("#"+modal_id+" iframe").attr('src', $("#"+modal_id+" iframe").attr('src'));
		});

		$( document ).on( 'keydown', function ( e ) {
		    if ( e.keyCode === 27 ) { // ESC
		      	$("#"+modal_id).removeClass("md-show");
				$("#"+modal_id+" iframe").attr('src', $("#"+modal_id+" iframe").attr('src'));
		    }
		});
});
