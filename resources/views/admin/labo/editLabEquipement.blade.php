@extends('layouts.layout')  

@section('titre')  
    Editer L'Equipement
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Gestion des Equipements</a></li>
                            <li class="breadcrumb-item active">Mise à jour Equipement</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Mise à jour de l'Equipement</h4>
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
                        <!--UPDATE EQUIPEMENT Form-->

                        <form method="post" action="{{ route('equipement.update.lab', ['id'=>$equipement->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4" class="col-form-label">Nom de l'Equipment</label>
                                    <input type="text" required="required" value="{{$equipement->eqp_name}}" name="eqp_name" class="form-control" id="inputEmail4" >
                                </div>
                    
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4" class="col-form-label">Equipment Code Barre(EAN-8)</label>
                                    <input required="required" type="text" value="{{ $equipement->eqp_code}}" name="eqp_code" class="form-control" id="inputPassword4">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="inputPassword4" class="col-form-label">Quantité</label>
                                    <input required="required" type="text" value="{{ $equipement->eqp_qty}}" name="eqp_qty" class="form-control"  id="inputPassword4">
                                </div> 
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCity" class="col-form-label">Photo de l'Equipement</label>
                                    <input type="file" name="eqp_dpic" class="btn btn-success form-control" id="inputCity">        
                                </div>  
                                <div class="form-group col-md-4">
                                    <label for="vendor_id" class="col-form-label">Fournisseur</label>
                                    <select id="vendor_id" name="vendor_id" class="form-control" required>
                                        <option value="{{ $equipement->vendor_id }}">{{ $equipement->vendor->v_name }}</option>
                                        @foreach($vendors as $vendor)
                                            @if ($vendor->id != $equipement->vendor_id)                
                                                <option value="{{ $vendor->id }}">{{ $vendor->v_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label for="eqp_status" class="col-form-label">Statut</label>
                                    <select id="eqp_status" name="eqp_status" class="form-control" required>
                                        <option value="{{ $equipement->eqp_status }}">{{ $equipement->eqp_status == "Working" ? "En fonctionnement" : "Hors service" }}</option>
                                        <option value="{{ $equipement->eqp_status == "Working" ? "Not Working" : "Working" }}">
                                            {{ $equipement->eqp_status == "Working" ? "Hors service" : "En fonctionnement" }}
                                        </option>
                                    </select>
                                </div>
                                
                            </div>


                            <div class="form-group" >
                                <label for="inputAddress" class="col-form-label">Description de l'équipement</label>
                                <textarea required="required" type="text" class="form-control" name="eqp_desc" id="editor">
                                    {!! $equipement->eqp_desc !!}
                                </textarea>
                            </div>

                           <button type="submit" class="ladda-button btn btn-success" data-style="expand-right">Modifier Equipement</button>

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
    <div class="rightbar-overlay"></div>
    <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
    <script type="text/javascript">
    CKEDITOR.replace('editor')
    </script>
    <script type="text/javascript">
    CKEDITOR.replace('editor1')
    </script>
    <!-- Loading buttons js -->
    <script src="{{asset('backend/assets/libs/ladda/spin.js')}}"></script>
    <script src="{{asset('backend/assets/libs/ladda/ladda.js')}}"></script>

    <!-- Buttons init js-->
    <script src="{{asset('backend/assets/js/pages/loading-btn.init.js')}}"></script>
@endsection 
<!-- Right bar overlay-->
