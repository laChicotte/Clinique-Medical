@extends('layouts.layout')  

@section('titre')  
Gérer les Produits
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
{{-- affichage de l'alert en ca de succes --}}
@if (Session::has('error'))
    <input type="hidden" name="" id="message" value="{{Session::get('status')}}">
    <script type="text/javascript">
        let message = document.getElementById("message").value;
        setTimeout(() => {
            swal("Succès", message, "error")
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Produit</a></li>
                            <li class="breadcrumb-item active">Gestion Produit</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Gestion Produits </h4>
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
                                <th data-toggle="true"> nom</th>
                                <th data-hide="phone">Code Barre</th>
                                <th data-hide="phone">Fournisseur</th>
                                <th data-hide="phone">Catégorie</th>
                                <th data-hide="phone">Quantité</th>
                                <th data-hide="phone">Action</th>
                            </tr>
                            </thead>
                            @foreach($products as $product)
                                <tbody>
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->phar_name }}</td>
                                        <td>{{ $product->phar_bcode }}</td>
                                        <td>{{ $product->category->vendor->v_name }}</td>
                                        <td>{{ $product->category->pharm_cat_name }}</td>
                                        <td>{{ $product->phar_qty }} Cartons</td>
                                        <td>
                                            <a href="{{ route('product.show', $product->id) }}" class="badge badge-success"><i class="far fa-eye "></i> View</a>
                                            <a href="{{ route('product.edit', $product->id) }}" class="badge badge-warning"><i class="fas fa-clipboard-check "></i> Update</a>
                                            <!-- Utiliser un formulaire pour la suppression pour des raisons de sécurité -->
                                            
                                            
                                            @if (Auth::user()->role == "admin")
                                            <form action="{{ route('product.delete', $product->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge badge-danger btn"><i class="fas fa-trash-alt"></i> Delete</button>
                                            </form>
                                            @endif
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
