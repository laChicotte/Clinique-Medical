@extends('layouts.layout')  

@section('titre')  
Dossiers médicaux
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Rapport</a></li>
                            <li class="breadcrumb-item active">Dossier médical</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Dossiers médicaux</h4>
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
                                <th data-toggle="true">Nom du patient</th>
                                <th data-hide="phone">Numéro Patient</th>
                                <th data-hide="phone">Addresse</th>
                                <th data-hide="phone">Maladie</th>
                                <th data-hide="phone">Age</th>
                                <th data-hide="phone">Action</th>
                            </tr>
                            </thead>
                                @foreach ($patients as $pat)
                                    <tbody>
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$pat->pat_fname.' '.$pat->pat_lname}}</td>
                                            <td>{{$pat->pat_number}}</td>
                                            <td>{{$pat->pat_addr}}</td>
                                            <td>{{$pat->pat_ailment}}</td>
                                            <td>{{$pat->pat_age}} Ans</td>
                                            <td>
                                                <a href="{{ route('record.patient.detail', ['id'=>$pat->id]) }}" class="badge badge-success"><i class="fas fa-eye"></i> View</a>
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
