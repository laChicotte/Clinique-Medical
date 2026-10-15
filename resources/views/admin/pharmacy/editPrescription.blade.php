@extends('layouts.layout')  
@section('titre') 
Gérer les ordonnances 
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pharmacie</a></li>
                                <li class="breadcrumb-item active">Mis à jour ordonnance</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Mettre à jour l'ordonnance du patient</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            <!-- Form row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Mettre à jour l'ordonnance</h4>
                            <!--Add Patient Form-->
                            <form method="post" action="{{ route('prescription.update', $prescription->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4" class="col-form-label">Nom du Patient</label>
                                        <input type="text" @readonly(true) value="{{$prescription->patient->pat_fname.' '.$prescription->patient->pat_lname}}" class="form-control" id="inputEmail4" placeholder="Patient's First Name">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4" class="col-form-label">Âge du Patient</label>
                                        <input type="text" @readonly(true) value="{{$prescription->patient->pat_age}} Ans" class="form-control"  id="inputPassword4" placeholder="Patient`s Last Name">
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4" class="col-form-label">Numéro du Patient</label>
                                        <input type="text" @readonly(true) value="{{$prescription->patient->pat_number}}" class="form-control" id="inputEmail4">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputPassword4" class="col-form-label">Addresse du Patient</label>
                                        <input type="text" @readonly(true) value="{{$prescription->patient->pat_addr}}" class="form-control"  id="inputPassword4" placeholder="Patient`s Age">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputPassword4" class="col-form-label">Patient Type</label>
                                        <input @readonly(true) type="text" value="{{$prescription->patient->pat_type}}" class="form-control"  id="inputPassword4" placeholder="Patient`s Age">
                                    </div>

                                </div>

                                <div class="form-group ">
                                        <label for="inputCity" class="col-form-label">Diagnostic du Patient</label>
                                        <input @readonly(true) type="text" value="{{$prescription->patient->pat_ailment}}" class="form-control" id="inputCity">
                                </div>
                                <hr>
                                <div class="form-row"> 
                                    <div class="form-group col-md-2" style="display:none">
                                        <input type="text" name="patient_id" value="{{$prescription->patient->id}}" class="form-control" id="inputZip">
                                    </div>
                                </div>

                                <div class="form-group">
                                        <label for="inputAddress" class="col-form-label">Ordonnance</label>
                                        <textarea required="required"  type="text" class="form-control" name="pres_ins" id="editor">
                                            {{ \App\Support\RichText::sanitize($prescription->pres_ins) }}
                                        </textarea>
                                </div>

                                <button type="submit" class="ladda-button btn btn-primary" data-style="expand-right">Mettre à jour</button>
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
