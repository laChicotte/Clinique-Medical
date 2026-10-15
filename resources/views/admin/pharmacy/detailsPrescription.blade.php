@extends('layouts.layout')  

@section('titre')  
Détails de l'ordonnance
@endsection  

@section('content') 

<div class="content">

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de Bord</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Produits</a></li>
                                <li class="breadcrumb-item active">Voir ordonnance</li>
                            </ol>
                        </div>
                        <h4 class="page-title">#{{ $prescription->patient->pat_number }}</h4>
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
                                        <img src="{{asset('backend/assets/images/users/patient.png')}}" alt="" class="img-fluid mx-auto d-block rounded">
                                    </div>
            
                                </div>
                            </div> <!-- end col -->
                            <div class="col-xl-7">
                                <div class="pl-xl-3 mt-3 mt-xl-0">
                                    <h2 class="mb-3">Nom : {{ $prescription->patient->pat_fname }} {{ $prescription->patient->pat_lname }}</h2>
                                    <hr>
                                    <h3 class="text-danger">Age : {{ $prescription->patient->pat_age }} Ans</h3>
                                    <hr>
                                    <h3 class="text-danger ">Numéro Patient : {{ $prescription->patient->pat_number }}</h3>
                                    <hr>
                                    <h3 class="text-danger ">Categorie Patient: {{ $prescription->patient->pat_type }}</h3>
                                    <hr>
                                    <h3 class="text-danger ">Diagnostic : {{ $prescription->patient->pat_ailment }}</h3>
                                    <hr>
                                    <h2 class="align-centre">Prescription</h2>
                                    <hr>
                                    <p class="text-muted mb-4">
                                       {!! $prescription->pres_ins !!}
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
