@extends('layouts.layout')  

 
@section('titre') 
Gérer les Patients 
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                            <li class="breadcrumb-item active">Gérer les Patients</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Gestion des Patients</h4>
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
                                <tr>
                                    <th>#</th>
                                    <th data-toggle="true">Nom du Patient</th>
                                    <th data-hide="phone">Numéro du Patient</th>
                                    <th data-hide="phone">Addresse du Patient</th>
                                    <th data-hide="phone">Catégorie du Patient</th>
                                    <th data-hide="phone">Action</th>
                                </tr>
                            </tr>
                            </thead>
                            
                            @foreach ($patients as $patient)
                            <tbody>
                                <tr>
                                    <td>{{$increment++}}</td>
                                    <td>{{$patient->pat_fname." ".$patient->pat_lname}}</td>
                                    <td>{{$patient->pat_number}}</td>
                                    <td>{{$patient->pat_addr}}</td>
                                    <td>{{$patient->pat_type}}</td>
                                    <td style="display: flex">
                                        <form action="{{ url('patient/delete-patient', [$patient->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge badge-danger">
                                                <i class=" mdi mdi-trash-can-outline "></i> Delete
                                            </button>
                                        </form>
                                        <a href="{{ url('patient/details-patient', [$patient->id]) }}" class="badge badge-success" style="margin-left: 1px; margin-right:1px;"><i class="mdi mdi-eye"></i> View</a>
                                        <a href="{{ url('patient/edit-patient', [$patient->id]) }}" class="badge badge-primary"><i class="mdi mdi-check-box-outline "></i> Update</a>
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