$(function() {
  
  function toggleChangeBtn() {
    var slideIndex = $('.slide').index($('.active'));
    $('.change-btn').show();
    if (slideIndex == 0) {
      $('.prev-btn').addClass('btn-noclick');
      $('.next-btn').removeClass('btn-noclick');


    } else if (slideIndex == 1) {
      $('.prev-btn').removeClass('btn-noclick');
      $('.next-btn').removeClass('btn-noclick');
    

      // $('.prev-btn').hide();
    // 「3」の部分を、lengthメソッドを用いて書き換えてください
    } else if (slideIndex == $('.slide').length - 1) {
      $('.next-btn').addClass('btn-noclick');
      $('.prev-btn').removeClass('btn-noclick');

      // $('.next-btn').hide();
    }
  }
  
  // $('.index-btn').click(function() {
  //   $('.active').removeClass('active');
  //   var clickedIndex = $('.index-btn').index($(this));
  //   $('.slide').eq(clickedIndex).addClass('active');
  //   toggleChangeBtn();
  // });
  
  $('.change-btn').click(function() {
    var $displaySlide = $('.active');
    $displaySlide.removeClass('active');
    if ($(this).hasClass('next-btn')) {
      $displaySlide.next().addClass('active');
    } else {
      $displaySlide.prev().addClass('active');
    }
    toggleChangeBtn();
  });
});