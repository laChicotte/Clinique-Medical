@extends('layouts.layout')  

@section('titre')  
    Gestion des Fournisseurs
@endsection 

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Fournisseurs</a></li>
                            <li class="breadcrumb-item active">Gestion Fournisseur</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Gestion des Fournisseurs</h4>
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
                                <th data-toggle="true">Noms</th>
                                <th data-hide="phone">Numéro</th>
                                <th data-hide="phone">Emails</th>
                                <th data-hide="phone">Action</th>
                            </tr>
                            </thead>
                            @foreach ($vendors as $vendor)                               
                                <tbody>
                                    <tr>
                                        <td>{{$increment++}} </td>
                                        <td>{{$vendor->v_name}}</td>
                                        <td>{{$vendor->v_number}}</td>
                                        <td>{{$vendor->v_email}}</td>
                                        <td style="display: flex">
                                            <a href="{{ url('vendor/details-vendor', [$vendor->id]) }}" class="badge badge-success"><i class="fas fa-eye"></i> View</a>
                                            <a href="{{ url('vendor/edit-vendor', [$vendor->id]) }}" class="badge badge-success" style="margin-left: 1px; margin-right:1px;"><i class="fas fa-edit"></i> Update</a>
                                            <form action="{{ url('vendor/delete-vendor', [$vendor->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge badge-danger">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
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