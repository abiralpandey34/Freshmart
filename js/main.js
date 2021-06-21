

// search cart logo
$(window).scroll(function () {
  console.log($(window).scrollTop())
  if ($(window).scrollTop() > 10) {
    $('#logo-serch-cart').addClass('logo-s-c');
  }
  if ($(window).scrollTop() < 10) {
    $('#logo-serch-cart').removeClass('logo-s-c');
  }
});


//   testimonial
jQuery(".ads").owlCarousel({
    loop:true,
    margin:10,
    dots:false,
    nav:false,
    mouseDrag:false,
    autoplay:true,
    animateOut: 'fadeOut',
  responsive: {
    0: {
      items: 1
    },

    600: {
      items: 1
    },

    1024: {
      items: 1
    },

    1366: {
      items: 1
    }
  }
});
// ofer


// scrolling buttom
$(window).scroll(function(){
    if ($(window).scrollTop() > 500)
     {
     $("#top").fadeIn();
     }
     else
     {
      $("#top").fadeOut();
     
     }

 });
$("#top").click(function(){
    $("html").animate({scrollTop:0},1000);
});

$('.products').owlCarousel({
    autoplay: true,
    lazyLoad: true,
    loop: true,
    margin: 26,
     /*
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    */
    responsiveClass: true,
    autoHeight: true,
    autoplayTimeout: 10000,
    smartSpeed: 800,
    nav: true,
    dots:false,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:2
          },
          1000:{
              items:4
          }
      }
  })
 
  
jQuery('#expander').on('click', function() {
  jQuery(this).siblings().slideToggle('fast');
  // jQuery(this).find('i').toggleClass('fa-plus fa-minus');
  jQuery(this).find('i').toggleClass('');
});