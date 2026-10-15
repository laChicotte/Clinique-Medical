@extends('layouts.layout')  

@section('titre')  
Rapport Patient
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
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau Board</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Employés</a></li>
                                <li class="breadcrumb-item active">Voir Employés</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Profil de : {{$employee->doc_lname}} </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-5 col-xl-5">
                    <div class="card-box text-center">
                        <img src="{{ asset('storage/employeeProfiles/'.$employee->doc_dpic.'') }}" class="rounded-circle avatar-lg img-thumbnail"
                            alt="profile-image">

                        
                        <div class="text-centre mt-3">
                            
                            <p class="text-muted mb-2 font-13"><strong>Nom Complet :</strong> <span class="ml-2">{{$employee->doc_fname.' '.$employee->doc_lname}} </span></p>
                           <p class="text-muted mb-2 font-13"><strong>Département :</strong> <span class="ml-2">{{$employee->doc_dept}} </span></p>
                            <p class="text-muted mb-2 font-13"><strong>Numéro :</strong> <span class="ml-2">{{$employee->doc_number}}</span></p>
                            <p class="text-muted mb-2 font-13"><strong>Adresse Email :</strong> <span class="ml-2">{{$employee->doc_email}}</span></p>


                        </div>

                    </div> <!-- end card-box -->

                </div> <!-- end col-->
                <!--Vitals-->
                <div class="col-lg-7 col-xl-7">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Temperature du Corps</th>
                                    <th>Rhytme Cardiaque</th>
                                    <th>Respiratory Rate</th>
                                    <th>Pression arterielle</th>
                                    <th>Date Enregistrement</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vitals as $item)
                                    
                                <tr>
                                    <td> {{$item->vit_bodytemp}} °C</td>
                                    <td>{{$item->vit_heartpulse}}BPM</td>
                                    <td>{{$item->vit_resprate}}bpm</td>
                                    <td>{{$item->vit_bloodpress}}mmHg</td>
                                    <td>{{$item->created_at->format('d/m/Y')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                     </div>
                </div> <!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->

</div> <!-- content -->

@endsection 

