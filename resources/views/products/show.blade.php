@extends('layouts.app')

@section('content')
<div class="row justify-content-sm-center">
	<div class="col-xs-12 col-sm-10 col-md-7 col-lg-6">
		<div class="card">
			<header class="padding text-center bg-primary">
			</header>
			<div class="row card-body padding">
				<h1 class="col-xs-12 card-title">
					{{$product->title}}
				</h1>
				<div class="col-xs-12 col-md-6">
					<h4 class="card-subtitle">{{$product->price}}</h4>
					<p class="card-text">{{$product->description}}</p>
				</div>

				<div class="col-xs-12 col-md-6">
					@if($product->extension)
						<img src="{{url("/productos/images/$product->id.$product->extension")}}" class="product-avatar">
					@endif
				</div>

				<div class="card-actions">
				<add-product-btn :product='{!! json_encode($product) !!}'></add-product-btn>
					@include("products.delete")
				</div>
			</div>


		</div>
	</div>
</div>
@endsection