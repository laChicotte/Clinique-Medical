@extends('layouts.layout')  

@section('titre')  
Dossiers chirugicaux
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Surgery | Theatre</a></li>
                            <li class="breadcrumb-item active">Surgery Records</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Surgery Patient  Records</h4>
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
                                <th data-toggle="true">Nom Complet</th>
                                <th data-hide="phone">Numéro</th>
                                <th data-hide="phone">Intervention</th>
                                <th data-hide="phone">Chirurgien </th>
                                <th data-hide="phone">Date </th>
                                <th data-hide="phone">Action</th>
                            </tr>
                            </thead>
                            
                            @foreach ($surgeries as $surgery)
                                <tbody>
                                    <tr>
                                        <td>{{$loop->iteration}} </td>
                                            <td>{{$surgery->patient->pat_fname.' '.$surgery->patient->pat_lname}}</td>
                                            <td>{{$surgery->patient->pat_number}}</td>
                                            <td>{{$surgery->su_name}}</td>
                                            <td>{{$surgery->employee->doc_fname.' '.$surgery->employee->doc_lname}}</td>
                                            <td>{{$surgery->created_at->format('d/m/Y')}}</td> 
                                        </td>
                                        <td>
                                            <a href="{{ route('surgery.details', ['id'=>$surgery->id]) }}" class="badge badge-success"><i class="mdi mdi-eye"></i> View</a>
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
