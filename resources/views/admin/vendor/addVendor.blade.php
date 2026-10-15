@extends('layouts.layout')  

@section('titre')  
    Ajout Fournisseur
@endsection 

@section('stylecss')
    @include('layouts.cdnstyle')
@endsection

@section('content')  

{{-- debut d'affichage des erreurs au cas ou il y en a --}}
@php
    $sms="";
@endphp

@if (count($errors) > 0)
    @foreach ($errors->all() as $item)
        @php
            $sms=$sms.$item."\r\n";
        @endphp
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
{{-- fin --}}


<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin-dashboard', []) }}">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Fournisseurs</a></li>
                            <li class="breadcrumb-item active">Ajout Fournisseur</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Ajouter les details du Fournisseurs</h4>
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
                        <!--Add Patient Form-->
                        <form method="post" action="{{ url('vendor/saveVendor', []) }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4" class="col-form-label">Nom de l'Entreprise</label>
                                    <input type="text" required="required" name="v_name" class="form-control" id="inputEmail4" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4" class="col-form-label">Téléphone du Fournisseur</label>
                                    <input required="required" type="text" name="v_phone" class="form-control"  id="inputPassword4">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4" class="col-form-label">Addresse du Fournisseur</label>
                                    <input required="required" type="text" name="v_addr" class="form-control"  id="inputPassword4">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputAddress" class="col-form-label">Email du Fournisseur</label>
                                <input required="required" type="email" class="form-control" name="v_email" id="inputAddress">
                            </div>

                            <div class="form-group">
                                <!-- Champ caché pour le contenu de Trix -->
                                <input id="editor-input" type="hidden" name="v_desc" required>
                                <label for="inputAddress" class="col-form-label">Details sur le Fournisseur</label>
                                <trix-editor input="editor-input" class="form-control" style="height: 111px;"></trix-editor>
                            </div>

                            <button type="submit" class="ladda-button btn btn-success" data-style="expand-right">Ajouter</button>

                        </form>
                        <!--End Patient Form-->
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->

@endsection  

@section('javascript')  
    @include('layouts.cdnjs')   
<!-- END wrapper -->
<script src="{{asset('backend/assets/libs/ladda/spin.js')}}"></script>
<script src="{{asset('backend/assets/js/pages/loading-btn.init.js')}}"></script>
<script src="{{asset('backend/assets/libs/ladda/ladda.js')}}"></script>
@endsection

