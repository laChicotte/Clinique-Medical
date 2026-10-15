@extends('layouts.layout')  

@section('titre')  
    Ajout Equipement Labo
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Laboratoire</a></li>
                            <li class="breadcrumb-item active">Ajouter Equipment</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Ajouter un Equipment de Labo</h4>
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
                        <!--Add Equipement Form-->
                        <form method="post" action="{{ route('equipement.save.lab') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4" class="col-form-label">Nom de l'Equipment</label>
                                    <input type="text" required="required" name="eqp_name" class="form-control" id="inputEmail4" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="vendor_id" class="col-form-label">Fournisseur</label>
                                    <select id="vendor_id" name="vendor_id" class="form-control" required>
                                        <option value="">Sélectionner un fournisseur</option>
                                        @foreach($vendors as $vendor)
                                            <option value="{{ $vendor->id }}">{{ $vendor->v_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4" class="col-form-label">Quantité </label>
                                    <input required="required" type="text"  name="eqp_qty" class="form-control"  id="inputPassword4">
                                </div> 
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity" class="col-form-label">Photo de l'Equipement</label>
                                    <input type="file" name="eqp_dpic" accept="image/jpeg,image/png,image/gif" class="btn btn-success form-control"  id="inputCity">
                                </div>  
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4" class="col-form-label">Equipment Code Barre(EAN-8)</label>
                                    <input required="required" type="text" name="eqp_code" class="form-control" id="inputPassword4" placeholder="691403852">
                                </div>
                            </div>


                            <div class="form-group" >
                                <label for="inputAddress" class="col-form-label">Description de l'équipement</label>
                                <textarea required="required" type="text" class="form-control" name="eqp_desc" id="editor"></textarea>
                            </div>

                           <button type="submit" class="ladda-button btn btn-success" data-style="expand-right">Ajout Equipement</button>

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
    <!-- END wrapper -->
    <!--Load CK EDITOR Javascript-->
    <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('editor')
    </script>
<script src="{{asset('backend/assets/libs/ladda/spin.js')}}"></script>
<script src="{{asset('backend/assets/js/pages/loading-btn.init.js')}}"></script>
<script src="{{asset('backend/assets/libs/ladda/ladda.js')}}"></script>
@endsection
