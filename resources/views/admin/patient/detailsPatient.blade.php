@extends('layouts.layout')  

@section('titre') 
Details du patient
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                            <li class="breadcrumb-item active">View Patients</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Profil de {{$patient->pat_fname." ".$patient->pat_lname}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card-box text-center">
                    <img src="{{asset('backend/assets/images/users/patient.png')}}" class="rounded-circle avatar-lg img-thumbnail"
                        alt="profile-image">

                    
                    <div class="text-left mt-3">
                        
                        <p class="text-muted mb-2 font-13"><strong>Nom Complet :</strong> <span class="ml-2">{{$patient->pat_fname." ".$patient->pat_lname}}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Téléphone :</strong><span class="ml-2">{{$patient->pat_phone}}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Addresse :</strong> <span class="ml-2">{{$patient->pat_addr}}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Date de Naissance :</strong> <span class="ml-2">{{$patient->pat_dob}}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Age :</strong> <span class="ml-2">{{$patient->pat_age}} Ans</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Ailment :</strong> <span class="ml-2">{{$patient->pat_ailement}}</span></p>
                        <hr>
                        <p class="text-muted mb-2 font-13"><strong>Date d'enregistrement :</strong> <span class="ml-2"> Le {{$patient->created_at->format('d F Y H:i')}}</span></p>
                        <hr>
                    </div>

                </div> <!-- end card-box -->

            </div> <!-- end col-->
            
            <div class="col-lg-8 col-xl-8">
                <div class="card-box">
                    <ul class="nav nav-pills navtab-bg nav-justified">
                        <li class="nav-item">
                            <a href="#aboutme" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                Prescription
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#timeline" data-toggle="tab" aria-expanded="true" class="nav-link ">
                                 Vitals
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Lab Records
                            </a>
                        </li>
                    </ul>
                    <!--Medical History-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="aboutme">
                            <ul class="list-unstyled timeline-sm">
                                <li class="timeline-sm-item">
                                    <span class="timeline-sm-date">2020-01-11</span>
                                    <h5 class="mt-0 mb-1">Malaria</h5>
                                    <p class="text-muted mt-2">
                                        <ul>
                                            <li>Combination of atovaquone and proguanil (Malarone)</li>
                                            <li>Quinine sulfate (Qualaquin) with doxycycline (Vibramycin, Monodox, others)</li>
                                            <li>Mefloquine.</li><li>Primaquine phosphate.</li>
                                        </ul>                                                        
                                    </p>
                                </li>
                            </ul>  
                        </div> <!-- end tab-pane -->
                        <!-- end Prescription section content -->

                        <div class="tab-pane show " id="timeline">
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
                                    <tbody>
                                        <tr>
                                            <td>37°C</td>
                                            <td>87BPM</td>
                                            <td>20-27bpm</td>
                                            <td>120mmHg</td>
                                            <td>2020-01-13</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end vitals content-->

                        <div class="tab-pane" id="settings">
                            <ul class="list-unstyled timeline-sm">
                                                                                    <li class="timeline-sm-item">
                                        <span class="timeline-sm-date">2020-01-13</span>
                                        <h3 class="mt-0 mb-1">Malaria</h3>
                                        <hr>
                                        <h5>
                                           Laboratory  Tests
                                        </h5>
                                        
                                        <p class="text-muted mt-2">
                                            <p><strong>Pain areas: </strong>in the abdomen or muscles</p><p><strong>Whole body: </strong>chills, fatigue, fever, night sweats, shivering, or sweating</p><p><strong>Gastrointestinal: </strong>diarrhoea, nausea, or vomiting</p><p><strong>Also common: </strong>fast heart rate, headache, mental confusion, or pallor</p>                                                        </p>
                                        <hr>
                                        <h5>
                                           Laboratory Results
                                        </h5>
                                        
                                        <p class="text-muted mt-2">
                                            <p><strong>Pain areas: </strong>in the abdomen or muscles -Tested Positive</p><p><strong>Whole body: </strong>chills, fatigue, fever, night sweats, shivering, or sweating - Tested Positive</p><p><strong>Gastrointestinal: </strong>diarrhoea, nausea, or vomiting - Tested Positive</p><p>&nbsp;</p>                                                        </p>
                                        <hr>

                                    </li>
                            </ul>
                        </div>
                        </div>
                        <!-- end lab records content-->

                    </div> <!-- end tab-content -->
                </div> <!-- end card-box-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div> <!-- content -->
@endsection