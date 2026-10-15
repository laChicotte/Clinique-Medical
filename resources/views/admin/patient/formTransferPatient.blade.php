@extends('layouts.layout')  

@section('titre')  
Formulaire de Transfert
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
                            <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                            <li class="breadcrumb-item active">Transfert Patients</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Transférer le patient vers un établissement de référence</h4>
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
                        <!--Transfer Patient Form-->
                        <form action="{{ url('patient/save-transfer', [$patient->id]) }}" method="post">
                            @csrf
                            @method("PUT")
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4" class="col-form-label">Nom du Patient</label>
                                    <input type="text" disabled value="{{$patient->pat_fname.' '.$patient->pat_lname}}" name="t_pat_name" class="form-control" id="inputEmail4" placeholder="Patient's First Name">
                                </div>
                                
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Hôpital Refferal</label>
                                    <input type="text" required="required"  name="t_hospital" class="form-control" id="inputEmail4" placeholder="Refferal/Transfer Hospital">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4" class="col-form-label"> Date de Transfert</label>
                                    <input required="required" type="date"  name="t_date" class="form-control"  id="inputPassword4" placeholder="DD/MM/YYYY">
                                </div>
                            </div>

                            <button type="submit" name="transfer_patient" class="ladda-button btn btn-success" data-style="expand-right">Transfer Patient</button>

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
<script src="{{asset('backend/assets/libs/ladda/spin.js')}}"></script>
<!-- Init js -->
<script src="{{asset('backend/assets/libs/ladda/ladda.js')}}"></script>
@endsection 
