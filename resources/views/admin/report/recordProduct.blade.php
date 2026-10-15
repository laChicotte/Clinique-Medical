@extends('layouts.layout')  

@section('titre')  
Dossiers des produits
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Reporting</a></li>
                            <li class="breadcrumb-item active"> Pharmaceutical Records</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Pharmaceuticals</h4>
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
                                <th data-toggle="true">Pharmaceutical Name</th>
                                <th data-hide="phone">Pharmaceutical Barcode</th>
                                <th data-hide="phone">Pharmaceutical Vendor</th>
                                <th data-hide="phone">Pharmaceutical Category</th>
                                <th data-hide="phone">Pharmaceutical Quantity</th>
                                <th data-hide="phone">Action</th>
                            </tr>
                            </thead>
                            
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Aspirin</td>
                                    <td>452760813</td>
                                    <td>Cosmos Kenya Limited</td>
                                    <td>Analgesics</td>
                                    <td>500 Cartons</td>

                                    <td><a href="his_admin_view_single_pharm.php?phar_bcode=452760813" class="badge badge-success"><i class="far fa-eye "></i> View</a></td>
                                </tr>
                                </tbody>
                            
                                <tbody>
                                <tr>
                                    <td>2</td>
                                    <td>Paracetamol</td>
                                    <td>134057629</td>
                                    <td>Dawa Limited Kenya</td>
                                    <td>Antipyretics</td>
                                    <td>500 Cartons</td>

                                    <td><a href="his_admin_view_single_pharm.php?phar_bcode=134057629" class="badge badge-success"><i class="far fa-eye "></i> View</a></td>
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
