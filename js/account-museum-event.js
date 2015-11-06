$(document).ready(function() {

	if ($('.DatePicker').length > 0) {
		$('.DatePicker').datepicker({
			dateFormat : 'd MM yy',
			changeMonth : true,
			changeYear : true,
			yearRange : "-80:+0"

		});
	}

	$(".workingtime").slider({
		range : true,
		min : 0,
		max : 1440,
		step : 5,
		values : [480, 1080],
		slide : function(event, ui) {
			var hours1 = Math.floor(ui.values[0] / 60);
			var minutes1 = ui.values[0] - (hours1 * 60);

			if (hours1 < 10)
				hours1 = '0' + hours1;
			if (minutes1 < 10)
				minutes1 = '0' + minutes1;

			if (minutes1 == 0)
				minutes1 = '00';

			var hours2 = Math.floor(ui.values[1] / 60);
			var minutes2 = ui.values[1] - (hours2 * 60);

			if (hours2 < 10)
				hours2 = '0' + hours2;
			if (minutes2 < 10)
				minutes2 = '0' + minutes2;

			if (minutes2 == 0)
				minutes2 = '00';

			var id = $(this).attr("data-box");
			$('#amount-time-' + id).text(hours1 + ':' + minutes1 + ' - ' + hours2 + ':' + minutes2);
			$(this).find('.startdate').val(hours1 + ':' + minutes1);
			$(this).find('.enddate').val(hours2 + ':' + minutes2);
		}
	});

	$('#btnSubmit').bind('click', function(e) {
		e.preventDefault();

		var ret = true;

		$('#nameThError').hide();
		$('#nameEnError').hide();
		$('#briefThError').hide();
		$('#briefEnError').hide();
		$('#detailThError').hide();
		$('#detailEnError').hide();
		$('#startDateError').hide();
		$('#endDateError').hide();
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
		if ($('#txtStartDate').val() == '') {
			ret = false;
			$('#startDateError').show();
		}
		if ($('#txtEndDate').val() == '') {
			ret = false;
			$('#endDateError').show();
		}

		if (ret) {
			document.getElementById("frmcms").submit();
		} else
			return false;

	});

	$('#btnBrowseEventPic').bind('click', function(e) {
		$('input[data-name="EVENT_PIC"]').click();
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
