@extends('layouts.layout') 

@section('titre')  
Ajouter un compte payable
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
                            <li class="breadcrumb-item"><a href="{{ url('/', []) }}">Tableau de bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Comptabilité</a></li>
                            <li class="breadcrumb-item active">Ajouter un débiteur</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Payable Account Details</h4>
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
                        <!--Add Patient Form-->
                        <form method="post">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Nom du Compte</label>
                                    <input type="text" required="required" name="acc_name" class="form-control" id="inputEmail4" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Montant à débuter (GNF)</label>
                                    <input type="text" required="required" name="acc_amount" class="form-control" id="inputEmail4" >
                                </div>
                            </div>

                            <div class="form-group col-md-2" style="display:none">
                                <label for="inputZip" class="col-form-label">Numéro de Compte</label>
                                <input type="text" name="acc_number" value="925176408" class="form-control" id="inputZip">
                            </div>

                            <div class="form-group ">
                                    <label for="inputPassword4" class="col-form-label">Description du Compte</label>
                                    <textarea required="required" type="text" name="acc_desc" class="form-control"  id="editor"></textarea>
                            </div>

                            <div class="form-group" style="display:none">
                                <label for="inputAddress" class="col-form-label">Type de Compte</label>
                                <input required="required" value="Payable Account" type="text" class="form-control" name="acc_type" id="inputAddress">
                            </div>

                            <button type="submit" name="add_acc" class="ladda-button btn btn-success" data-style="expand-right">Add Account</button>

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
