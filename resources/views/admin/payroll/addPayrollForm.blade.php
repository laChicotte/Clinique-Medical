@extends('layouts.layout')  

@section('titre')
Formulaire de Paie
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
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Payrolls</a></li>
                            <li class="breadcrumb-item active">Add Payroll Record</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Ajouter une paie</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Remplir tous les champs</h4>
                        <!--Add Fiche paie Form-->
                        <form method="post" action="{{ route('payroll.store') }}">
                            @csrf
                            <div class="form-row">
                                <!-- Informations sur l'employé -->
                                <div class="form-group col-md-4">
                                    <label class="col-form-label">Nom de l'Employé(e)</label>
                                    <input type="text" readonly value="{{$employee->doc_fname.' '.$employee->doc_lname}}" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-form-label">Email</label>
                                    <input type="text" readonly value="{{$employee->doc_email}}" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-form-label">Numéro</label>
                                    <input type="text" readonly value="{{$employee->doc_number}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <!-- Champs pour la saisie de la fiche de paie -->
                                <div class="form-group col-md-4">
                                    <label class="col-form-label">Salaire Brut (GNF)</label>
                                    <input type="number" required="required" name="pay_brut_salary" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-form-label">Mois Concerné</label>
                                    <select required="required" name="pay_month" class="form-control">
                                        <option value="">Sélectionner un mois</option>
                                        <option value="1">Janvier</option>
                                        <option value="2">Février</option>
                                        <option value="3">Mars</option>
                                        <option value="4">Avril</option>
                                        <option value="5">Mai</option>
                                        <option value="6">Juin</option>
                                        <option value="7">Juillet</option>
                                        <option value="8">Août</option>
                                        <option value="9">Septembre</option>
                                        <option value="10">Octobre</option>
                                        <option value="11">Novembre</option>
                                        <option value="12">Décembre</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-form-label">Année</label>
                                    <select required="required" name="pay_year" class="form-control">
                                        <option value="">Sélectionner une année</option>
                                        @for($i = date('Y'); $i >= date('Y')  - 10; $i--)
                                        <option value={{$i}}>{{$i}} </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" required value="{{$employee->id}}" name="employee_id">
                            <button type="submit" class="ladda-button btn btn-primary" data-style="expand-right">Ajouter la Fiche de Paie</button>
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
