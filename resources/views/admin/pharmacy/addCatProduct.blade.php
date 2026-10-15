@extends('layouts.layout')  

@section('titre')  
Ajout Prod Catégorie
@endsection  

@section('content') 
{{-- debut d'affichage des erreurs au cas ou il y en a --}}
@php $sms=""; @endphp

@if (count($errors) > 0)
    @foreach ($errors->all() as $item)
        @php $sms=$sms.$item."\r\n"; @endphp
    @endforeach
    
    <input type="hidden" name="" id="message" value="{{$sms}}">
    <script type="text/javascript">
        let message = document.getElementById("message").value;
        setTimeout(() => {
            swal("Erreur", message, "error")
        }, 100);
    </script>
@endif
{{-- fin d'affichage des erreurs au cas ou il y en a --}}

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
                            <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Tableau de bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Produits pharmaceutiques</a></li>
                            <li class="breadcrumb-item active">Ajouter une catégorie pharmaceutique</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Créer une catégorie pharmaceutique</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Remplir tous les champs</h4>
                        <!--Add Category Form-->
                        <form method="post" action="{{ route('category.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="pharm_cat_name">Nom de la catégorie pharmaceutique :</label>
                                <input type="text" id="pharm_cat_name" name="pharm_cat_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="vendor_id">Fournisseur de produits pharmaceutiques :</label>
                                <select id="vendor_id" name="vendor_id" class="form-control" required>
                                    <option value="">Sélectionner un fournisseur</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->v_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress" class="col-form-label">Description</label>
                                <textarea required="required" type="text" class="form-control" name="pharm_cat_desc" id="editor"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter la catégorie</button>
                        </form>
                        
                     
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->
@endsection  

@section('javascript')
    <!--Load CK EDITOR Javascript-->
    <script src="{{asset('backend///cdn.ckeditor.com/4.6.2/basic/ckeditor.js')}}"></script>
    <script type="text/javascript">
    CKEDITOR.replace('editor')
    </script>
    <!-- Loading buttons js -->
    <script src="{{asset('backend/assets/libs/ladda/spin.js')}}"></script>
    <script src="{{asset('backend/assets/libs/ladda/ladda.js')}}"></script>

    <!-- Buttons init js-->
    <script src="{{asset('backend/assets/js/pages/loading-btn.init.js')}}"></script>
@endsection
