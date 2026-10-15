@extends('layouts.layout')  

@section('titre')
Ajout des Salaires
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tableau de bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Payroll</a></li>
                            <li class="breadcrumb-item active">Add Payroll</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Employee Details</h4>
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
                                        <option value="">Voir tout</option>
                                        <option value="Discharged">Liberés</option>
                                        <option value="OutPatients">Patients Externes</option>
                                        <option value="InPatients">Patients Internes</option>
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
                                <th data-hide="phone">Email</th>
                                <th data-hide="phone">Department</th>
                                <th data-hide="phone">Action</th>
                            </tr>
                            </thead>
                            @foreach ($employees as $employee)                                
                            <tbody>
                                <tr>
                                    <td>{{$loop->iteration}} </td>
                                    <td>{{$employee->doc_fname.' '.$employee->doc_lname}}</td>
                                    <td>{{$employee->doc_number}}</td>
                                    <td>{{$employee->doc_email}}</td>   
                                    <td>{{$employee->doc_dept}}</td>
                                
                                    <td>
                                        <a href="#" class="badge badge-primary"><i class="mdi mdi-eye"></i> View</a>
                                        <a href="{{ route('add.payroll.form', ['id'=>$employee->id]) }}" class="badge badge-success"><i class="fas fa-eye-dropper "></i>Nouvel Paie</a>
                                    </td>
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
