$(function() {
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

	$('.toogleworkingtimeBlock').on("click", function(e) {
		$('.fixDateBox').toggle('blind');
		e.preventDefault();
		e.stopPropagation();
	});

	$('input[name="date[]"]').bind('change', function() {
		$('input[name="auto_open[]"]').prop("checked", false);
	});

	$('input[name="auto_open[]"]').bind('change', function() {
		$('input[name="date[]"]').prop("checked", false);
	});

	$(document).on('change', 'select[name="province"]', function() {
		$.getJSON("account-museum-detail-action.php", {
			type : "province",
			id : $(this).val()
		}).done(function(json) {
			$(".province_box span").text($('select[name="province"] option:selected').text());
			$('select[name="district"]').html('<option value="0">' + $(".district_box span").attr('title') + '</option>');
			$('select[name="sub_district"]').html('<option value="0">' + $(".sub_district_box span").attr('title') + '</option>');
			$.each(json, function(i, item) {
				$('select[name="district"]').append('<option value="' + i + '">' + item + '</option>');
			});
			$(".district_box span").text($(".district_box span").attr('title'));
			$(".sub_district_box span").text($(".sub_district_box span").attr('title'));
		})
	});
	$(document).on('change', 'select[name="district"]', function() {
		$.getJSON("account-museum-detail-action.php", {
			type : "district",
			id : $(this).val()
		}).done(function(json) {
			$(".district_box span").text($('select[name="district"] option:selected').text());
			$('select[name="subDistrict"]').html('<option value="0">' + $(".sub_district_box span").attr('title') + '</option>');
			$.each(json, function(i, item) {
				$('select[name="subDistrict"]').append('<option value="' + i + '">' + item + '</option>');
			});
			$(".sub_district_box span").text($(".sub_district_box span").attr('title'));
		})
	});
	$(document).on('change', 'select[name="subDistrict"]', function() {
		$(".sub_district_box span").text($('select[name="subDistrict"] option:selected').text());
	});

	$('.btnReset').click(function(e) {
		$('#myform')[0].reset();

		$(".province_box span").text($(".province_box span").attr('title'));
		$(".district_box span").text($(".district_box span").attr('title'));
		$(".sub_district_box span").text($(".sub_district_box span").attr('title'));

		$('select[name="district"]').html('<option value="0">' + $(".district_box span").attr('title') + '</option>');
		$('select[name="subDistrict"]').html('<option value="0">' + $(".sub_district_box span").attr('title') + '</option>');

		e.preventDefault();
		e.stopPropagation();
	});

	$('.btnSubmit').click(function(e) {
		$("#myform").submit();

		e.preventDefault();
		e.stopPropagation();
	});

	$('#btnBrowseStoryPic').bind('click', function(e) {
		$('input[data-name="HIS"]').click();
		e.preventDefault();
		e.stopPropagation();
	});

	$('#btnBrowsePhysicalPic').bind('click', function(e) {
		$('input[data-name="PHY"]').click();
		e.preventDefault();
		e.stopPropagation();
	});

	$('#btnBrowseLandScapePic').bind('click', function(e) {
		$('input[data-name="LAND"]').click();
		e.preventDefault();
		e.stopPropagation();
	});

	$('#btnBrowseExhibitionPic').bind('click', function(e) {
		$('input[data-name="EXH"]').click();
		e.preventDefault();
		e.stopPropagation();
	});

	$('#btnBrowseArchivePic').bind('click', function(e) {
		$('input[data-name="ARC"]').click();
		e.preventDefault();
		e.stopPropagation();
	});

	$('#btnBrowseTopArchivePic').bind('click', function(e) {
		$('input[data-name="TOP_ARC"]').click();
		e.preventDefault();
		e.stopPropagation();
	});

	$('#btnBrowseStoragePic').bind('click', function(e) {
		$('input[data-name="STORAGE"]').click();
		e.preventDefault();
		e.stopPropagation();
	});

	$('#btnBrowsePublicInfoPic').bind('click', function(e) {
		$('input[data-name="PUBLIC_INFO"]').click();
		e.preventDefault();
		e.stopPropagation();
	});

	$('#btnBrowseNearbyPic').bind('click', function(e) {
		$('input[data-name="NEARBY"]').click();
		e.preventDefault();
		e.stopPropagation();
	});

	$('.deleteMap').bind('click', function(e) {
		if (confirm('ต้องการลบรูปภาพหรือไม่?')) {
			$('#hid' + $(this).attr('data-id')).val('DEL');
			$('#img'+ $(this).attr('data-id')).attr('src' , '');
			e.preventDefault();
			e.stopPropagation();
		}
	});

	$("#browseMapEng").change(function() {
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			reader.onload = imageIsLoadedMapEng;
			reader.readAsDataURL(this.files[0]);
		}
	});

	$("#browseMapLoc").change(function() {
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			reader.onload = imageIsLoadedMapLoc;
			reader.readAsDataURL(this.files[0]);
		}
	});
});
function imageIsLoadedMapEng(e) {
	$('#imgMapEng').attr('src', e.target.result);
};
function imageIsLoadedMapLoc(e) {
	$('#imgMapLoc').attr('src', e.target.result);
};