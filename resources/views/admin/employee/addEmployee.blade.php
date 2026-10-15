@extends('layouts.layout')  

@section('titre')
Ajout Employé(e)  
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
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Employés</a></li>
                            <li class="breadcrumb-item active">Ajout Employé(e)</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Ajouter les informations de l'employé(e)</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Remplir les champs</h4>
                        <!--Add Employee Form-->
                        <form action="{{ url('employee/saveEmployee', []) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Prénom</label>
                                    <input type="text" required="required" name="doc_fname" class="form-control" id="inputEmail4" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4" class="col-form-label">Nom</label>
                                    <input required="required" type="text"  name="doc_lname" class="form-control"  id="inputPassword4">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputAddress" class="col-form-label">Email</label>
                                <input required="required" type="email"  class="form-control" name="doc_email" id="inputAddress">
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity" class="col-form-label">Photo de Profil</label>
                                    <input type="file" name="doc_dpic" class="btn btn-success form-control"  id="inputCity">
                                </div>
                            </div>                                            

                            <button type="submit" name="update_doc" class="ladda-button btn btn-success" data-style="expand-right">Ajouter l'Employé(e)</button>

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
    <!-- Loading buttons js -->
    <script src="{{asset('backend/assets/libs/ladda/spin.js')}}"></script>
    <script src="{{asset('backend/assets/libs/ladda/ladda.js')}}"></script>
    <!-- Buttons init js-->
    <script src="{{asset('backend/assets/js/pages/loading-btn.init.js')}}"></script>
@endsection
