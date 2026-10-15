@extends('layouts.layout')  

@section('titre')  
Formulaire de Département
@endsection 

@section('content') 

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
                            <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Employee</a></li>
                            <li class="breadcrumb-item active">Département</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Assigner ou changer de Département pour l'employé</h4>
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
                        <!--Add Patient Form-->
                        <form method="post" action="{{ url('employees/valide-departement', [$employee->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Prénom</label>
                                    <input type="text" readonly value="{{$employee->doc_fname}}" class="form-control" id="inputEmail4" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4" class="col-form-label">Nom</label>
                                    <input type="text" readonly value="{{$employee->doc_lname}}" class="form-control"  id="inputPassword4">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputAddress" class="col-form-label">Email</label>
                                <input  type="email" readonly value="{{$employee->doc_email}}" class="form-control"  id="inputAddress">
                            </div>

                            <div class="form-group">
                                <label for="inputAddress" class="col-form-label">Numéro</label>
                                <input type="email" readonly value="{{$employee->doc_number}}" class="form-control" id="inputAddress">
                            </div>

                            <div class="form-group">
                                <label for="inputAddress" class="col-form-label">Département Actuel de l'employé </label>
                                <input type="email" readonly value="{{$employee->doc_dept}}" class="form-control" id="inputAddress">
                            </div>
                            
                            <div class="form-group">
                                    <label for="inputState" class="col-form-label">Nouveau Département</label>
                                    <select id="inputState" required="required" name="doc_dept" class="form-control">
                                        <option value="{{$employee->doc_dept}}" >Choisir</option>
                                        <option value="doctor" >Médecin</option>
                                        <option value="laboratory" >Laboratire</option>
                                        <option value="pharmacy" >Pharmacie</option>
                                        <option value="accounting" >Comptable</option>
                                        <option value="surgery" >Chirurgie</option>
                                    </select>
                            </div>                                         

                            <button type="submit" class="ladda-button btn btn-success" data-style="expand-right">Changer</button>

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
