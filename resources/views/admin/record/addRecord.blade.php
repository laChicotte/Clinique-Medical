@extends('layouts.layout')  

@section('titre')  
    Ajout Dossier
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Medical Records</a></li>
                            <li class="breadcrumb-item active">Add Medical Records</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Patient Details</h4>
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
                                <th data-toggle="true">Name</th>
                                <th data-hide="phone">Number</th>
                                <th data-hide="phone">Address</th>
                                <th data-hide="phone">Phone</th>
                                <th data-hide="phone">Age</th>
                                <th data-hide="phone">Category</th>
                                <th data-hide="phone">Action</th>
                            </tr>
                            </thead>
                            
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mohamed Kaba</td>
                                    <td>J0CXH</td>
                                    <td>MATOTO</td>
                                    <td>657285544</td>
                                    <td>23 Years</td>
                                    <td>OutPatient</td>
                                    
                                    <td><a href="his_admin_add_single_patient_medical_record.php?pat_number=J0CXH" class="badge badge-success"><i class=" fas fa-file-signature"></i> Add Medical Record</a></td>
                                </tr>
                                </tbody>
                            
                                <tbody>
                                <tr>
                                    <td>2</td>
                                    <td>Lorem Ipsum</td>
                                    <td>7EW0L</td>
                                    <td>12 9001 Machakos</td>
                                    <td>0712345690</td>
                                    <td>10 Years</td>
                                    <td>OutPatient</td>
                                    
                                    <td><a href="his_admin_add_single_patient_medical_record.php?pat_number=7EW0L" class="badge badge-success"><i class=" fas fa-file-signature"></i> Add Medical Record</a></td>
                                </tr>
                                </tbody>
                            
                                <tbody>
                                <tr>
                                    <td>3</td>
                                    <td>John Doe</td>
                                    <td>RAV6C</td>
                                    <td>12 900 NYE</td>
                                    <td>08907890</td>
                                    <td>30 Years</td>
                                    <td>OutPatient</td>
                                    
                                    <td><a href="his_admin_add_single_patient_medical_record.php?pat_number=RAV6C" class="badge badge-success"><i class=" fas fa-file-signature"></i> Add Medical Record</a></td>
                                </tr>
                                </tbody>
                            
                                <tbody>
                                <tr>
                                    <td>4</td>
                                    <td>purity nduku</td>
                                    <td>1DX5Z</td>
                                    <td>machakos</td>
                                    <td>078643556</td>
                                    <td>25 Years</td>
                                    <td>InPatient</td>
                                    
                                    <td><a href="his_admin_add_single_patient_medical_record.php?pat_number=1DX5Z" class="badge badge-success"><i class=" fas fa-file-signature"></i> Add Medical Record</a></td>
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