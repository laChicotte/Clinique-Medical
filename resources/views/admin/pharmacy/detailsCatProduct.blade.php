@extends('layouts.layout')  

@section('titre')  
Détails de la Catégorie
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#">Pharmaceutiques</a></li>
                            <li class="breadcrumb-item active">Détails de la catégorie pharmaceutique</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Catégories pharmaceutiques</h4>
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
                                    <img src="{{ asset('backend/assets/images/pharm.webp') }}" alt="Image de la catégorie" class="img-fluid mx-auto d-block rounded">
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-xl-7">
                            <div class="pl-xl-3 mt-3 mt-xl-0">
                                <h2 class="mb-3">Catégorie : {{ $category->pharm_cat_name }}</h2>
                                <hr>
                                <h6 class="text-danger">Fournisseur : {{ $category->vendor ? $category->vendor->v_name : 'N/A' }}</h6>
                                <hr>
                                <p class="text-muted mb-4">
                                    {!! \App\Support\RichText::sanitize($category->pharm_cat_desc) !!}
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

</div> <!-- content -->

@endsection
