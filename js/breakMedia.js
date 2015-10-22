var old_position = 0;

function breakMedia(id){
	var MyType = $('.owl-item').eq(id).find('.slide-content > *').attr('data-type');

	if(MyType == 'embed'){
		var mySrc = $('.owl-item').eq(id).find('.slide-content > iframe').attr('src');
			$('.owl-item').eq(id).find('.slide-content > iframe').attr('src',mySrc);
	}else if(MyType == 'video'){
		$('.owl-item').eq(id).find('.slide-content > video').get(0).pause();
	}else if(MyType == 'sound'){
		$('.owl-item').eq(id).find('.slide-content .cp-pause').click();
	}
}