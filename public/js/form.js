$(function() {
    // Премахване на required атрибута от всички полета по подразбиране
    $('.language-input').prop('required', false);

    /* За момента остава в коментар - английския език не е задължителен за попълване..
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // Премахване на required атрибута от всички полета
        $('.language-input').prop('required', false);

        // Добавяне на required атрибута към полетата в активния таб
        var target = $(e.target).attr("href"); // активният таб
        $(target).find('.language-input').prop('required', true);
    }); */

    // Активиране на required атрибута за полетата в първия таб
    $('.tab-pane:first .language-input').prop('required', true);
});