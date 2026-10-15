@extends('layouts.layout')  

@section('titre')  
Ajouter un Compte Débiteur
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
                            <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Accounting</a></li>
                            <li class="breadcrumb-item active">Add Receivable Account</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Receivable Account Details</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Fill all fields</h4>
                        <!--Add Patient Form-->
                        <form method="post">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Account Name</label>
                                    <input type="text" required="required" name="acc_name" class="form-control" id="inputEmail4" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Account Amount(Ksh)</label>
                                    <input type="text" required="required" name="acc_amount" class="form-control" id="inputEmail4" >
                                </div>
                            </div>

                            <div class="form-group col-md-2" style="display:none">
                                                                                <label for="inputZip" class="col-form-label">Account Number</label>
                                <input type="text" name="acc_number" value="194352786" class="form-control" id="inputZip">
                            </div>

                            <div class="form-group ">
                                    <label for="inputPassword4" class="col-form-label">Account Description</label>
                                    <textarea required="required" type="text" name="acc_desc" class="form-control"  id="editor"></textarea>
                            </div>

                            <div class="form-group" style="display:none">
                                <label for="inputAddress" class="col-form-label">Account Type</label>
                                <input required="required" value="Receivable Account" type="text" class="form-control" name="acc_type" id="inputAddress">
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