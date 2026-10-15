@extends('layouts.layout')  

@section('titre')  
Details chirugical
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">chirugie</a></li>
                            <li class="breadcrumb-item active">Details sur l'intervention</li>
                        </ol>
                    </div>
                    <h4 class="page-title">#{{$surgery->patient->pat_number}}</h4>
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
                                    <img src="{{asset('backend/assets/images/surg.png')}}" alt="" class="img-fluid mx-auto d-block rounded">
                                </div>
        
                            </div>
                        </div> <!-- end col -->
                        <div class="col-xl-7">
                        
                            <div class="pl-xl-3 mt-3 mt-xl-0">
                                <h2 class="mb-3">Nom du Patient : {{$surgery->patient->pat_fname.' '.$surgery->patient->pat_lname}}</h2> <hr>
                                <h3 class="align-centre ">Maladie : {{$surgery->patient->pat_ailment}}</h3> <hr>
                                <h3 class="align-centre ">Intervention : {{$surgery->su_name}}</h3> <hr>
                                <h3 class="align-centre ">Date d'éxecution : {{$surgery->created_at->format('d/m/Y')}}</h3> <hr>
                                <h2 class="align-centre">Chirurgien :  Dr. {{$surgery->employee->doc_fname.' '.$surgery->employee->doc_lname}} </h2> <hr>
                                @if ($surgery->su_status == "Undergoing")
                                    <h2 class="align-centre">Etat de l'Intervention : <span class ="btn btn-warning"> En Cours...</span> </h2> <hr>                                  
                                @else
                                    <h2 class="align-centre">Etat de l'Intervention : <span class ="btn btn-success"> Reussie</span> </h2> <hr> 
                                @endif
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

