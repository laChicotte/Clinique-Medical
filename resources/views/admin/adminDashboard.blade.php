@extends('layouts.layout')


@section('titre')
    Tableau de Bord
@endsection

@section('content')
<!-- Start Content-->
<div class="content">
    <div class="container-fluid">
                            
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">                
                    <h4 class="page-title">Gestion de l'Hopital Tableau de Bord</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
        

        <div class="row">
            <!--Start OutPatients-->
            <div class="col-md-6 col-xl-4">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                <i class="fab fa-accessible-icon  font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$out}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Patients Externes</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
            <!--End Out Patients-->


            <!--Start InPatients-->
            <div class="col-md-6 col-xl-4">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                <i class="mdi mdi-hotel   font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$in}} </span></h3>
                                <p class="text-muted mb-1 text-truncate">Patients Internes</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
            <!--End InPatients-->

            <!--Start Employees-->
            <div class="col-md-6 col-xl-4">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                <i class="mdi mdi-doctor font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup"> {{$employees->count()}} </span></h3>
                                <p class="text-muted mb-1 text-truncate">Employées de l'Hopital</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
            <!--End Employees-->
        
        </div>

        <div class="row">

        <!--Start Vendors-->
            <div class="col-md-6 col-xl-4">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                <i class="fas fa-user-tag font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$vendors}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Fournisseurs</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col--> 
            <!--End Vendors-->  

            <!--Start Corporation Assets-->
            <div class="col-md-6 col-xl-4">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                <i class="mdi mdi-flask font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$countLab}} </span></h3>
                                <p class="text-muted mb-1 text-truncate">Examens en cours</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
            <!--End Corporation Assets-->

            <!--Start Pharmaceuticals-->
            <div class="col-md-6 col-xl-4">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                <i class="mdi mdi-pill font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$products}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Médicaments</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
            <!--End Pharmaceuticals-->

        </div>
        
        
        @if(Auth::user()->name == "admin")
        <!--Recently Employed Employees-->
        <div class="row">
            <div class="col-xl-12">
                <div class="card-box">
                    <h4 class="header-title mb-3">Mes Employées</h4>

                    <div class="table-responsive">
                        <table class="table table-borderless table-hover table-centered m-0">

                            <thead class="thead-light">
                                <tr>
                                    <th colspan="2">Photo de profil</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Departement</th>
                                    <th>Action</th>
                                </tr> 
                            </thead>
                            
                            @foreach ($employees as $e)
                            <tbody>
                                <tr>
                                    <td style="width: 36px;">
                                        <img src="{{ asset('backend/doc/assets/images/users/index.jpeg') }}" alt="img" title="contact-img" class="rounded-circle avatar-sm" />
                                    </td>
                                    <td></td>
                                    <td>{{$e->doc_fname.' '.$e->doc_lname}}</td>
                                    <td>{{$e->doc_email}}</td>                                                    
                                    <td>{{$e->doc_dept}}</td>
                                    <td><a href="{{ url('employees/details-employee', [$e->id]) }}" class="badge badge-success"><i class="mdi mdi-eye"></i> View</a></td>
                                </tr>
                            </tbody>
                            @endforeach
                             
                            
                                                                  
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->                                                                                                                                                                                                                                         
        </div>
        <!-- end row -->
        @endif
    </div> 
</div>
<!-- container -->
@endsection
