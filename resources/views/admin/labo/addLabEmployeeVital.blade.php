@extends('layouts.layout')  

@section('titre')  
Ajouter SV Employés
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

{{-- affichage de l'alert en ca de succes --}}
@if (Session::has('status'))
    <input type="hidden" name="" id="message" value="{{Session::get('status')}}">
    <script type="text/javascript">
        let message = document.getElementById("message").value;
        setTimeout(() => {
            swal("Succès", message, "success")
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
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Laboratoire</a></li>
                            <li class="breadcrumb-item active">Capture Signes Vitaux</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Enregistrer les Signes Vitaux de : {{$employee->doc_lname}}</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Remplir les champs</h4>
                        <!--Add Employee Vital Form-->
                        <form method="post" action="{{ route('save.Employee.Vital') }}">
                            @csrf
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Nom de l'employé(e)</label>
                                    <input type="text" @readonly(true) value="{{$employee->doc_fname.' '.$employee->lname}}" class="form-control" id="inputEmail4" placeholder="Patient's First Name">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputPassword4" class="col-form-label">Département</label>
                                    <input type="text" @readonly(true) value="{{$employee->doc_dept}}" class="form-control"  id="inputPassword4" placeholder="Patient`s Last Name">
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label for="inputEmail4" class="col-form-label">Numéro Employé</label>
                                    <input type="text" @readonly(true) value="{{$employee->doc_number}}" class="form-control" id="inputEmail4" placeholder="DD/MM/YYYY">
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">      
                                <div class="form-group col-md-2" style="display:none">
                                    <input type="text" required name="employee_id" value="{{$employee->id}}" class="form-control" id="inputZip">
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-3">
                                    <label for="inputEmail4" class="col-form-label">Temperature du corps °C</label>
                                    <input type="text" required="required"  name="vit_bodytemp"class="form-control" id="inputEmail4" placeholder="°C">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="inputPassword4" class="col-form-label">Pouls/Battement Cardiaque BPM</label>
                                    <input required="required" type="text"  name="vit_heartpulse"  class="form-control"  id="inputPassword4" placeholder="HeartBeats Per Minute ">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="inputPassword4" class="col-form-label">Fréquence respiratoire bpm</label>
                                    <input required="required" type="text"  name="vit_resprate"  class="form-control"  id="inputPassword4" placeholder="Breathes Per Minute">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="inputPassword4" class="col-form-label">Pression arterielle mmHg</label>
                                    <input required="required" type="text"  name="vit_bloodpress"  class="form-control"  id="inputPassword4" placeholder="mmHg">
                                </div>

                            </div>

                            <button type="submit" class="ladda-button btn btn-success" data-style="expand-right">Ajouter</button>

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