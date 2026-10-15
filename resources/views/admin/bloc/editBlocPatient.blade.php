@extends('layouts.layout')  

@section('titre') 
Editer Bloc Form 
@endsection  


@section('content')  

{{-- debut d'affichage des erreurs au cas ou il y en a --}}
@php $sms=""; @endphp

@if (count($errors) > 0)
    @foreach ($errors->all() as $item)
        @php $sms=$sms.$item."\r\n"; @endphp
    @endforeach
    
    <input type="hidden" name="" id="message" value="{{$sms}}">
    <script type="text/javascript">
        let message = document.getElementById("message").value;
        setTimeout(() => {
            swal("Erreur", message, "error")
        }, 100);
    </script>
@endif
{{-- fin d'affichage des erreurs au cas ou il y en a --}}

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Surgery | Theatre</a></li>
                            <li class="breadcrumb-item active">Add Patient</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Mis à jour des infos</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
        <!-- Form row -->
        <!--LETS GET DETAILS OF SINGLE PATIENT GIVEN THEIR ID-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Remplir les champs disponibles</h4>
                        <!--update Form-->
                        <form method="post" action="{{ route('surgery.update', ['id'=>$surgery->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputName" class="col-form-label">Nom complet</label>
                                    <input type="text" readonly value="{{$surgery->patient->pat_fname.' '.$surgery->patient->pat_lname}}" class="form-control" id="inputName">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputDisease" class="col-form-label">Maladie</label>
                                    <input readonly type="text" value="{{$surgery->patient->pat_ailment}}" class="form-control" id="inputDisease">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPatientNumber" class="col-form-label">Numéro Patient</label>
                                    <input readonly type="text" value="{{$surgery->patient->pat_number}}" class="form-control" id="inputPatientNumber">
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputSurgeon" class="col-form-label">Chirurgien</label>
                                    <input readonly type="text" value="Dr. {{$surgery->employee->doc_fname.' '.$surgery->employee->doc_lname}}" class="form-control" id="inputSurgeon">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputSurgeryName" class="col-form-label">Nom de l'opération</label>
                                    <input type="text" value="{{$surgery->su_name}}" name="su_name" class="form-control" id="inputSurgeryName">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputSurgeryStatus" class="col-form-label">État de l'intervention</label>
                                    <select id="inputSurgeryStatus" required name="su_status" class="form-control">
                                        <option value="Undergoing" {{ $surgery->su_status == "Undergoing" ? 'selected' : '' }}>En cours</option>
                                        <option value="Successful" {{ $surgery->su_status == "Successful" ? 'selected' : '' }}>Réussie</option>
                                    </select>
                                </div>
                            </div>
                        
                            <button type="submit" class="btn btn-warning">Modifier</button>
                        </form>
                                                
                        <!--End update Form-->
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
                                <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->

@endsection  


@section('javascript')  
<!-- Footable js -->
<script src="{{asset('backend/assets/libs/footable/footable.all.min.js')}}"></script>
<!-- Init js -->
<script src="{{asset('backend/assets/js/pages/foo-tables.init.js')}}"></script>
@endsection 
