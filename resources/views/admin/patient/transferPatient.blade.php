@extends('layouts.layout')  

@section('titre')  
Tranférer les Patients
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                            <li class="breadcrumb-item active">Transfer Patients</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Transfer Patients</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="header-title">Patients en Attente d'être Tranféré(e)s</h4>
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
                                    <th data-toggle="true">Patient Name</th>
                                    <th data-hide="phone">Patient Number</th>
                                    <th data-hide="phone">Patient Address</th>
                                    <th data-hide="phone">Patient Category</th>
                                    <th data-hide="phone">Action</th>
                                </tr>
                            </thead>
                            
                            @foreach ($patients as $patient)
                                @if ($patient->pat_transfer_status == 0)
                                    <tbody>
                                        <tr>
                                            <td>{{$increment++}}</td>
                                            <td>{{$patient->pat_fname.' '.$patient->pat_fname}}</td>
                                            <td>{{$patient->pat_number}}</td>
                                            <td>{{$patient->pat_addr}}</td>
                                            <td>{{$patient->pat_type}}</td>                                    
                                            <td>
                                                <a href="{{ url('patients/form-transfer-patient', [$patient->id]) }}" class="badge badge-primary"><i class="mdi mdi-check-box-outline "></i> Transfer Patient</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endif
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
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="header-title">Patients Transféré(e)s</h4>
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
                                    <th data-toggle="true">Patient Name</th>
                                    <th data-hide="phone">Patient Number</th>
                                    <th data-hide="phone">Transfer Status</th>
                                    <th data-hide="phone">Refferal Hospital</th>
                                    <th data-hide="phone">Transfer Date</th>
                                </tr>
                            </thead>
                            
                            @foreach ($patients as $patient)
                                @if ($patient->pat_transfer_status == 1)    
                                    <tbody>
                                        <tr>
                                            <td>{{$increment++}}</td>
                                            <td>{{$patient->pat_fname.' '.$patient->pat_fname}}</td>
                                            <td>{{$patient->pat_number}}</td>
                                            <td>Success</td>
                                            <td>{{$patient->pat_transferd_hospital}}</td>
                                            <td>{{$patient->pat_transferd_date}}</td>
                                        
                                        </tr>
                                    </tbody>
                                @endif
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
    </div> <!-- container -->
</div> <!-- content -->
@endsection 


@section('javascript')  
<!-- Footable js -->
<script src="{{asset('backend/assets/libs/footable/footable.all.min.js')}}"></script>
<!-- Init js -->
<script src="{{asset('backend/assets/js/pages/foo-tables.init.js')}}"></script>
@endsection 
