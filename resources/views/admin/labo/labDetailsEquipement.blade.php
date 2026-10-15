@extends('layouts.layout')  

@section('titre')  
    Equiment Details
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
                            <li class="breadcrumb-item"><a href="*{{ route('dashboard') }}">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Equipements</a></li>
                            <li class="breadcrumb-item active">Details Equipement</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Details de l'Equipment <strong>#{{$equipement->eqp_code}}</strong></h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-xl-5">

                        </div> <!-- end col -->
                        <div class="col-xl-7">
                            <div class="pl-xl-3 mt-3 mt-xl-0">
                                <h2 class="mb-3">Nom de l'Equipement : {{$equipement->eqp_name}}</h2>
                                <hr>
                                <h4 class="text-danger">Fournisseur: {{$equipement->vendor->v_name}}</h4>
                                <hr>
                                <h4 class="text-danger">Code barre: {{$equipement->eqp_code}}</h4>
                                <hr>
                                <h4 class="text-danger">Quantité Disponible : {{$equipement->eqp_qty}}</h4>
                                <hr>
                                <h4 class="text-danger">Status : {{$equipement->eqp_status}}</h4>
                                <hr>
                                <h4 class="text-danger">Description de L'équipement</h4>
                                <p class="text-muted mb-4">
                                    <p>{!! $equipement->eqp_desc !!}</p>                                                    
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

@section('javascript')

    <!--Load CK EDITOR Javascript-->
    <div class="rightbar-overlay"></div>
    <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
    <script type="text/javascript">
    CKEDITOR.replace('editor')
    </script>
    <script type="text/javascript">
    CKEDITOR.replace('editor1')
    </script>
    <!-- Loading buttons js -->
    <script src="{{asset('backend/assets/libs/ladda/spin.js')}}"></script>
    <script src="{{asset('backend/assets/libs/ladda/ladda.js')}}"></script>

    <!-- Buttons init js-->
    <script src="{{asset('backend/assets/js/pages/loading-btn.init.js')}}"></script>
@endsection 
<!-- Right bar overlay-->
