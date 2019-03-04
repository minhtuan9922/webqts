// JavaScript Document

//ajax tìm kiếm
$(document).ready(function(){
	$('#timkiem').keyup(function() {
		$('.ketqua').show('fast');
		var tukhoa = $('#timkiem').val();
		$(window).click(function() {
			$('.ketqua').hide();
		});
	//	$.ajax({
	//		method:"POST",
	//		url:"<?=base_url('timkiem'); ?>",
	//		data:{tukhoa:tukhoa},
	//		success: function(result)
	//		{
	//			console.log(result);
	//			$('#result').html(result);
	//		}
	//	});
	});
	
//	$(".col-6").hide();
//	var phim_moi = $("#phim_moi").offset().top;
//	var height = $(window).height(); console.log(height);
//	$(window).bind('scroll', function() {
//		if (($(window).scrollTop() + height - 100) > phim_moi) {
//			$(".col-6").first().show("fast", function showNext() {
//				$(this).next(".col-6").show("fast", showNext);
//			});
//		}
//		else {
//			$(".col-6").hide(1000);
//		}
//	});
});

alertify.defaults = {
        // dialogs defaults
        autoReset:true,
        basic:false,
        closable:true,
        closableByDimmer:true,
        frameless:false,
        maintainFocus:true, // <== global default not per instance, applies to all dialogs
        maximizable:true,
        modal:true,
        movable:true,
        moveBounded:false,
        overflow:true,
        padding: true,
        pinnable:true,
        pinned:true,
        preventBodyShift:false, // <== global default not per instance, applies to all dialogs
        resizable:true,
        startMaximized:false,
        transition:'pulse',

        // notifier defaults
        notifier:{
            // auto-dismiss wait time (in seconds)  
            delay:5,
            // default position
            position:'bottom-right',
            // adds a close button to notifier messages
            closeButton: false
        },

        // language resources 
        glossary:{
            // dialogs default title
            title:'phimMT',
            // ok button text
            ok: 'OK',
            // cancel button text
            cancel: 'Cancel'            
        },

        // theme settings
        theme:{
            // class name attached to prompt dialog input textbox.
            input:'ajs-input',
            // class name attached to ok button
            ok:'ajs-ok',
            // class name attached to cancel button 
            cancel:'ajs-cancel'
        }
    };

