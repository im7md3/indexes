$(document).ready(function () {
  $('.bars').click(function (e) { 
    e.preventDefault();
    $('.sidebare').toggleClass('active');
  });

  $('.fa-plus').click(function (e) { 
    e.preventDefault();
    const li = $(this).next();
    $(li).slideToggle('fast');
  });
});