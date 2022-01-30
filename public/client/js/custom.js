jQuery(document).ready(function($) {
    $('.product-item').on("click", function(e) {
        $('#zoom_03').attr("src", $(this).data('value'));
    });
    var msg =
        '{{ Session::get('
    alert ') }}';
    var exist = '{{ Session::has('
    alert ') }}';
    if (exist) {
        alertify.error(msg);
    }
});

function AddToCart(idItem) {
    var quantity;
    var id;
    if (idItem == null) {
        id = $('#valueByColor').val();
        quantity = $('#valueQuantity').val();
    } else {
        id = $('.valueByColor' + idItem).val();
        quantity = $('.valueQuantity' + idItem).val();
    }
    $.ajax({
        url: '/add-to-cart/' + id + '/' + quantity,
        type: 'GET',
    }).done(function(response) {
        renderCart(response);
        alertify.success('{{ trans('
            message.payment ') }}');
        $('.valueQuantity' + idItem).val(1);
        $('.modal').modal('hide');
    });
}

$('#change-item-cart').on('click', '.zmdi-close', function() {
    $.ajax({
        url: '/delete-item-cart/' + $(this).data('id'),
        type: 'GET',
    }).done(function(response) {
        renderCart(response);
        alertify.success('Đã xóa sản phẩm');
    })
})

function changeColor(idColor, idItem) {
    $('#valueByColor').val(idColor);
    $('.valueByColor' + idItem).val(idColor);
}

function renderCart(response) {
    if (response.toString().length > 100) {
        $('#change-item-cart').empty();
        $('#change-item-cart').html(response);
        $('#total-quantity-show').text($('#total-quantity-cart').val());
    } else {
        $('#change-item-cart').empty();
        $("#total-quantity-show").text('0');
    }
}

function changeQuantity(value, idItem) {
    $('.valueQuantity' + idItem).val(value);
}

function deleteItemListCart(id) {
    $.ajax({
        url: '/delete-item-list-cart/' + id,
        type: 'GET',
    }).done(function(response) {
        renderListCart(response);
        alertify.success('Đã xóa sản phẩm');
    });
}

function renderListCart(response) {
    $.ajax({
        url: '/cart',
        type: 'GET',
    }).done(function(response) {
        if (response.toString().length > 100) {
            $('#change-item-cart').empty();
            $('#change-item-cart').html(response);
            $('#total-quantity-show').text($('#total-quantity-cart').val());
        } else {
            $('#change-item-cart').empty();
            $("#total-quantity-show").text('0');
        }
    });
    $('#shopping-cart').empty();
    $('#shopping-cart').html(response);
}

function saveItemListCart(id) {
    $.ajax({
        url: '/save-item-list-cart/' + id + '/' + $('#quantity-item-' + id).val(),
        type: 'GET',
    }).done(function(response) {
        renderListCart(response);
        alertify.success('Đã cập nhật thành công');
    });
}

function useVoucher() {
    var voucher = $('#voucher-code').val();
    $.ajax({
        url: '/use-voucher/' + voucher,
        type: 'GET',
    }).done(function(response) {
        $.ajax({
            url: '/list-cart-ajax',
            type: 'GET',
        }).done(function(response) {
            $('#shopping-cart').empty();
            $('#shopping-cart').html(response);
        });
        alertify.success(response);
    });
}

function qtyFunction(id) {
    $('#quantity-item-' + id).val($('#quantity-item-' + id).val().replace(/\D/g, ''));
}

function saveAllListCart() {
    var list = [];
    $('table tbody tr td').each(function() {
        $(this).find('input').each(function() {
            var element = {
                key: $(this).data('id'),
                value: $(this).val()
            };
            list.push(element);
        });
    });
    $.ajax({
        url: '/save-all-list-cart',
        type: 'POST',
        data: {
            '_token': "{{ csrf_token() }}",
            'data': list
        }
    }).done(function(response) {
        rendCart();
        $('#shopping-cart').empty();
        $('#shopping-cart').html(response);
        alertify.success('Cập nhật tất cả thành công');
    })
}

function deleteAllListCart() {
    var list = [];
    $('table tbody tr td').each(function() {
        $(this).find('input').each(function() {
            var element = {
                key: $(this).data('id'),
                value: $(this).val()
            };
            list.push(element);
        });
    });
    $.ajax({
        url: '/delete-all-list-cart',
        type: 'POST',
        data: {
            '_token': "{{ csrf_token() }}",
            'data': list
        }
    }).done(function(response) {
        rendCart();
        $('#shopping-cart').empty();
        $('#shopping-cart').html(response);
        alertify.success('Xóa tất cả thành công');
    })
}

function rendCart() {
    $.ajax({
        url: '/cart',
        type: 'GET',
    }).done(function(response) {
        if (response.toString().length > 100) {
            $('#change-item-cart').empty();
            $('#change-item-cart').html(response);
            $('#total-quantity-show').text($('#total-quantity-cart').val());
        } else {
            $('#change-item-cart').empty();
            $("#total-quantity-show").text('0');
        }
    });
}