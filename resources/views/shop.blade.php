@extends('layouts.app')

@section('content')

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Fresh and Organic</p>
                    <h1>
                        @if($currentCategory)
                            {{ $currentCategory->name }}
                        @else
                            Shop
                        @endif
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->

<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">

            @forelse($products as $product)
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="#">
                                <img src="{{ asset('storage/'.$product->image) }}"
                                     alt="{{ $product->image_alt ?? $product->name }}">
                            </a>
                        </div>

                        <h3>{{ $product->name }}</h3>

                        <p class="product-price">
                            {{ $product->price }} $
                        </p>

                        <a href="#" class="cart-btn">
                            <i class="fas fa-shopping-cart"></i>
                            Add to Cart
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>لا توجد منتجات لهذا القسم</p>
                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        <div class="row">
            <div class="col-12 text-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
