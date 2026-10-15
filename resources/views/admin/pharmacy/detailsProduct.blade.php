@extends('layouts.layout')  

@section('titre')  
Détails du produit
@endsection  

@section('content') 

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pharmaceuticals</a></li>
                            <li class="breadcrumb-item active">View Pharmaceuticals</li>
                        </ol>
                    </div>
                    <h4 class="page-title">#{{ $product->phar_bcode }} - {{ $product->phar_name }}</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-xl-5">

                            <div class="tab-content pt-0">

                                <div class="tab-pane active show" id="product-1-item">
                                    <img src="{{asset('backend/assets/images/pharm.webp')}}" alt="" class="img-fluid mx-auto d-block rounded">
                                </div>
        
                            </div>
                        </div> <!-- end col -->
                        <div class="col-xl-7">
                            <div class="pl-xl-3 mt-3 mt-xl-0">
                                <h2 class="mb-3">Pharmaceutical Name : {{ $product->phar_name }}</h2>
                                <hr>
                                <h4 class="text-danger">Pharmaceutical Vendor : {{$product->category->vendor->v_name}}</h4>
                                <hr>
                                <h4 class="text-danger">Pharmaceutical Quantity : {{ $product->phar_qty }} Cartons</h4>
                                <hr>
                                <h4 class="text-danger">Pharmaceutical Description</h4>

                                <p class="text-muted mb-4">
                                    {!! \App\Support\RichText::sanitize($product->phar_desc) !!}
                                </p>
                               
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->
        
    </div> <!-- container -->

@endsection
