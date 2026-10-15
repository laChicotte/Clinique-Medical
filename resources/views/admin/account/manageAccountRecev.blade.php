@extends('layouts.layout') 

@section('titre')  
Gérer les compte debiteurs
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Accounts</a></li>
                            <li class="breadcrumb-item active">Manage Receivable Accounts</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Manage Receivable Accounts</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="header-title"></h4>
                    <div class="mb-2">
                        <div class="row">
                            <div class="col-12 text-sm-center form-inline" >
                                <div class="form-group mr-2" style="display:none">
                                    <select id="demo-foo-filter-status" class="custom-select custom-select-sm">
                                        <option value="">Show all</option>
                                        <option value="Discharged">Discharged</option>
                                        <option value="OutPatients">OutPatients</option>
                                        <option value="InPatients">InPatients</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th data-toggle="true">Account Name</th>
                                <th data-hide="phone">Account Number</th>
                                <th data-hide="phone">Account Amount</th>
                                <th data-hide="phone">Action</th>
                            </tr>
                            </thead>
                            
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Equity Bank</td>
                                    <td>753680912</td>
                                    <td>Ksh 500000000</td>

                                    <td>
                                        <a href="his_admin_view_single_payable_account.php?acc_number=753680912" class="badge badge-success"><i class="fas fa-eye "></i> View</a>
                                        <a href="his_admin_update_single_receivable_account.php?acc_number=753680912" class="badge badge-warning"><i class="fas fa-clipboard-check "></i> Update</a>
                                        <a href="his_admin_manage_acc_receivable.php?delete_account=753680912" class="badge badge-danger"><i class="fas fa-trash-alt "></i> Delete</a>


                                    </td>
                                </tr>
                                </tbody>
                                                                        <tfoot>
                            <tr class="active">
                                <td colspan="8">
                                    <div class="text-right">
                                        <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div> <!-- end .table-responsive-->
                </div> <!-- end card-box -->
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