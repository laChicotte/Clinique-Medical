@extends('layouts.layout')  

@section('titre')  
Dossiers des employés
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
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Reporting</a></li>
                            <li class="breadcrumb-item active">Voir Employés</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Details sur les Employés</h4>
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
                                <th data-toggle="true">Employee Name</th>
                                <th data-hide="phone">Employee Number</th>
                                <th data-hide="phone">Employee Email</th>
                                <th data-hide="phone">Employee Department</th>
                                <th data-hide="phone">Action</th>
                            </tr>
                            </thead>
                            
                            @foreach ($employees as $employee)                                
                            <tbody>
                                <tr>
                                    <td>{{$loop->iteration}} </td>
                                    <td>{{$employee->doc_fname.' '.$employee->doc_lname}} </td>
                                    <td>{{$employee->doc_number}}</td>
                                    <td>{{$employee->doc_email}}</td>       
                                    <td>{{$employee->doc_dept}}</td> 
                                                                                                           
                                    <td><a href="{{ route('record.employee.detail', ['id'=>$employee->id]) }}" class="badge badge-success"><i class="mdi mdi-eye"></i> View</a></td>
                                </tr>
                            </tbody>

                            @endforeach
                            
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

{{-- 
    echo @extends('layouts.layout') > addProduct.blade.php & echo @section('titre') >> addProduct.blade.php & echo @endsection >> addProduct.blade.php & echo @section('content') >> addProduct.blade.php & echo @endsection >> addProduct.blade.php
    echo @extends('layouts.layout') > editProduct.blade.php & echo @section('titre') >> editProduct.blade.php & echo @endsection >> editProduct.blade.php & echo @section('content') >> editProduct.blade.php & echo @endsection >> editProduct.blade.php
    echo @extends('layouts.layout') > allProduct.blade.php & echo @section('titre') >> allProduct.blade.php & echo @endsection >> allProduct.blade.php & echo @section('content') >> allProduct.blade.php & echo @endsection >> allProduct.blade.php
    
--}}