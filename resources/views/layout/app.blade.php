<!DOCTYPE html>
<html lang="en-US">
    @include('layout.partials.header')
    <body>
        <header>
            <!-- MAIN HEADER -->
            <div id="header">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <!-- LOGO -->
                        <div class="col-md-9">
                            <div class="header-logo">
                                <a href="/" class="logo" style="
                                    font-size: 30px;
                                    color: white;
                                ">
                                    Coffee Shop
                                </a>
                            </div>
                        </div>
                        <!-- /LOGO -->

                        <!-- ACCOUNT -->
                        <div class="col-md-3 clearfix">
                            <div class="header-ctn">
                                <!-- Cart -->
                                <div class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>Your Cart</span>
                                        <div class="qty">0</div>
                                    </a>
                                    <div class="cart-dropdown">
                                        <div class="cart-list">

                                        </div>
                                        <div class="cart-btns">
                                            <a href="{{route('checkout')}}">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Cart -->

                            </div>
                        </div>
                        <!-- /ACCOUNT -->
                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </div>
            <!-- /MAIN HEADER -->
        </header>
        @yield('content')

        @include('layout.partials.footer')

        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/slick.min.js')}}"></script>
        <script src="{{asset('js/nouislider.min.js')}}"></script>
        <script src="{{asset('js/jquery.zoom.min.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            let quantity = 0;

            $(document).ready(function () {
                $.ajax({
                    type: 'GET',
                    url: '/cart',
                    success: function (response) {
                        if(response.message === 'success'){
                            $.each(response.data.items, function (key, val) {
                                $('.cart-list').append(`
                                    <div class="product-widget" data-id="${val.id}">
                                        <div class="product-body">
                                            <h3 class="product-name"><a href="#">${val.product.title}</a></h3>
                                            <h4 class="product-price">$ ${val.product.sale_price}</h4>
                                        </div>
                                        <button class="delete" onclick="deleteItem(${val.id})"><i class="fa fa-close"></i></button>
                                    </div>
                                `)
                            })
                            quantity = response.data.items.length;
                            $('.qty').text(quantity)

                        }
                    }
                })
            })

            function deleteItem(id){
                $('.product-widget[data-id="'+id+'"]').remove();
                $.ajax({
                    type: 'DELETE',
                    url: 'cart/'+id+'/delete',
                    success: function (response) {
                        if(response.message === 'success'){
                            $('.qty').text(--quantity)
                            $(this).parents('div.product-widget').remove()
                        }
                    }
                })
            }
        </script>

        @yield('js')
    </body>
</html>
