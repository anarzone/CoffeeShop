@extends('layout.app')

@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div id="store" class="col-md-12">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-md-4 col-xs-6">
                                <div class="product">
                                    <div class="product-img">
                                        <img src="{{$product->image}}" alt="{{$product->title}}">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-name"><a href="#">{{$product->title}}</a></h3>
                                        <h4 class="product-price">{{$product->sale_price}} <del class="product-old-price">{{$product->price}}</del></h4>
                                    </div>
                                    <div class="add-to-cart">
                                        <button class="add-to-cart-btn"
                                                data-product-id="{{$product->id}}"
                                                data-product-title="{{$product->title}}"
                                                data-product-price="{{$product->sale_price}}"
                                                data-product-image="{{$product->image}}"
                                        >
                                            <i class="fa fa-shopping-cart"></i> add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.add-to-cart-btn').on('click', function(e){
            let id = $(this).data('product-id');
            let title = $(this).data('product-title');
            let price = $(this).data('product-price');
            let image = $(this).data('product-image');

            $('.qty').text(++quantity)

            $.ajax({
                type: 'POST',
                url: '/cart/add',
                data: {product_id: id, price, quantity: 1},
                success: function(response){
                    if(response.message === 'success'){
                        console.log(response.data)
                        $('.cart-list').append(`
                                    <div class="product-widget" data-id="${response.data.id}">
                                        <div class="product-body">
                                            <h3 class="product-name"><a href="#">${title}</a></h3>
                                            <h4 class="product-price">$ ${price}</h4>
                                        </div>
                                        <button class="delete" onclick="deleteItem(${response.data.id})"><i class="fa fa-close"></i></button>
                                    </div>
                                `)
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
                        $(this).parents('div.product-widget').remove()
                    }
                }
            })
        }
    </script>
@endsection
