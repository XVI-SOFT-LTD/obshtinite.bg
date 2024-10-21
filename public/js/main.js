/* ===================================================================
 * Philosophy - Main JS
 *
 * ------------------------------------------------------------------- */

(function ($) {

    $(document).ready(function ($) {
        document.querySelector('.icon-search').addEventListener('click', function () {
            document.querySelector('.search div').classList.toggle('hidden');
        });


        // Mobile Btn
        $(document).on('click', '.mobile_button_nav', function () {
            $('.mobile_menu').toggleClass('visible');
        });
    });
})(jQuery);

function scrollToElement(elementId) {
    $('html, body').animate({
        scrollTop: $("#" + elementId).offset().top
    }, 800);
}