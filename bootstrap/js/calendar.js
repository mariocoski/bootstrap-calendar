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
  
  var smallCalendarOptions = {
      "ajax_url"         : "process.php",
      "calendar_type"    : "small",
      "number_of_weeks"  : 4,
      "booking_url"      : "make_an_appointment.php",
      "max_in_row"       : 4,
      "show"             : "current",
      "in_advance"       : 86400 //show only visits with at least 24h (= 86400 seconds) ahead of current time 
  };
  $(".horizontal-calendar-small-wrapper").bootstrapSmallCalendar(smallCalendarOptions);  
   
  $('.horizontal-calendar-big-wrapper').on("click", ".carousel-control", function() {
      $(".carousel-inner").css("overflow","hidden");
  }); 
   
  $('.horizontal-calendar-small-wrapper').on("click", ".horizontal-calendar-small-left", function(e) {
    e.preventDefault();
    var options = {
      "ajax_url"         : "process.php",
      "calendar_type"    : "small",
      "number_of_weeks"  : 4,
      "show"             : "prev",
      "booking_url"      : "make_an_appointment.php",
      "max_in_row"       : 4
    };
    var id = $(this).attr("data-calendar-id");
    $.ajax({
      type: "POST",
      dataType: "json",
      url: options['ajax_url'],
      data: "id="+id+"&calendar_type="+options['calendar_type']+"&number_of_weeks="+options['number_of_weeks']+"&booking_url="+options['booking_url']+"&show="+options['show']+"&max_in_row="+options['max_in_row'],
      success: function(json){
        if(json.success === true){
          console.log(json.content);
          $("#horizontal-calendar-small-wrapper-"+id).html(json.content); 
        }else if(json.success ===false){
          console.log("Error");
        }else{
          console.log("Error 2");
        }
      },
      error: function(json){
        console.log(json);
      }
    });
  });
  
  $('.horizontal-calendar-small-wrapper').on("click", ".horizontal-calendar-small-right", function(e) {
    e.preventDefault();
       var options = {
        "ajax_url"         : "process.php",
        "calendar_type"    : "small",
        "number_of_weeks"  : 4,
        "show"             : "next",
          "booking_url"      : "make_an_appointment.php",
          "max_in_row"       : 4
       };
       var id = $(this).attr("data-calendar-id");
    
       $.ajax({
          type: "POST",
          dataType: "json",
          url: options['ajax_url'],
              data: "id="+id+"&calendar_type="+options['calendar_type']+"&number_of_weeks="+options['number_of_weeks']+"&booking_url="+options['booking_url']+"&show="+options['show']+"&max_in_row="+options['max_in_row'],
              success: function(json){
                 
                if(json.success === true){
                   $("#horizontal-calendar-small-wrapper-"+id).html(json.content); 
                }else if(json.success ===false){
                    console.log("Error");
                }else{
                    console.log("Error 2");
                }
              },
              error: function(json){
                  console.log(json);
              }
            });
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