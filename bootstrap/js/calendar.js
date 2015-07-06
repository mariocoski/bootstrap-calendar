/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    
  $(".carousel-control").click(function(){
    //set overflow to hidden to not display the slides oveflow  
      $(".carousel-inner").css("overflow","hidden");
  });  
    
  $('.horizontal-calendar-big-wrapper').on('slid.bs.carousel', function () {
     var id = $(this).attr("id");
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