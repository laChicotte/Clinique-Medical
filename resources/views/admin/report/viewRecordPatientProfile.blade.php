@extends('layouts.layout')  

@section('titre')  
Rapport Patient
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
                            <li class="breadcrumb-item"><a href="j{{ route('dashboard')}};">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                            <li class="breadcrumb-item active">Voir Patients</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Profil de {{$patient->pat_lname}}</h4>
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
                        
                        <p class="text-muted mb-2 font-13"><strong>Nom Complet :</strong> <span class="ml-2">{{$patient->pat_fname.' '.$patient->pat_lname}} </span></p>
                        <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">{{$patient->pat_number}}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Addresse :</strong> <span class="ml-2">{{$patient->pat_addr}}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Date de naissance :</strong> <span class="ml-2">{{$patient->pat_dob}}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Âge :</strong> <span class="ml-2">{{$patient->pat_age}} Ans</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Maladie :</strong> <span class="ml-2">{{$patient->pat_ailment}}</span></p>
                        <hr>
                        <p class="text-muted mb-2 font-13"><strong>Enregisté :</strong> <span class="ml-2">Le {{$patient->created_at->format('d/m/Y à H:i')}}</span></p>
                        <hr>




                    </div>

                </div> <!-- end card-box -->

            </div> <!-- end col-->
            
            <div class="col-lg-8 col-xl-8">
                <div class="card-box">
                    <ul class="nav nav-pills navtab-bg nav-justified">
                        <li class="nav-item">
                            <a href="#aboutme" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                Prescriptions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#timeline" data-toggle="tab" aria-expanded="true" class="nav-link ">
                                Vitaux
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Dossiers Labo
                            </a>
                        </li>
                    </ul>
                    <!--Medical History-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="aboutme">
                            <ul class="list-unstyled timeline-sm">
                                @foreach ($prescriptions as $presc)                                    
                                    <li class="timeline-sm-item">
                                        <span class="timeline-sm-date">{{$presc->created_at->format('d-m-Y')}}</span>
                                        <h5 class="mt-0 mb-1">Ordonnace : {{$loop->iteration}} </h5>
                                        <p class="text-muted mt-2">
                                            {!! $presc->pres_ins !!}    
                                        </p>
                                    </li>                 
                                @endforeach
                            </ul>
                        </div> <!-- end tab-pane -->
                        <!-- end Prescription section content -->

                        <div class="tab-pane show " id="timeline">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Temperature</th>
                                            <th>Rythme Cardiaque</th>
                                            <th>Respiratory Rate</th>
                                            <th>Pression arterielle</th>
                                            <th>Enregistré le</th>
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
                        </div>
                        <!-- end vitals content-->

                        <div class="tab-pane" id="settings">
                            <ul class="list-unstyled timeline-sm">
                            @foreach ($labs as $lab)
                                <li class="timeline-sm-item">
                                        <span class="timeline-sm-date">{{$lab->created_at->format('d-m-Y')}}</span>
                                        <h3 class="mt-0 mb-1"> Examen Médical N° : {{$loop->iteration}}</h3>
                                        <hr>
                                        <h5>
                                           Examen Demandé
                                        </h5>
                                        
                                        <p class="text-muted mt-2">
                                            {!! $lab->lab_pat_tests!!}
                                        </p>
                                        <hr>
                                        <h5>
                                           Resultat de l'Examen
                                        </h5>
                                        
                                        <p class="text-muted mt-2">
                                            {!! $lab->lab_pat_results!!}
                                        </p>
                                        <hr>
                                </li>
                            @endforeach
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

