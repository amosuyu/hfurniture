<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>H-Furniture || @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/icon/favicon.png">

    <!-- All CSS Files -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="{{ asset('client/css') }}/bootstrap.min.css">
    <!-- Nivo-slider css -->
    <link rel="stylesheet" href="{{ asset('client/lib/css') }}/nivo-slider.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="{{ asset('client/css') }}/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="{{ asset('client/css') }}/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="{{ asset('client/css') }}/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('client/css') }}/responsive.css">
    <!-- Template color css -->
    <link href="{{ asset('client/css') }}/color/color-core.css" data-style="styles" rel="stylesheet">
    <!-- User style -->
    <link rel="stylesheet" href="{{ asset('client/css') }}/custom.css">

    <!-- Modernizr JS -->
    <script src="{{ asset('client/js') }}/vendor/modernizr-2.8.3.min.js"></script>
    @yield('css')
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Body main wrapper start -->
    <div class="wrapper">

        <!-- START HEADER AREA -->
        @include('client.header')
        <!-- END MOBILE MENU AREA -->

        <!-- START SLIDER AREA -->
        @yield('main')
        <!-- END SLIDER AREA -->

        <!-- START FOOTER AREA -->
        @include('client.footer')
        <!-- END QUICKVIEW PRODUCT -->
    </div>
    <!-- Body main wrapper end -->


    <!-- Placed JS at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <script src="{{ asset('client/js') }}/vendor/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="{{ asset('client/js') }}/bootstrap.min.js"></script>
    <!-- jquery.nivo.slider js -->
    <script src="{{ asset('client/lib/js') }}/jquery.nivo.slider.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="{{ asset('client/js') }}/plugins.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="{{ asset('client/js') }}/main.js"></script>

    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <!-- Popup jquery-->

    <link rel="shortcut icon" href="{{ asset('client/img') }}/logo/logoicon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.1.1/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.1.1/jquery-confirm.min.js"></script>
    <!-- validate Jquery-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>

    <script>
        jQuery(document).ready(function($) {
            $('.product-item').on("click", function(e) {
                $('#zoom_03').attr("src", $(this).data('value'));
            });
            var msg = '{{ Session::get('alert') }}';
            var exist = '{{ Session::has('alert') }}';
            var msg2 = '{{ Session::get('alertAuth') }}';
            var exist2 = '{{ Session::has('alertAuth') }}';
            if (exist) {
                alertify.error(msg);
            } else if (exist2) {
                alertify.success(msg2);
            }

            $('.class-change-color').each(function(i, obj) {
                if (i > 0) {
                    $(this).addClass('hidden');
                }
            });

            $('.zoom_03').on('click',  function(){
                $('.zoom_03').each(function(j, obj){
                    $(this).css('border','none');
                });
                $(this).css('border','solid  2px');
                $('#previewImg').attr('src', $(this).attr('src'));
            });

            $('#searchProduct').on('keyup',function(){
                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('search-product') }}',
                    data: {
                        'search': $value
                    },
                    success:function(data){
                        $('#previewProducts tbody').html(data);
                    }
                });
            });
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
                alertify.success('{{ trans('message.add_to_cart_ok') }}');
                $('.valueQuantity' + idItem).val(1);
                $('.modal').modal('hide');
            });
        }

        function BuyNow() {
            var id = $('#valueByColor').val();
            var quantity = $('#valueQuantity').val();
            $.ajax({
                url: '/add-to-cart/' + id + '/' + quantity,
                type: 'GET',
            }).done(function(response) {
                renderCart(response);
                alertify.success('{{ trans('message.add_to_cart_ok') }}');
                window.location = "/gio-hang"
            });
        }

        $('#change-item-cart').on('click', '.zmdi-close', function() {
            $.ajax({
                url: '/delete-item-cart/' + $(this).data('id'),
                type: 'GET',
            }).done(function(response) {
                renderCart(response);
                alertify.success('{{ trans('message.product_removed') }}');
            })
        })

        function changeColor(idColor, idItem) {
            $('#valueByColor').val(idColor);
            $('.valueByColor' + idItem).val(idColor);
            $('.class-change-color').each(function(i, obj) {
                $(this).removeClass('show');
                $(this).addClass('hidden');
            });
            $('.tabColor' + idColor).removeClass('hidden');
            $('.tabColor' + idColor).addClass('show');
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
                alertify.success('{{ trans('message.product_removed') }}');
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
                alertify.success('{{ trans('message.cart_updated') }}');
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
                alertify.success('{{ trans('message.cart_updated') }}');
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
                alertify.success('{{ trans('message.removed_all_product') }}');
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
    </script>
    @yield('jsScript')
</body>

</html>
