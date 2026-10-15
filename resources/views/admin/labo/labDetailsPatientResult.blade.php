@extends('layouts.layout')  

@section('titre')  
    Resultat des examens
@endsection 
@section('stylecss')
    @include('layouts.cdnstyle')
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Tableau de Bord</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Laboratoire</a></li>
                            <li class="breadcrumb-item active">Ajout resultat</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Ajout un resultat</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Saisir le Resultat</h4>
                        <!--Add Patient Form-->
                        <form method="POST" action="{{ url('/laboratory-result', [$laboratory->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Nom du Patient</label>
                                    <input type="text" @readonly(true) value="{{ $laboratory->patient->pat_fname.' '.$laboratory->patient->pat_lname }}" class="form-control" id="inputEmail4" placeholder="Patient's First Name">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputPassword4" class="col-form-label">Patient Ailment</label>
                                    <input type="text" @readonly(true) value="{{ $laboratory->patient->pat_ailment }}" class="form-control"  id="inputPassword4" placeholder="Patient`s Last Name">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4" class="col-form-label">Numéro du Patient</label>
                                    <input type="text" @readonly(true) value="{{ $laboratory->patient->pat_number }}" class="form-control" id="inputEmail4">
                                </div>
                            </div>

                            
                            <hr>
                            <div class="form-group">
                                <!-- Champ caché pour le contenu de Trix -->
                                <input id="editor-input-1" type="hidden" name="lab_pat_tests" value="{{ \App\Support\RichText::sanitize($laboratory->lab_pat_tests) }}" required>
                                <label for="inputAddress" class="col-form-label">Examen demandé</label>
                                <trix-editor input="editor-input-1" class="form-control" style="height: 111px;"></trix-editor>
                            </div>
                            <div class="form-group">
                                <!-- Champ caché pour le contenu de Trix -->
                                <input id="editor-input" type="hidden" name="lab_pat_results" required>
                                <label for="inputAddress" class="col-form-label">Resultat du Labo</label>
                                <trix-editor input="editor-input" class="form-control" style="height: 111px;"></trix-editor>
                            </div>

                            <button type="submit" class="ladda-button btn btn-success" data-style="expand-right">Ajouter resultat</button>

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
    @include('layouts.cdnjs')
    <!-- Loading buttons js -->
    <script src="{{asset('backend/assets/libs/ladda/spin.js')}}"></script>
    <script src="{{asset('backend/assets/libs/ladda/ladda.js')}}"></script>

    <!-- Buttons init js-->
    <script src="{{asset('backend/assets/js/pages/loading-btn.init.js')}}"></script>
@endsection 
<!-- Right bar overlay-->
