$(function() {

    if($('.booking_calendar').length > 0){
        $.getScript( "e-booking-ajax.php" )
          .done(function( script, textStatus ) {
            datepickerStart();
        });
    }else{
        $.getScript( "event-day-ajax.php" )
          .done(function( script, textStatus ) {
            datepickerStart();
        });
    }
});
function datepickerStart(){
    $( "#datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd',
        beforeShowDay: highlightDays,
        onSelect:movetopage
    });
}
function movetopage(date){
	window.location.href = 'news-event-day.php?date='+date;
}
function highlightDays(date) {
    for (var i = 0; i < dates.length; i++) {
        if (new Date(dates[i]).toString() == date.toString()) {
            return [true, 'highlight', tips[i]];
        }
    }
    return [true, ''];
}