$('.mobile-menu-container').on('click', function () {
    $(this).children('.mobile-menu-icon').toggleClass('open');
    $('#side-nav').fadeToggle("slow");
    $('#profile-container-mobile').toggleClass("hidden");
    $('.overlay').toggleClass("visible");

});
