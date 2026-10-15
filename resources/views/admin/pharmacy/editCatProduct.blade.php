@extends('layouts.layout')  

@section('titre')  
Editer Prod Catégorie
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

    <!-- Contenu -->
    <div class="container-fluid">
        
        <!-- Titre de la page -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Catégories</a></li>
                            <li class="breadcrumb-item active">Editer Catégorie</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{$category->pharm_cat_name}}</h4>
                </div>
            </div>
        </div>     
        <!-- Fin du titre de la page --> 
        <!-- Formulaire -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Remplissez tous les champs</h4>
                        <!-- Formulaire de modification -->
                        <form method="post" action="{{ route('category.update', ['id' => $category->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-row" >
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Nom de la Catégorie Pharmaceutique</label>
                                    <input type="text" value="{{$category->pharm_cat_name}}" required="required" name="pharm_cat_name" class="form-control" id="inputEmail4" >
                                </div>
                                <div class="form-group col-md-6"> 
                                    <label for="inputPassword4" class="col-form-label">Fournisseur de la Catégorie Pharmaceutique</label>
                                    <select id="vendor_id" name="vendor_id" class="form-control" required>
                                        <option value="{{$category->vendor_id}}">{{$category->vendor->v_name}}</option>
                                        @foreach($vendors as $vendor)
                                            <option value="{{ $vendor->id }}">{{ $vendor->v_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <label for="inputAddress" class="col-form-label">Description de la Catégorie Pharmaceutique</label>
                                <textarea required="required" type="text" class="form-control" name="pharm_cat_desc" id="editor">
                                    {{$category->pharm_cat_desc}}
                                </textarea>
                            </div>

                           <button type="submit" class="ladda-button btn btn-warning" data-style="expand-right">Mettre à jour la Catégorie</button>

                        </form>
                     
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- Fin du formulaire -->

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


