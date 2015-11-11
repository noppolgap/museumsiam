$(document).ready(function() {
	if ($('.DatePicker').length > 0) {
		$('.DatePicker').datepicker({
			dateFormat : 'd MM yy',
			changeMonth : true,
			changeYear : true,
			yearRange : "-80:+0"

		});
	}

	$("#browseAvarta").change(function() {
		if (this.files && this.files[0]) {
			var reader = new FileReader();

			reader.onload = imageIsLoaded;
			reader.readAsDataURL(this.files[0]);
		} 
	});
	
	$(document).on('change', 'select[name="cmbProvince"]', function() {
		$.getJSON("account-museum-detail-action.php", {
			type : "province",
			id : $(this).val()
		}).done(function(json) {
			$(".province_box span").text($('select[name="cmbProvince"] option:selected').text());
			$('select[name="cmbDistrict"]').html('<option value="0">' + $(".district_box span").attr('title') + '</option>');
			$('select[name="cmbSubDistrict"]').html('<option value="0">' + $(".sub_district_box span").attr('title') + '</option>');
			$.each(json, function(i, item) {
				$('select[name="cmbDistrict"]').append('<option value="' + i + '">' + item + '</option>');
			});
			$(".district_box span").text($(".district_box span").attr('title'));
			$(".sub_district_box span").text($(".sub_district_box span").attr('title'));
		})
	});
	$(document).on('change', 'select[name="cmbDistrict"]', function() {
		$.getJSON("account-museum-detail-action.php", {
			type : "district",
			id : $(this).val()
		}).done(function(json) {
			$(".district_box span").text($('select[name="cmbDistrict"] option:selected').text());
			$('select[name="cmbSubDistrict"]').html('<option value="0">' + $(".sub_district_box span").attr('title') + '</option>');
			$.each(json, function(i, item) {
				$('select[name="cmbSubDistrict"]').append('<option value="' + i + '">' + item + '</option>');
			});
			$(".sub_district_box span").text($(".sub_district_box span").attr('title'));
		})
	});
	$(document).on('change', 'select[name="cmbSubDistrict"]', function() {
		$(".sub_district_box span").text($('select[name="cmbSubDistrict"] option:selected').text());
	});

});

function imageIsLoaded(e) {
	$('#imgAvatar').attr('src', e.target.result);
	// $('#yourImage').attr('src', e.target.result);
};
