@extends('layouts.layout')  

@section('titre')
Details sur le Fournisseur 
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
                            <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Fournisseurs</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{$vendor->v_number}}</h4>
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
                                    <img src="{{asset('backend/assets/images/vendor.png')}}" alt="" class="img-fluid mx-auto d-block rounded">
                                </div>
        
                            </div>
                        </div> <!-- end col -->
                        <div class="col-xl-7">
                            <div class="pl-xl-3 mt-3 mt-xl-0">
                                <h2 class="mb-3">Fournisseur : {{$vendor->v_name}}</h2>
                                <hr>
                                <h3 class="text-danger">Contacts : {{$vendor->v_phone}}</h3>
                                <hr>
                                <h3 class="text-danger ">Email : {{$vendor->v_email}}</h3>
                                <hr>
                                <h3 class="text-danger ">Addresse : {{$vendor->v_addr}}</h3>
                                <hr>
                                
                                <h2 class="align-centre">Details du Fournisseur</h2>
                                <hr>
                                <p class="text-muted mb-4">
                                    {!! $vendor->v_desc !!} 
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


