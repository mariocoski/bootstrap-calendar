/*
 * Jquery Plugin
 * Author: Mariocoski
 * Email: mariuszrajczakowski@gmail.com
 * 
 */

(function ( $ ) {
    $.fn.bootstrapBigCalendar = function(options) {
        var settings = {
            "ajax_url"         : "process.php",
            "calendar_type"    : "big",
            "number_of_weeks"  : 4,
            "first_day"        : "sunday", // or monday
            "booking_url"      : "make_an_appointment.php",
            "max_display"      : 7
        }; 
			
        //extending the settings by passed options
        if(options){
            $.extend(settings, options);
        }
        
        return this.each(function() {
        // Do something to each element here.
        
         var calendar_id = $(this).attr("id");
         var id = $(this).attr("data-calendar-id");
            $.ajax({
              type: "POST",
              dataType: "json",
              url: settings['ajax_url'],
              data: "id="+id+"&calendar_type="+settings['calendar_type']+"&number_of_weeks="+settings['number_of_weeks']+"&first_day="+settings['first_day']+"&booking_url="+settings['booking_url']+"&max_display="+settings['max_display'],
              success: function(json){
                if(json.success === true){
                    //console.log(json.content);
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
    
     $.fn.bootstrapSmallCalendar = function(options) {
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
                    console.log(json.content);
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