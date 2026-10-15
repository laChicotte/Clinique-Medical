@extends('layouts.layout')  

@section('titre')  
    Gestion des Equipements du Bloc
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Chirurgie | Equipements </a></li>
                            <li class="breadcrumb-item active">Gestion des Equipments</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Chirurgie | Gestion des Equipments</h4>
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
                                        <option value="">Tout Afficher</option>
                                        <option value="Discharged">Transférés</option>
                                        <option value="OutPatients">Externtes</option>
                                        <option value="InPatients">Internes</option>
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
                                <th data-toggle="true">Nom</th>
                                <th data-hide="phone">Fournisseur</th>
                                <th data-hide="phone">Barcode</th>
                                <th data-hide="phone">Statut</th>
                                <th data-hide="phone">Quantité</th>
                                <th data-hide="phone">Action</th>
                            </tr>
                            </thead>
                            
                            @foreach ($labEquipments as $eqp)                    
                                <tbody>
                                    <tr>
                                        <td>{{$loop->iteration}} </td>
                                        <td>{{$eqp->eqp_name}}</td>
                                        <td>{{$eqp->vendor->v_name}}</td>
                                        <td>{{$eqp->eqp_code}}</td>
                                        <td>{{$eqp->eqp_status}}</td>
                                        <td>{{$eqp->eqp_qty}}</td>
                                        <td>
                                            <a href="{{ route('equipement.detail', ['id'=>$eqp->id]) }}" class="badge badge-success"><i class="far fa-eye"></i> View</a>
                                            <a href="{{ route('equipement.edit', ['id'=>$eqp->id]) }}" class="badge badge-warning"><i class="fas fa-clipboard-check"></i> Update</a>
                                            <a href="#" class="badge badge-danger" onclick="confirmDelete({{ $eqp->id }})"><i class="fas fa-trash-alt"></i> Delete</a>
                                        </td>
                                        
                                        <!-- Boîte de dialogue de confirmation de suppression -->
                                        <div id="confirmDeleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Êtes-vous sûr de vouloir supprimer cet équipement ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                        <form id="deleteForm" action="{{ route('equipement.delete', ['id' => '__ID__']) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <script>
                                            // Fonction pour remplacer le placeholder __ID__ par l'ID de l'équipement sélectionné
                                            function confirmDelete(id) {
                                                var form = document.getElementById('deleteForm');
                                                form.action = form.action.replace('__ID__', id);
                                                $('#confirmDeleteModal').modal('show');
                                            }
                                        </script>
                                        
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