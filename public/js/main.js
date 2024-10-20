/* ===================================================================
 * Philosophy - Main JS
 *
 * ------------------------------------------------------------------- */

(function ($) {

    $(document).ready(function ($) {
        // Search Icon
        $(document).on('click', '.search .icon-search', function () {
            $('header .search_form').toggleClass('visible');
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