var mytext = {
		museumDescLoc:"ชื่อพิพิธภัณฑ์ภาษาไทย", 
		museumDescEng:"ชื่อพิพิธภัณฑ์ภาษาอังกฤษ",
		address:"ที่อยู่", 
		province:"จังหวัด",
		district:"อำเภอ/เขต",
		subDistrict:"ตำบล/แขวง",
		workingDay:"วันและเวลาทำการ",
		telephone:"โทรศัพท์",
		mobile:"โทรศัพท์มือถือ", 
		fax:"โทรสาร",
		postcode:"รหัสไปรษณีย์",
		captcha:"รหัสยืนยัน",
		attachFile:"กรุณาแนบเอกสารยืนยัน",
		warning0:"ไม่สามารถลงทะเบียนได้เพราะ ",
		warning1:"กรุณาระบุ ",
		warning2:"รหัสผ่านไม่ตรงกัน ",
		warning3:"รูปแบบอีเมล์ไม่ถูกต้อง ",
		warning4:"รหัสผ่านไม่น้อยกว่า 6 ตัวอีกษร ",
		warning5:"ไม่ถูกต้อง",
		warning6:"ถูกต้อง",
		warning7:"ไม่สามารถใช้งานได้ เพราะถูกใช้งานแล้ว"
	};
	

$(function() {
    $(".workingtime").slider({
        range: true,
        min: 0,
        max: 1440,
        step: 5,
        values: [ 480, 1080 ],
        slide: function( event, ui ) {
            var hours1 = Math.floor(ui.values[0] / 60);
            var minutes1 = ui.values[0] - (hours1 * 60);

            if(hours1.length < 10) hours1= '0' + hours;
            if(minutes1.length < 10) minutes1 = '0' + minutes;

            if(minutes1 == 0) minutes1 = '00';

            var hours2 = Math.floor(ui.values[1] / 60);
            var minutes2 = ui.values[1] - (hours2 * 60);

            if(hours2.length < 10) hours2= '0' + hours;
            if(minutes2.length < 10) minutes2 = '0' + minutes;

            if(minutes2 == 0) minutes2 = '00';

            
			var id = $(this).attr("data-box");
			$('#amount-time-'+id).text(hours1+':'+minutes1+' - '+hours2+':'+minutes2 );
            $(this).find('.startdate').val(hours1+':'+minutes1);
            $(this).find('.enddate').val(hours2+':'+minutes2);
        }
    });
    
    $('.toogleworkingtimeBlock').on( "click", function(e) {
		$('.fixDateBox').toggle('blind'); 
		e.preventDefault();
		e.stopPropagation(); 
	});
	
	$('input[name="date[]"]').bind('change' , function (){
		$('input[name="auto_open[]"]').prop( "checked", false );
	});
	
	$('input[name="auto_open[]"]').bind('change' , function (){
		$('input[name="date[]"]').prop( "checked", false );
	});
	
	
	$(document).on('change', 'select[name="province"]', function() {	
		$.getJSON( "register-action.php", { type: "province", id: $(this).val() } )
		  	.done(function( json ) {
		    	$( ".province_box span" ).text( $( 'select[name="province"] option:selected' ).text() );
		    	$( 'select[name="district"]').html('<option value="0">'+$( ".district_box span" ).attr('title')+'</option>');
		    	$( 'select[name="sub_district"]').html('<option value="0">'+$( ".sub_district_box span" ).attr('title')+'</option>');
				$.each( json, function( i, item ) {
					$( 'select[name="district"]').append( '<option value="'+i+'">'+item+'</option>' );
		      	});
		      	$( ".district_box span" ).text( $( ".district_box span" ).attr('title') );
		      	$( ".sub_district_box span" ).text( $( ".sub_district_box span" ).attr('title') );
		  	})	  	    
	});
	$(document).on('change', 'select[name="district"]', function() {	
		$.getJSON( "register-action.php", { type: "district", id: $(this).val() } )
		  	.done(function( json ) {
		    	$( ".district_box span" ).text( $( 'select[name="district"] option:selected' ).text() );
		    	$( 'select[name="sub_district"]').html('<option value="0">'+$( ".sub_district_box span" ).attr('title')+'</option>');
				$.each( json, function( i, item ) {
					$( 'select[name="sub_district"]').append( '<option value="'+i+'">'+item+'</option>' );
		      	});
		      	$( ".sub_district_box span" ).text( $( ".sub_district_box span" ).attr('title') );
		  	})	  	    
	});
	$(document).on('change', 'select[name="sub_district"]', function() {
		$( ".sub_district_box span" ).text( $( 'select[name="sub_district"] option:selected' ).text() );
	});	
		
	$('.btnSubmit').click(function(e) {
		$("#myform").submit();
		
        e.preventDefault();
        e.stopPropagation();
    });
	  
	$('.btnReset').click(function(e) {
		$('#myform')[0].reset();
		
		$( ".province_box span" ).text( $( ".province_box span" ).attr('title') );
		$( ".district_box span" ).text( $( ".district_box span" ).attr('title') );
		$( ".sub_district_box span" ).text( $( ".sub_district_box span" ).attr('title') );
		
		$( 'select[name="district"]').html('<option value="0">'+$( ".district_box span" ).attr('title')+'</option>');
		$( 'select[name="sub_district"]').html('<option value="0">'+$( ".sub_district_box span" ).attr('title')+'</option>');
		
        e.preventDefault();
        e.stopPropagation();
    });	 
    
    $("#myform").on('submit',function(){

		var error = false;
		var msg = mytext['warning0'];
		var meseumDescLoc 		= $('input[name="txtMuseumDescLoc"]').val();
		var meseumDescEng 		= $('input[name="txtMuseumDescEng"]').val();
		var address  = $('input[name="txtMuseumAddress"]').val(); 
		var province = $('select[name="province"]').val();
		var subDistrict = $('select[name="sub_district"]').val();
		var district = $('select[name="district"]').val();
		var telephone 	= $('input[name="telephone"]').val();
		var mobile 		= $('input[name="mobile"]').val();
		var fax 		= $('input[name="fax"]').val();
		var postcode	= $('input[name="postcode"]').val();
		var autoWorkingDay = $('input[name="auto_open[]"]:checked').length > 0;
		var manualWorkingDay  = $('input[name="date[]"]:checked').length > 0;
		var attachFile = $('#fileToUpload').val();
		if(meseumDescLoc == ''){
			msg += "\n - "+mytext['warning1']+" "+mytext['museumDescLoc'];
			error = true;
		}
		if(meseumDescEng == ''){
			msg += "\n - "+mytext['warning1']+" "+mytext['museumDescEng'];
			error = true;
		}
		if(address == '')
		{
			msg += "\n - "+mytext['warning1']+" "+mytext['address'];
			error = true;
		}
		if(autoWorkingDay == false && manualWorkingDay == false)
		{
			msg += "\n - "+mytext['warning1']+" "+mytext['workingDay'];
			error = true;
		}
		if (attachFile == '')
		{
			msg += "\n - "+mytext['warning1']+" "+mytext['attachFile'];
			error = true;
		}
			
		if(grecaptcha.getResponse() == '') {
			msg += "\n - "+mytext['warning1']+" "+mytext['captcha'];
			error = true;
		}
			
		if(error){
			alert(msg);
			return false;
		}else{
		    return true;
		}		

	});	 
});