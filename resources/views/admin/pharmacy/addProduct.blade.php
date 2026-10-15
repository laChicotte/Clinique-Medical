@extends('layouts.layout')  
@section('titre')  
Ajout de Produit
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
                            <li class="breadcrumb-item"><a href="route()">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Produits</a></li>
                            <li class="breadcrumb-item active">Ajouter Produit</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Créer un Produit</h4>
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
                        <!--Add Product Form-->
                        <form method="POST" action="{{ route('product.save') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Nom du Produit</label>
                                    <input type="text" required="required" name="phar_name" class="form-control" id="inputEmail4" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4" class="col-form-label">Quantité du Produit (Cartons)</label>
                                    <input required="required" type="text" name="phar_qty" class="form-control"  id="inputPassword4">
                                </div>
                            </div>
                            <div class="form-row">
                            <div class="form-group col-md-6">
                                    <label for="inputState" class="col-form-label">Catégories des produits</label>
                                    
                                    <select id="inputState" name="category_id" class="form-control" required>
                                        <option value="">Sélectionner une catégorie</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->pharm_cat_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4" class="col-form-label">Pharmaceutical Barcode(EAN-8)</label>
                                    <input required="required" type="text" name="phar_bcode" class="form-control"  id="inputPassword4">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputAddress" class="col-form-label">Description du Produit</label>
                                <textarea required="required" type="text" class="form-control" name="phar_desc" id="editor"></textarea>
                            </div>

                           <button type="submit" class="ladda-button btn btn-success" data-style="expand-right">Ajouter Produit</button>

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
    <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
    <script type="text/javascript">
    CKEDITOR.replace('editor')
    </script>
    <!-- Loading buttons js -->
    <script src="{{asset('backend/assets/libs/ladda/spin.js')}}"></script>
    <script src="{{asset('backend/assets/libs/ladda/ladda.js')}}"></script>

    <!-- Buttons init js-->
    <script src="{{asset('backend/assets/js/pages/loading-btn.init.js')}}"></script>
@endsection
