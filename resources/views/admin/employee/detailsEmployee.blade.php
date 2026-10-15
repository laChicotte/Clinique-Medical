@extends('layouts.layout')  

@section('titre')
Details sur l'employé  
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Employees</a></li>
                            <li class="breadcrumb-item active">View Employees</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Profil de {{$employee->doc_fname.' '.$employee->doc_lname}} </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6 col-xl-6">
                <div class="card-box text-center">

                    {{-- <img src="{{ asset('storage/app/public/employeeProfiles/'.$employee->doc_dpic) }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image"> --}}
                    <img src="{{ url('storage/app/public/employeeProfiles/' . $employee->doc_dpic) }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                    
                    



                    <div class="text-centre mt-3">
                        
                        <p class="text-muted mb-2 font-13"><strong>Nom Complet de l'employé :</strong> <span class="ml-2">{{$employee->doc_fname.' '.$employee->doc_lname}}</span></p>
                       <p class="text-muted mb-2 font-13"><strong>Departement :</strong> <span class="ml-2">Depart</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Numéro :</strong> <span class="ml-2">{{$employee->doc_number}}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Adresse -Email :</strong> <span class="ml-2">{{$employee->doc_email}}</span></p>


                    </div>

                </div> <!-- end card-box -->

            </div> <!-- end col-->
            <!--Vitals-->
            <div class="col-lg-6 col-xl-6">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Body Temperature</th>
                                <th>Heart Rate/Pulse</th>
                                <th>Respiratory Rate</th>
                                <th>Blood Pressure</th>
                                <th>Date Recorded</th>
                            </tr>
                        </thead>
                     </table>
                    </div>
            </div> <!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div> <!-- content -->

@endsection  


