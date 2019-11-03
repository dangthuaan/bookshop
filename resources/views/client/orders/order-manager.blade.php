@extends('client.layouts.default-client')

@section('content')
	<!-- breadcrumbs-area-start -->
	<div class="breadcrumbs-area mb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumbs-menu">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#" class="active">cart</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- breadcrumbs-area-end -->
	<!-- entry-header-area-start -->
	<div class="entry-header-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="entry-header-title">
						<h2>Cart</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- entry-header-area-end -->
	<!-- cart-main-area-start -->
	<div class="cart-main-area mb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<form action="#">
						<div class="table-content table-responsive">
							<table>
								<thead>
									<tr>
										<th class="product-thumbnail">Book Image</th>
										<th class="product-name">Book Title</th>
										<th class="product-author">Author</th>
										<th class="product-price">Price</th>
										<th class="product-quantity">Quantity</th>
										<th class="product-subtotal">Total</th>
										<th class="product-remove">Remove</th>
									</tr>
								</thead>
								<tbody>
								@foreach ($orders as $order)
								@foreach ($order->books as $orderBook)
									<tr>
										<td class="product-thumbnail"><a href="#"><img src="{{ url($orderBook->image) }}" alt="{{$orderBook->image}}" style="width: 120px; height: 189.5px;" /></a></td>
										<td class="product-name"><a href="#">{{ $orderBook->title }}</a></td>
										<td class="product-author">{{ $orderBook->author}}</td>
										<td class="product-price"><span class="price">{{ $orderBook->price }}</span></td>
                                        <td class="product-quantity"><button class="fa fa-minus"  data-book-id="{{ $orderBook->id }}" value="{{ $orderBook->pivot->quantity }}"></button><input type="number" class="quantity" value="{{ $orderBook->pivot->quantity }}" readonly><button class="fa fa-plus" data-book-id="{{ $orderBook->id }}"></button></td>
                                        <td class="product-subtotal">{{ $orderBook->price * $orderBook->pivot->quantity  }}</td>
										<td class="product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
									</tr>
								@endforeach
								@endforeach
								</tbody>
							</table>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
					<div class="buttons-cart mb-30">
						<ul>
							<li><a href="#">Update Cart</a></li>
							<li><a href="{{ route('client.orders.index') }}">Continue Shopping</a></li>
						</ul>
					</div>
					<div class="coupon">
						<h3>Coupon</h3>
						<p>Enter your coupon code if you have one.</p>
						<form action="#">
							<input type="text" placeholder="Coupon code">
							<a href="#">Apply Coupon</a>
						</form>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="cart_totals">
						<h2>Cart Totals</h2>
						<table>
							<tbody>
								<tr class="cart-subtotal">
									<th>Subtotal</th>
									<td>
										<span class="amount">£215.00</span>
									</td>
								</tr>
								<tr class="shipping">
									<th>Shipping</th>
									<td>
										<ul id="shipping_method">
											<li>
												<input type="radio">
												<label>
													Flat Rate:
													<span class="amount">£7.00</span>
												</label>
											</li>
											<li>
												<input type="radio">
												<label> Free Shipping </label>
											</li>
										</ul>
										<a href="#">Calculate Shipping</a>
									</td>
								</tr>
								<tr class="order-total">
									<th>Total</th>
									<td>
										<strong>
											<span class="amount">£215.00</span>
										</strong>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="wc-proceed-to-checkout">
							<a href="#">Proceed to Checkout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- cart-main-area-end -->
@endsection

@section('css')
<style>
.product-quantity button {
    color: #919191;
    font-size: 15px;
    background: #e5e5e5 none repeat scroll 0 0;
    border: none;
    cursor: pointer;
    height: 40px;
    text-align: center;
    padding: 10.5px 0;
    margin: 0 5px;
    width: 30px;
    border-radius: 3px;
}

.product-quantity button:hover {
    background-color: #666;
    color: white;
}

.inactiveLink {
    visibility: hidden;

}

</style>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.fa-minus').click(function() {
            var url = '{{route('client.orders.minusQuantity')}}';
            var data = {
                'book_id': $(this).data('book-id'),
                'quantity': $(this).data('quantity')
            };
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(result) {
                    alert('Change success!');
                    location.reload();
                },
                error: function() {
                    alert('Some went wrong!');
                    location.reload();
                }
            });
        });

        $('.fa-plus').click(function() {
            var url = '{{route('client.orders.plusQuantity')}}';
            var data = {
                'book_id': $(this).data('book-id')
            };
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(result) {
                    alert('Change success!');
                    location.reload();
                },
                error: function() {
                    alert('Some went wrong!');
                    location.reload();
                }
            });
        });

        $('.product-remove').click(function() {
            var url = '{{route('client.orders.destroy')}}';
            var data = {
                'book_id': $(this).data('book-id')
            };
            $.ajax({
                url: url,
                type: 'DELETE',
                data: data,
                success: function(result) {
                    alert('Deleted!');
                    location.reload();
                },
                error: function() {
                    alert('Some went wrong!');
                    location.reload();
                }
            });
        });

        $('.fa-minus').addClass(function(){
            return parseInt($(this).val()) == 1 ? "inactiveLink" : "";
        });
    });
</script>
@endsection