@extends('layouts.layout')  

@section('titre')  
    Nouvel utilisateur
@endsection 


@section('content')
@if (session('new_account'))
    <div class="alert alert-warning" role="alert">
        <p>Compte créé pour <strong>{{ session('new_account.email') }}</strong>.</p>
        <p>Mot de passe initial : <code>{{ session('new_account.password') }}</code></p>
        <p class="mb-0">Ce mot de passe est affiché une seule fois. Transmettez-le directement à la personne concernée ; elle pourra le changer depuis son profil.</p>
    </div>
@endif
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
@if (Session::has('echec'))
    <input type="hidden" name="" id="message" value="{{Session::get('echec')}}">
    <script type="text/javascript">
        let message = document.getElementById("message").value;
        setTimeout(() => {
            swal("Echec", message, "error")
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Utilisateurs</a></li>
                            <li class="breadcrumb-item active">Nouvel user</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Employés non utilisateurs</h4>
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
                                        <option value="">Afficher tout</option>
                                        <option value="Discharged">Liberés</option>
                                        <option value="OutPatients">Externes</option>
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
                                <th data-toggle="true">Name</th>
                                <th data-hide="phone">Number</th>
                                <th data-hide="phone">Department</th>
                                <th data-hide="phone">Email</th>
                                <th data-hide="phone">Action</th>
                            </tr>
                            </thead> 
                                @foreach ($employees as $e)   
                                    <tbody>
                                    <tr>
                                        <td>{{ $loop->iteration }}</td> <!-- Affiche le numéro de ligne -->
                                        <td>{{ $e->doc_fname }}</td> 
                                        <td>{{ $e->doc_lname }}</td> 
                                        <td>{{ $e->doc_dept }}</td> 
                                        <td>{{ $e->doc_email }}</td> 
                                        <td>
                                            <form method="POST" action="{{ route('user.store', $e->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">Créer le compte</button>
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
