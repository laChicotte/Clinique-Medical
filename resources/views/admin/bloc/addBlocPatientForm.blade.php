@extends('layouts.layout')  

@section('titre') 
Formulaire Admission au Bloc 
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
                    <h4 class="page-title">Add Surgery Patient Details</h4>
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
                        <h4 class="header-title">Remplir tous les champs</h4>
                        <!--Add Patient Form-->
                        <form method="post" action="{{ route('surgeries.store') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputName" class="col-form-label">Nom complet</label>
                                    <input type="text" readonly value="{{$patient->pat_fname.' '.$patient->pat_lname}}" class="form-control" id="inputName">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputDisease" class="col-form-label">Maladie</label>
                                    <input readonly type="text" value="{{$patient->pat_ailment}}" class="form-control" id="inputDisease">
                                </div>
                            </div>
                        
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPatientNumber" class="col-form-label">Numéro Patient</label>
                                    <input readonly type="text" value="{{$patient->pat_number}}" class="form-control" id="inputPatientNumber">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputSurgeon" class="col-form-label">Chirurgien</label>
                                    <select id="inputSurgeon" required name="employee_id" class="form-control">
                                        <option value="">Sélectionner un chirurgien</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->doc_fname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label for="inputSurgeryName" class="col-form-label">Nom de l'opération</label>
                                <input type="text" name="su_name" class="form-control" id="inputSurgeryName" placeholder="Saisir de quelle opération il s'agit">
                            </div>
                        
                            <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        
                            <button type="submit" class="btn btn-success">Admission</button>
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


@section('javascript')  
<!-- Footable js -->
<script src="{{asset('backend/assets/libs/footable/footable.all.min.js')}}"></script>
<!-- Init js -->
<script src="{{asset('backend/assets/js/pages/foo-tables.init.js')}}"></script>
@endsection 
