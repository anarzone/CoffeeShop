@extends('layout.app')

@section('content')
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <form action="{{route('storeOrder')}}" method="POST">
                    @csrf
                    <div class="col-md-7">
                        <!-- Billing Details -->
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Billing address</h3>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input class="input" type="email" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="address" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="city" placeholder="City">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="country" placeholder="Country">
                            </div>
                            <div class="form-group">
                                <input class="input" type="tel" name="phone" placeholder="Telephone">
                            </div>
                        </div>
                        <!-- /Billing Details -->

                        <!-- Order notes -->
                        <div class="order-notes">
                            <textarea class="input" placeholder="Order Notes"></textarea>
                        </div>
                        <!-- /Order notes -->
                    </div>

                    <!-- Order Details -->
                    <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title">Your Order</h3>
                        </div>
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>PRODUCT</strong></div>
                                <div><strong>TOTAL</strong></div>
                            </div>
                            <div class="order-products">
                                @foreach($items as $item)
                                    <div class="order-col">
                                        <div>{{$item->product->title}}</div>
                                        <div>${{$item->product->sale_price}}</div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="order-col">
                                <div>Shiping</div>
                                <div><strong>FREE</strong></div>
                            </div>
                            <div class="order-col">
                                <div><strong>TOTAL</strong></div>
                                <div><strong class="order-total">${{$total}}</strong></div>

                            </div>
                        </div>
                        <button href="#" class="primary-btn btn-block order-submit">Place order</button>
                    </div>
                    <!-- /Order Details -->
                    <input type="hidden" name="total" value="{{$total}}">
                    <input type="hidden" name="subtotal" value="{{$total}}">
                </form>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
@endsection
