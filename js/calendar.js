/**
 * calendar implements bootstrap-calendar plugin 
 * 
 * @author Mariocoski
 * @email mariuszrajczakowski@gmail.com 
 * @github https://github.com/mariocoski/Bootstrap-calendar
 * Copyright (c) 2015 Mariocoski
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
$(document).ready(function(){
  
  /* run all big calendars */  
  var bigCalendarOptions = {
      "ajax_url"       : "process.php", //url for retrieving the data
      "calendar_type"  : "big", //calendar type
      "number_of_weeks": 4, //how many weeks to display
      "first_day"      : "monday", //or sunday
      "booking_url"    : "make_an_appointment.php", //booking url 
      "max_display"    : 7 //how many visits display in a day calendar column - default is 7
  };
  $(".horizontal-calendar-big-wrapper").bootstrapBigCalendar(bigCalendarOptions);  
  
  /* run all small calendars - could be implemented on mobile version of the website or both (desktop an mobile)once needed */
  var smallCalendarOptions = {
      "ajax_url"         : "process.php",//url for retrieving the data
      "calendar_type"    : "small",//calendar type
      "number_of_weeks"  : 4, //how many weeks to display
      "booking_url"      : "make_an_appointment.php", //booking url
      "max_in_row"       : 4, //how many events timestamps are displayed in the row
      "show"             : "current", //default slide
      "in_advance"       : 86400 //show only visits with at least 24h (= 86400 seconds) ahead of current time 
  };
  $(".horizontal-calendar-small-wrapper").bootstrapSmallCalendar(smallCalendarOptions);  
   
   
  //when you use the carousel do not display overflow 
  $('.horizontal-calendar-big-wrapper').on("click", ".carousel-control", function() {
      $(".carousel-inner").css("overflow","hidden");
  });
  
  //process previous slide on small calendar 
  $('.horizontal-calendar-small-wrapper').on("click", ".horizontal-calendar-small-left", function(e) {
    e.preventDefault();
    var options = {
      "ajax_url"         : "process.php", //url for retrieving the data
      "calendar_type"    : "small",//calendar type
      "number_of_weeks"  : 4,//how many weeks to display
      "show"             : "prev", //slide to show
      "booking_url"      : "make_an_appointment.php", //booking url
      "max_in_row"       : 4 //how many events timestamps are displayed in the row
    };
    var id = $(this).attr("data-calendar-id");
    $.ajax({
      type: "POST",
      dataType: "json",
      url: options['ajax_url'],
      data: "id="+id+"&calendar_type="+options['calendar_type']+"&number_of_weeks="+options['number_of_weeks']+"&booking_url="+options['booking_url']+"&show="+options['show']+"&max_in_row="+options['max_in_row'],
      success: function(json){
        if(json.success === true){
          //for debugging: console.log(json.content);
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
  
  //process next slide on small calendar 
  $('.horizontal-calendar-small-wrapper').on("click", ".horizontal-calendar-small-right", function(e) {
    e.preventDefault();
       var options = {
        "ajax_url"         : "process.php",//url for retrieving the data
        "calendar_type"    : "small",//calendar type
        "number_of_weeks"  : 4,//how many weeks to display
        "show"             : "next", //slide to show
        "booking_url"      : "make_an_appointment.php",//booking url
        "max_in_row"       : 4 //how many events timestamps are displayed in the row
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
  
  //manage carousel arrows - display only when needed (do not display previous one on first slide and do not display next one on last slide)
  $('.horizontal-calendar-big-wrapper').on('slid.bs.carousel', function () {
    var id = $(this).attr("data-calendar-id");
    if($('#carousel_inner_'+id+ ' .item:first').hasClass('active')) {
      $(this).children('.horizontal-calendar-big-left').hide();
    }else{
      $(this).children('.horizontal-calendar-big-left').show();
    }
    if($('#carousel_inner_'+id+ ' .item:last').hasClass('active')) {
      $(this).children('.horizontal-calendar-big-right').hide();
    }else{
      $(this).children('.horizontal-calendar-big-right').show();
    } 
    //set overflow to visible to allow dropdown display properly
    $(".carousel-inner").css("overflow","visible");
  });
  
 
});//end of document ready