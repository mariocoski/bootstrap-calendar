/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
  
  var bigCalendarOptions = {
      "ajax_url"       : "process.php", //url for retrieving the data
      "calendar_type"  : "big", 
      "number_of_weeks": 4, //how many weeks to display
      "first_day"      : "monday", //or sunday
      "booking_url"    : "make_an_appointment.php", //booking url 
      "max_display"    : 7 //how many visits display in a day calendar column - default is 7
  };
  $(".horizontal-calendar-big-wrapper").bootstrapBigCalendar(bigCalendarOptions);  
   
    
    $('.horizontal-calendar-big-wrapper').on("click", ".carousel-control", function() {
        $(".carousel-inner").css("overflow","hidden");
   }); 
    
    
  $('.horizontal-calendar-big-wrapper').on('slid.bs.carousel', function () {
     var id = $(this).attr("data-calendar-id");
    if($('#carousel_inner_'+id+ ' .item:first').hasClass('active')) {
      $(this).children('.horizontal-calendar-big-left').hide();
    }else{
      $(this).children('.horizontal-calendar-big-left').show();
    }
  if($('#carousel_inner_'+id+ ' .item:last').hasClass('active')) {
    $(this).children('.horizontal-calendar-big-right').hide();
  } else {
    $(this).children('.horizontal-calendar-big-right').show();
  } 
  //set overflow to visible to allow dropdown display properly
  $(".carousel-inner").css("overflow","visible");
});
 
    
    
});