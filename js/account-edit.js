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

});

function imageIsLoaded(e) {
	$('#imgAvatar').attr('src', e.target.result);
	// $('#yourImage').attr('src', e.target.result);
};
