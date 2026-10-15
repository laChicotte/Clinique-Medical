@extends('layouts.layout')  

@section('titre')  
Profil de l'Administrateur System
@endsection  

@section('content')
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
                            <li class="breadcrumb-item"><a href="{{ url('/', []) }}">Tableau de Bord</a></li>
                            <li class="breadcrumb-item active">Profil</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Profil de Mr/Mme {{ Auth::user()->employee->doc_lname }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card-box text-center">
                    <img src="{{ asset('backend/assets/images/users/doctor_admin_icon_4-512.png') }}" class="rounded-circle avatar-lg img-thumbnail"
                        alt="profile-image">

                    <h4 class="mb-0">Administrateur Système</h4>
                    <p class="text-muted">{{ '@'.Auth::user()->name }}</p>
                    <div class="text-left mt-3">
                        <p class="text-muted mb-2 font-13"><strong>Nom Complet :</strong> <span class="ml-2">{{ Auth::user()->employee->doc_fname." ".Auth::user()->employee->doc_lname }}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{ Auth::user()->email }}</span></p>
                    </div>

                </div> <!-- end card-box -->
               
            </div> <!-- end col-->

            <div class="col-lg-8 col-xl-8">
                <div class="card-box">
                    <ul class="nav nav-pills navtab-bg nav-justified">
                        <li class="nav-item">
                            <a href="#aboutme" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                Mettre à jour Profil
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Changer Mot de Passe
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="aboutme">

                        <form method="post" enctype="multipart/form-data">
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i>Informations Personelles</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">Prénom</label>
                                            <input type="text" name="ad_fname"  class="form-control" id="firstname" placeholder="{{ Auth::user()->employee->doc_fname }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastname">Nom</label>
                                            <input type="text" name="ad_lname" class="form-control" id="lastname" placeholder="{{ Auth::user()->employee->doc_lname }}">
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="useremail">Addresse Email</label>
                                            <input type="email" name="ad_email" class="form-control" id="useremail" placeholder="{{ Auth::user()->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="useremail">Photo de Profil</label>
                                            <input type="file" name="ad_dpic" class="form-control btn btn-success" id="useremail" placeholder="sysadmin@hmis.org">
                                        </div>
                                    </div>
                                    
                                </div> <!-- end row -->

                                
                                <div class="text-right">
                                    <button type="submit" name="update_profile" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                </div>
                            </form>


                        </div> <!-- end tab-pane -->
                        <!-- end about me section content -->

                       

                        <div class="tab-pane" id="settings">
                            <form method="post" action="{{ url('user/change', [Auth::user()->id]) }}">
                                @csrf
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Informations Personnelles</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="old_pwd">Ancien Mot de Passe</label>
                                            <input type="password" class="form-control" name="old_pwd" placeholder="Entrer l'ancien mot de passe" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="new_pwd">Nouveau Mot de Passe</label>
                                            <input type="password" class="form-control" name="new_pwd" placeholder="Entrer le nouveau mot de passe" required>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                        
                                <div class="form-group">
                                    <label for="confirm_pwd">Confirmer le Nouveau Mot de Passe</label>
                                    <input type="password" class="form-control" name="confirm_pwd" placeholder="Confirmer le nouveau mot de passe" required>
                                </div>
                        
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Mettre à jour le mot de passe</button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- end settings content-->

                    </div> <!-- end tab-content -->
                </div> <!-- end card-box-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div> <!-- content -->
@endsection


@section('javascript')  
<!-- Footable js -->
<script src="{{asset('backend/assets/libs/footable/footable.all.min.js')}}"></script>
<!-- Init js -->
<script src="{{asset('backend/assets/js/pages/foo-tables.init.js')}}"></script>
@endsection 
