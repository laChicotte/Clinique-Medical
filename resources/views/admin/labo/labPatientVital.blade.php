@extends('layouts.layout')  

@section('titre')  
    Signes Vitaux Patient
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard', []) }}">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Laboratoire</a></li>
                            <li class="breadcrumb-item active">Ajout Signes Vitaux</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Enregistrer les signes vitaux</h4>
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
                                <th data-hide="phone">Numéro</th>
                                <th data-hide="phone">Adresse</th>
                                <th data-hide="phone">Maladie</th>
                                <th data-hide="phone">Âge</th>
                                <th data-hide="phone">Catégorie</th>
                                <th data-hide="phone">Action</th>
                            </tr>
                            </thead>
                            
                            @foreach ($patients as $patient)
                            
                                <tbody>
                                    <tr>
                                        <td>{{$loop->iteration}} </td>
                                        <td>{{$patient->pat_fname.' '.$patient->pat_lname}}</td>
                                        <td>{{$patient->pat_number}}</td>
                                        <td>{{$patient->pat_addr}}</td>
                                        <td>{{$patient->pat_ailment}}</td>
                                        <td>{{$patient->pat_age}} Ans</td>
                                        <td>{{$patient->pat_type}}</td>
                                        
                                        <td><a href="{{ route('add_patient_vitals', ['id'=>$patient->id]) }}" class="badge badge-success"><i class="mdi mdi-beaker "></i> Capture Vitals</a></td>
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