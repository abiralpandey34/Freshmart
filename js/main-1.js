

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
    lazyLoad: false,
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
  $('.productsp').owlCarousel({
    autoplay: true,
    lazyLoad: false,
    loop: true,
    margin: 26,
     /*
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    */
    responsiveClass: true,
    autoHeight: true,
    autoplayTimeout: 10700,
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
  });
  
jQuery('#expander').on('click', function() {
  jQuery(this).siblings().slideToggle('fast');
  // jQuery(this).find('i').toggleClass('fa-plus fa-minus');
  jQuery(this).find('i').toggleClass('');
});

// redmore
$('.moreless-button').click(function() {
  $('.moretext').slideToggle();
  if ($('.moreless-button').text() == "Read more") {
    $(this).text("Read less")
  } else {
    $(this).text("Read more")
  }
});
$('.moreless-buttonn').click(function() {
  $('.moretextt').slideToggle();
  if ($('.moreless-buttonn').text() == "Read more") {
    $(this).text("Read less")
  } else {
    $(this).text("Read more")
  }
});
$('.moreless-buttonnn').click(function() {
  $('.moretexttt').slideToggle();
  if ($('.moreless-buttonnn').text() == "Read more") {
    $(this).text("Read less")
  } else {
    $(this).text("Read more")
  }
});
$('.hero-img').owlCarousel({
  autoplay: true,
  lazyLoad: false,
  loop: true,
  margin: 0,
  animateOut: 'fadeOut',
  animateIn: 'fadeIn',
  responsiveClass: true,
  autoHeight: true,
  autoplayTimeout: 3000,
  smartSpeed: 800,
  nav: false,
  dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});

// sale timing
(function () {
  const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;
  let sale = "Jul 30, 2021 00:00:00",
      countDown = new Date(sale).getTime(),
      x = setInterval(function() {    
        let now = new Date().getTime(),
            distance = countDown - now;
        document.getElementById("days").innerText = Math.floor(distance / (-day)),
          document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
          document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
          document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);
        //do something later when date is reached
        if (distance < 0) {
          let headline = document.getElementById("headline"),
              countdown = document.getElementById("countdown"),
              content = document.getElementById("content");
          headline.innerText = "It's my sale!";
          countdown.style.display = "none";
          content.style.display = "block";
          clearInterval(x);
        }
        //seconds
      }, 0)
  }());
  $('#testimonial-slider').owlCarousel({
    autoplay: true,
    lazyLoad: false,
    loop: true,
    margin: 40,
    // animateOut: 'fadeOut',
    // animateIn: 'fadeIn',
    responsiveClass: true,
    autoHeight: true,
    autoplayTimeout: 8000,
    smartSpeed: 800,
    nav: false,
    dots:true,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:2
          },
          1000:{
              items:2
          }
      }
  })
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
