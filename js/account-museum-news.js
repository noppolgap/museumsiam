$(document).ready(function() {

	// if($('.mytextarea').length > 0){
	// tinymce.init({
	// selector: ".mytextarea",
	// theme: "modern",
	// image_advtab: true
	// });
	// }

	$('#btnSubmit').bind('click', function(e) {
		e.preventDefault();

		var ret = true;

		$('#nameThError').hide();
		$('#nameEnError').hide();
		$('#briefThError').hide();
		$('#briefEnError').hide();
		$('#detailThError').hide();
		$('#detailEnError').hide();
		if ($('#txtDescLoc').val() == '') {
			ret = false;
			$('#nameThError').show();
		}
		if ($('#txtDescEng').val() == '') {
			ret = false;
			$('#nameEnError').show();
		}

		if ($('#txtDetailLoc').val() == '') {
			//if (tinyMCE.get('txtDetailLoc').getContent() == '') {
			ret = false;
			$('#detailThError').show();
		}

		if ($('#txtDetailEng').val() == '') {
			//if (tinyMCE.get('txtDetailEng').getContent() == '') {
			ret = false;
			$('#detailEnError').show();
		}
		if (ret) {
			document.getElementById("frmcms").submit();
		} else
			return false;

	});

	$('#btnBrowseNewPic').bind('click', function(e) {
		$('input[data-name="NEWS_PIC"]').click();
		e.preventDefault();
		e.stopPropagation();
	});

	$('#btnYoutubeAdd').bind('click', function(e) {
		if ($('#txtYouTubeAdd').val() == '') {
			alert('กรุณาระบุLink Youtube');
		} else if (!youtube_parser($('#txtYouTubeAdd').val())) {
			alert('Link Youtube ไม่ถูกต้อง');
		} else {
			//short video
			var shortName = youtube_parser($('#txtYouTubeAdd').val());

			var index = $('.youtubePreview .box-tumb').length;
			index++;

			var box = '<div class="box-tumb museumbox-thumb" id="img_' + shortName + '" data-id="' + index + '">';
			box += '<div class="box-pic" style="min-height:92px !important;">';
			box += '<img alt="" style="background-image: url(\'http://img.youtube.com/vi/' + shortName + '/maxresdefault.jpg\');background-size: 100% auto;background-position: center;    height: 92px;" >';
			box += '</div>';
			box += '<a  class="btn-delete btn-remove-youtube" data-id="' + shortName + '" onclick="removeYoutube(\'' + shortName + '\');return false;">';
			box += '</a>';
			box += '</div>';
			$('.youtubePreview').append(box).show();
			$('#divHidYoutube').append('<input type="hidden" name="YOUTUBE_file[]" id="input_' + shortName + '" value="' + shortName + '" >');

		}
		$('#txtYouTubeAdd').val('');
		e.preventDefault();
		e.stopPropagation();
	});

});

function removeYoutube(name) {
	if (confirm('คุณต้องการลบ Link Youtube หรือไม่ ?')) {
		$('#input_' + name).remove();
		$('#img_' + name).remove();
		$('#txtYouTubeAdd').val('');
	}
}

function youtube_parser(url) {
	var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
	var match = url.match(regExp);
	if (match && match[7].length == 11) {
		return match[7];
	} else {
		return false;
	}
}