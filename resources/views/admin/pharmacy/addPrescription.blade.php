@extends('layouts.layout') 

@section('titre')  
Ajouter ordonnance 
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pharmacie</a></li>
                            <li class="breadcrumb-item active">Donner une Prescription</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Prescriver les ordonnances</h4>
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
                                <th data-toggle="true">Nom du Patient</th>
                                <th data-hide="phone">Numéro du Patient</th>
                                <th data-hide="phone">Adresse</th>
                                <th data-hide="phone">Maladie</th>
                                <th data-hide="phone">Âge</th>
                                <th data-hide="phone">Catégorie</th>
                                <th data-hide="phone">Action</th>

                            </tr>
                            </thead>
                            
                            @foreach($patients as $patient)
                                <tbody>
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $patient->pat_fname.' '.$patient->pat_lname }}</td>
                                        <td>{{ $patient->pat_number }}</td>
                                        <td>{{ $patient->pat_addr }}</td>
                                        <td>{{ $patient->pat_ailment }}</td>
                                        <td>{{ $patient->pat_age }} Ans</td>
                                        <td>{{ $patient->pat_type }}</td>
                                        <td>
                                            <a href="{{ route('prescription.detail', $patient->id) }}" class="badge badge-success">
                                                <i class="fas fa-highlighter "></i> Ajouter ordonnance
                                            </a>
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
<div class="rightbar-overlay"></div>

{{-- <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('editor')
</script> --}}


<!-- Vendor js -->
<script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>

<!-- App js-->
<script src="{{ asset('backend/assets/js/app.min.js') }}"></script>

<!-- Loading buttons js -->
<script src="{{ asset('backend/assets/libs/ladda/spin.js') }}"></script>
<script src="{{ asset('assets/libs/ladda/ladda.js') }}"></script>

<!-- Buttons init js-->
<script src="{{ asset('backend/assets/js/pages/loading-btn.init.js') }}"></script>

@endsection 

        
