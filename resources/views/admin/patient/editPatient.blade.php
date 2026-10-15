@extends('layouts.layout')  

@section('titre')  
    Modification des infos
@endsection 


@section('content')  

{{-- debut d'affichage des erreurs au cas ou il y en a --}}
@php
    $sms="";
@endphp

@if (count($errors) > 0)
    @foreach ($errors->all() as $item)
        @php
            $sms=$sms.$item."\r\n";
        @endphp
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

{{-- affichage de l'alert en ca de succes --}}
@if (Session::has('status'))
    <input type="hidden" name="" id="message" value="{{ Session::get('status') }}">
    <script type="text/javascript">
        let message = document.getElementById("message").value;
        setTimeout(() => {
            swal("Succès", message, "success").then(() => {
                window.location.href = "{{ route('patients.all-patient') }}"; // Redirection vers "patients/all-patient"
            });
        }, 100);
    </script>
@endif



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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                            <li class="breadcrumb-item active">Modification Patients</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Modification des données du patient</h4>
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
                        <h4 class="header-title">Modifiez les champs qui vous interessent</h4>
                        <!--Add Patient Form-->
                        <form method="post" action="{{ url('patient/update-patient', [$patient->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Prénom</label>
                                    <input type="text" required="required" value="{{$patient->pat_fname}}" name="pat_fname" class="form-control" id="inputEmail4" placeholder="Patient's First Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4" class="col-form-label">Nom</label>
                                    <input required="required" type="text" value="{{$patient->pat_lname}}" name="pat_lname" class="form-control"  id="inputPassword4" placeholder="Patient`s Last Name">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Date de Naissance</label>
                                    <input type="date" required="required" value="{{$patient->pat_dob}}" name="pat_dob" class="form-control" id="inputEmail4" placeholder="DD/MM/YYYY">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4" class="col-form-label">Age</label>
                                    <input required="required" type="text" value="{{$patient->pat_age}}" name="pat_age" class="form-control"  id="inputPassword4" placeholder="Patient`s Age">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputAddress" class="col-form-label">Addresse</label>
                                <input required="required" type="text" value="{{$patient->pat_addr}}" class="form-control" name="pat_addr" id="inputAddress" placeholder="Patient's Addresss">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCity" class="col-form-label">Téléphone</label>
                                    <input required="required" type="text" value="{{$patient->pat_phone}}" name="pat_phone" class="form-control" id="inputCity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCity" class="col-form-label">Maladie du Patient</label>
                                    <input required="required" type="text" value="{{$patient->pat_ailment}}" name="pat_ailment" class="form-control" id="inputCity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState" class="col-form-label">Type de Patient</label>
                                    <select id="inputState" required="required" name="pat_type" class="form-control">
                                        @if ( $patient->pat_type == "OutPatient")
                                            <option value="OutPatient">{{$patient->pat_type}}</option>
                                            <option value="InPatient">InPatient</option>                                           
                                        @else
                                            <option value="InPatient">{{$patient->pat_type}}</option>
                                            <option value="OutPatient">OutPatient</option>                                                                                   
                                        @endif

                                    </select>
                                </div>
                                <div class="form-group col-md-2" style="display:none">
                                    <label for="inputZip" class="col-form-label">Numéro du Patient</label>
                                    <input type="text" name="pat_number" value="{{$patient->pat_number}}" class="form-control" id="inputZip">
                                </div>
                            </div>

                            <button type="submit" name="update_patient" class="ladda-button btn btn-success" data-style="expand-right">Modifier</button>

                        </form>
                        <!--End Patient Form-->
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
                                <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->

@endsection  

