@extends('layouts.layout')  

@section('titre')
Gérer les Employé(e)s
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
                            <li class="breadcrumb-item"><a href="{{ url('/admin-dashboard', []) }}">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Employés</a></li>
                            <li class="breadcrumb-item active">Manage Employees</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Details de Gestion des Employé(e)s</h4>
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
                                <th data-hide="phone">Department</th>
                                <th data-hide="phone">Email</th>
                                <th data-hide="phone">Action</th>
                            </tr>
                            </thead>
                            
                            @foreach ($employees as $emp)
                                <tbody>
                                    <tr>
                                        <td>{{$increment++}}</td>
                                        <td>{{$emp->doc_fname." ".$emp->doc_lname}}</td>
                                        <td>{{$emp->doc_number}}</td>
                                        <td>{{$emp->doc_dept}}</td>
                                        <td>{{$emp->doc_email}}</td>
                                        
                                        <td style="display: flex">
                                            <form action="{{ url('employees/delete-employee', [$emp->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge badge-danger">
                                                    <i class=" mdi mdi-trash-can-outline "></i> Delete
                                                </button>
                                            </form>
                                            <a href="{{ url('employees/details-employee', [$emp->id]) }}" class="badge badge-success" style="margin-left: 1px; margin-right:1px;"><i class="mdi mdi-eye"></i> View</a>
                                            <a href="{{ url('employees/edit-employee', [$emp->id]) }}" class="badge badge-primary"><i class="mdi mdi-check-box-outline "></i> Update</a>
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
