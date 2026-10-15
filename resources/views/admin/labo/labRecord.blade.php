@extends('layouts.layout')  

@section('titre')  
    Dossier de Laboratoire
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Laboratory Records</a></li>
                            <li class="breadcrumb-item active">View  Records</li>
                        </ol>
                    </div>
                    <h4 class="page-title">#{{$tests->patient->pat_number}}</h4>
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
                                <h2 class="mb-3">Nom du Patient : {{$tests->patient->pat_fname.' '.$tests->patient->pat_lname}} </h2>
                                <hr>
                                <h3 class="text-danger ">Numéro : {{$tests->patient->pat_number}}</h3>
                                <hr>
                                <h3 class="text-danger ">Maladie : {{$tests->patient->pat_ailment}}</h3>
                                <hr>
                                <h3 class="text-danger ">Date Recorded : {{$tests->created_at->format('d F Y à H:i')}}</h3>
                                <hr>
                                <h2 class="align-centre">Laboratory Test</h2>
                                <hr>
                                <p class="text-muted mb-4">
                                    {!! $tests->lab_pat_tests !!}
                                </p>
                                <hr>
                                <h2 class="align-centre">Laboratory Result</h2>
                                <p class="text-muted mb-4">
                                    {!! $tests->lab_pat_results !!}
                                </p>
                                    <hr>
                                 
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

@section('javascript')  
<!-- Footable js -->
<script src="{{asset('backend/assets/libs/footable/footable.all.min.js')}}"></script>
<!-- Init js -->
<script src="{{asset('backend/assets/js/pages/foo-tables.init.js')}}"></script>
@endsection