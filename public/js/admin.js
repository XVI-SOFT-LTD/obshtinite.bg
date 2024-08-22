function csrfToken() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
}

$(function() {
    /* books */
    $('#discount_percent').on('input', function() {
        var price = $('#price').val();
        var discountPercent = $(this).val();
        var discountPrice = price - (price * (discountPercent / 100));
        $('#discount_price').val(discountPrice.toFixed(2));
    });
  
    /* campaigns */
    $('.campaign-button').on('click', function() {
        var campaignId = $(this).data('campaign-id');
        var campaignType = $(this).data('campaign-type');        

        $.post('/admin/campaigns/create-campaignable', { id: campaignId, type: campaignType}, function (response) {
            // Use the response to change the content of the modal
            $('#modal_wrapper').html(response);
            $('.global-modal').modal('show');
        });
    });

    /* order statuses */
    $('#order_status').on('click', function() {

        let currentStatusId = $(this).data('current-status-id');
        let orderId = $(this).data('order-id');

        $.get('/admin/orders/ajax/showStatuses/' + orderId + '/' + currentStatusId, function (response) {
            $('#modal_wrapper').html(response);
            $('.global-modal').modal('show');
        });
    });
    
    /* toggle books in categories / authors */
    $('#toggleBooks').on('click', function() {
        $('#booksContent').fadeToggle();
    });

    /**
     * Promotions 
     * */
    $('.promotions-button').on('click', function() {
        var promotionId = $(this).data('id');
        
        $.post('/admin/promotions/add-books', {id: promotionId}, function (response) {
            // Use the response to change the content of the modal
            $('#modal_wrapper').html(response);
            $('.global-modal').modal('show');
        });
    });

    /* autocomplete books */
    $('body').on('input', '#search_book', function() {
        let search = $(this).val();
        if (search.length > 2) {
            csrfToken();
            $.get('/admin/books/ajax/search/' + search, function (response) {
                $('#search_results_wrapper').html(response);
            });
        } else {
            $('#search_results_wrapper').html('');
        }
    });
});

function deleteBookFromPromotion(promotionId, bookId) {
    
    if (confirm('Сигурни ли сте, че искате да изтриете тази книга от промоцията?')) {        
        csrfToken();
        $.post('/admin/promotions/remove-book', {promotion_id: promotionId, book_id: bookId}, function () {
            location.reload();
        });
    }
}