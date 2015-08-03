/**
 * JQuery-Bootstrap Calendar Plugin 
 * 
 * @author Mariocoski
 * @email mariuszrajczakowski@gmail.com 
 * @github https://github.com/mariocoski/Bootstrap-calendar
 * Copyright (c) 2015 Mariocoski
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

(function ( $ ) {
  //big calendar  
  $.fn.bootstrapBigCalendar = function(options) {
    //default settings
    var settings = {
      "ajax_url"       : "process.php", //url for retrieving the data
      "calendar_type"  : "big", //calendar type
      "number_of_weeks": 4, //how many weeks to display
      "first_day"      : "monday", //or sunday
      "booking_url"    : "make_an_appointment.php", //booking url 
      "max_display"    : 7 //how many visits display in a day calendar column - default is 7
    }; 
    //extending the settings by passed options
    if(options){
      $.extend(settings, options);
    }
    //affect each calendar from certain class
    return this.each(function() {
      //get calendar_id
      var calendar_id = $(this).attr("id");
      //get id
      var id = $(this).attr("data-calendar-id");
        $.ajax({
          type: "POST",
          dataType: "json",
          url: settings['ajax_url'],
          data: "id="+id+"&calendar_type="+settings['calendar_type']+"&number_of_weeks="+settings['number_of_weeks']+"&first_day="+settings['first_day']+"&booking_url="+settings['booking_url']+"&max_display="+settings['max_display'],
          success: function(json){
            if(json.success === true){
              //for debugging: console.log(json.content);
              $("#"+calendar_id).html(json.content); 
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
  };
  
  //small calendar  
  $.fn.bootstrapSmallCalendar = function(options) {
    //default settings
    var settings = {
      "ajax_url"         : "process.php",
      "calendar_type"    : "small",
      "number_of_weeks"  : 4,
      "booking_url"      : "make_an_appointment.php",
      "max_in_row"       : 4,
      "show"             : "current",
      "in_advance"       : 86400 //show only visits with at least 24h (= 86400 seconds) ahead of current time 
    };
    //extending the settings by passed options
    if(options){
      $.extend(settings, options);
    }
    //affect each calendar from certain class
    return this.each(function() {
      // Do something to each element here.
      var calendar_id = $(this).attr("id");
      var id = $(this).attr("data-calendar-id");
        $.ajax({
          type: "POST",
          dataType: "json",
          url: settings['ajax_url'],
          data: "id="+id+"&calendar_type="+settings['calendar_type']+"&number_of_weeks="+settings['number_of_weeks']+"&booking_url="+settings['booking_url']+"&max_in_row="+settings['max_in_row']+"&show="+settings['show']+"&in_advance="+settings['in_advance'],
          success: function(json){
            if(json.success === true){
              //for debugging: console.log(json.content);
              $("#"+calendar_id).html(json.content); 
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
  };
}( jQuery ));