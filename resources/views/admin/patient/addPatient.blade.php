@extends('layouts.layout')  

@section('titre')  
    Ajout Patient
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

<!-- Start Content-->
<div class="content">
    <div class="container-fluid">
                            
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin-dashboard', []) }}">Tableau de bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                            <li class="breadcrumb-item active">Ajouter un Patient</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Ajouter les informations du patients</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Remplissez tous les champs</h4>
                        <!--Add Patient Form-->
                        <form method="post" action="{{ url('patient/savePatient', []) }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Prénom</label>
                                    <input type="text" required="required" name="pat_fname" class="form-control" id="inputEmail4" placeholder="Prenom du Patient">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4" class="col-form-label">Nom</label>
                                    <input required="required" type="text" name="pat_lname" class="form-control"  id="inputPassword4" placeholder="Nom du Patient">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Date de Naissance</label>
                                    <input type="date" required="required" name="pat_dob" class="form-control" id="inputEmail4" placeholder="DD/MM/YYYY">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4" class="col-form-label">Age</label>
                                    <input required="required" type="text" name="pat_age" class="form-control"  id="inputPassword4" placeholder="Age du Patient">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputAddress" class="col-form-label">Addresse</label>
                                <input required="required" type="text" class="form-control" name="pat_addr" id="inputAddress" placeholder="Patient's Addresss">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCity" class="col-form-label">Téléphone</label>
                                    <input required="required" type="text" name="pat_phone" class="form-control" id="inputCity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCity" class="col-form-label">Maladie du Patient</label>
                                    <input required="required" type="text" name="pat_ailment" class="form-control" id="inputCity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState" class="col-form-label">Type de Patient</label>
                                    <select id="inputState" required="required" name="pat_type" class="form-control">
                                        <option value="">Choisir</option>
                                        <option value="InPatient">InPatient</option>
                                        <option value="OutPatient">OutPatient</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2" style="display:none">
                                    <label for="inputZip" class="col-form-label">Numéro Patient</label>
                                    <input type="text" name="pat_number" value="81TGV" class="form-control" id="inputZip">
                                </div>
                            </div>

                            <button type="submit" name="add_patient" class="ladda-button btn btn-primary" data-style="expand-right">Ajouter Patient</button>

                        </form>
                        <!--End Patient Form-->
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> 
</div>
<!-- container -->

@endsection  

