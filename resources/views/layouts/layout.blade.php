<!DOCTYPE html>
<html lang="fr">
    
    <!--Head Code-->
    <head>
        <meta charset="utf-8" />
        <title> @yield('titre') </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="MartDevelopers" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}">
        <!-- Plugins css -->
        <link href="{{asset('backend/assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App css -->
        <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Loading button css -->
        <link href="{{asset('backend/assets/libs/ladda/ladda-themeless.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Footable css -->
        <link href="{{asset('backend/assets/libs/footable/footable.core.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Load Sweet Alert Javascript -->
        <script src="{{asset('backend/assets/js/swal.js')}}"></script>
        <!-- Inject SWAL -->
        @yield('stylecss')
</head>
    <body>
        
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">

                    <li class="d-none d-sm-block">
                        <form class="app-search">
                            <div class="app-search-box">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <div class="input-group-append">
                                        <button class="btn" type="submit">
                                            <i class="fe-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </li>

                    
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{asset('backend/assets/images/users/profie.jpg')}}" alt="dpic" class="rounded-circle">
                            <span class="pro-user-name ml-1">
                                {{ Auth::user()->role }} <i class="mdi mdi-chevron-down"></i> 
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Bienvenue !</h6>
                            </div>

                            <!-- item-->
                            <a href="{{ url('/admin-profil-system', []) }}" class="dropdown-item notify-item">
                                <i class="fe-user"></i>
                                <span>Mon Compte</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <!-- item-->
                            <a href="{{ route('logoutAdmin') }}" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>Deconnexion</span>
                            </a>

                        </div>
                    </li>

                

                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="{{ url('/', []) }}" class="logo text-center">
                        <span class="logo-lg">
                            <img src="{{asset('backend/assets/images/logo-light.png')}}" alt="" height="18">
                            <!-- <span class="logo-lg-text-light">UBold</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-sm-text-dark">U</span> -->
                            <img src="{{asset('backend/assets/images/logo-sm.png')}}" alt="" height="24">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>

                    <li class="dropdown d-none d-lg-block">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            Créer un nouveau
                            <i class="mdi mdi-chevron-down"></i> 
                        </a>
                        <div class="dropdown-menu">
                            <!-- item-->
                            <a href="{{ url('employees/add-employee') }}" class="dropdown-item">
                                <i class="fe-users mr-1"></i>
                                <span>Employé</span>
                            </a>

                            <!-- item-->
                            <a href="{{ url('patients/add-patient') }}" class="dropdown-item">
                                <i class="fe-activity mr-1"></i>
                                <span>Patient</span>
                            </a>

                            <!-- item-->
                            <a href="{{ url('payroll/add-payroll', []) }}" class="dropdown-item">
                                <i class="fe-layers mr-1"></i>
                                <span>Masse salariale</span>
                            </a>

                            <!-- item-->
                            <a href="{{ url('vendor/add-vendor', []) }}" class="dropdown-item">
                                <i class="fe-shopping-cart mr-1"></i>
                                <span>Fournisseur</span>
                            </a>


                            <!-- item-->
                            <a href="{{ url('record/add-record', []) }}" class="dropdown-item">
                                <i class="fe-list mr-1"></i>
                                <span>Rapport médical</span>
                            </a>

                            <!-- item-->
                            <a href="his_admin_lab_report.php" class="dropdown-item">
                                <i class="fe-hard-drive mr-1"></i>
                                <span>Rapport de laboratoire</span>
                            </a>

                            <!-- item-->
                            <a href="his_admin_surgery_records.php" class="dropdown-item">
                                <i class="fe-anchor mr-1"></i>
                                <span>Rappport chirugical/Bloc opératoire</span>
                            </a>

                            
                            <div class="dropdown-divider"></div>

                            
                        </div>
                    </li>

                </ul>
            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="slimscroll-menu">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul class="metismenu" id="side-menu">

                            <li class="menu-title">Navigation</li>

                            <li>
                                <a href="{{ url('/admin-dashboard') }}">
                                    <i class="fe-airplay"></i>
                                    <span> Tableau de Bord </span>
                                </a>
                                
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="fab fa-accessible-icon "></i>
                                    <span> Patients </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('patients/add-patient') }}">Enregistrer un Patient</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('patients/all-patient') }}">Voir les Patients</a>
                                    </li>

                                    @if (Auth::user()->role == "admin")       
                                    <li>
                                        <a href="{{ url('patients/manage-patient') }}">Gérer les Patients</a>
                                    </li>
                                    @endif

                                    <hr>
                                    <li>
                                        <a href="{{ url('patients/free-patient') }}">Patients liberé(e)s</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('patients/transfer-patient') }}">Transferts de Patients</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-doctor"></i>
                                    <span> Employées </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('employees/add-employee') }}">Ajouter un Employé(e)</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('employees/all-employee') }}">Voir les Employees</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('employees/manage-employee') }}">Gérer les Employé(e)s</a>
                                    </li>
                                    <hr>
                                    <li>
                                        <a href="{{ url('employees/depart-employee') }}">Assigner un Departement</a>
                                    </li>
                                </ul> 
                            </li>


                            
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-pill"></i>
                                    <span> Pharmacie </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">

                                    {{-- pour cette partie seul le Dr et les pharmaciens --}}
                                    @if(Auth::user()->role == "admin" || Auth::user()->role == "pharmacie")

                                        <li>
                                            <a href="{{ url('catProducts/add-catProduct') }}">Ajouter une Catégorie de Prod</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('catProducts/all-catProduct') }}">Voir les Catégories de Prod</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('category.manage') }}">Gérer les Catégories de Prod</a>
                                        </li>
                                        <hr>
                                        <li>
                                            <a href="{{ url('products/add-product') }}">Ajouter un Produit</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('products/all-product') }}">Voir les Produits</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('products/manage-product') }}">Gérer les Produits</a>
                                        </li>
                                        <hr>
                                    @endif


                                    {{-- pour cette partie seul le Dr et les medecin --}}
                                    @if(Auth::user()->role == "admin" || Auth::user()->role == "doctor")
                                    <li>
                                        <a href="{{ url('prescriptions/add-prescription') }}">Ajouter une ordonnance</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('prescriptions/all-prescription') }}">Voir les ordonnances</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('prescriptions/manage-prescription') }}">Gérer les ordonnances</a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                            

                            @if(Auth::user()->role == "admin" || Auth::user()->role == "comptable")
                            {{-- Pour la comptabilité seul les comptables et le Dr y ont acces --}}
                            {{-- <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-cash-multiple "></i>
                                    <span> Comptabilité </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('accounting/add-accountPay') }}">Ajouter un Compte à Payer</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('accounting/manage-accountPay') }}">Gérer les les Comptes à Payer</a>
                                    </li>
                                    <hr>
                                    <li>
                                        <a href="{{ url('accounting/add-accountRecev') }}">Ajouter une Créance</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('accounting/manage-accountRecev') }}">Gérer les Débiteurs</a>
                                    </li>
                                    <hr>
                                    
                                    
                                </ul>
                            </li> --}}

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-cash-refund "></i>
                                    <span> Masse salariale </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('payroll/add-payroll', []) }}">Ajouter la paie</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('payroll/manage-payroll', []) }}">Gérer les bulletins de salaire</a>
                                    </li>
                                </ul>
                            </li>
                            @endif

                            @if (Auth::user()->role == "admin")
                            <li>
                                <a href="javascript: void(0);">
                                    <i class=" fas fa-funnel-dollar "></i>
                                    <span> Inventaire </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                   
                                    <li>
                                        <a href="{{ url('inventory/inventory-product') }}">Produits Pharmaceutiques</a>
                                    </li>

                                    <li>
                                        <a href="{{ url('inventory/inventory-asset') }}">Equipements</a>
                                    </li>
                                    
                                </ul>
                            </li>
                            @endif
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="fe-share"></i>
                                    <span> Rapports </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('record/record-inPatient') }}">Dossiers d'Hospitalisation</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('record/record-outPatient') }}">Dossiers Ambilatoire</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('record/record-employee') }}">Dossiers des Employés</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('record/record-product') }}">Dossiers Pharmaceutiques</a>
                                    </li>
                                    {{-- <li>
                                        <a href="{{ url('record/record-account') }}">Comptabilité</a>
                                    </li> --}}
                                    <li>
                                        <a href="{{ url('record/record-medical') }}">Dossiers Médicaux</a>
                                    </li>
                                    
                                </ul>
                            </li>
                            @if(Auth::user()->role == "admin" || Auth::user()->role == "doctor")
                            {{-- <li>
                                <a href="javascript: void(0);">
                                    <i class="fe-file-text"></i>
                                    <span> Dossiers Médicaux </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('record/add-record', []) }}">Ajouter un Dossier Médical</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('record/manage-record', []) }}">Gérer les Dossiers Médicaux</a>
                                    </li>
                                </ul>
                            </li> --}}

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-flask"></i>
                                    <span> Laboratoire </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('laboratory/lab-patient-test', []) }}">Tests de labo des patients</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('laboratory/lab-patient-result', []) }}">Résultats de labo des patients</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('laboratory/lab-patient-vital', []) }}"> Signes vitaux du patient </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('laboratory/lab-employee-vital', []) }}"> Signes vitaux des employés </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('laboratory/lab-report', []) }}"> Rapports de laboratoire</a>
                                    </li>
                                    <hr>
                                    <li>
                                        <a href="{{ url('laboratory/add-laboratory-equipement', []) }}">Ajouter un  Equiepment de Labo</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('laboratory/manage-laboratory-equipement', []) }}">Gérer les Equipements du Labo</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-scissors-cutting "></i>
                                    <span>  Chirurgie / Bloc opératoire </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('bloc/add-equipement', []) }}">Ajouter un équipement</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('bloc/manage-equipement', []) }}">Gérer les équipements</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('bloc/add-patient', []) }}">Ajouter un patient</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('bloc/manage-patient', []) }}">Gérer les patients</a>
                                    </li>

                                    <li>
                                        <a href="{{ url('bloc/bloc-record', []) }}">Dossiers chirugicaux</a>
                                    </li>
                                </ul>
                            </li>
                            @endif

                            @if(Auth::user()->role == "admin")
                            {{-- Pour cette partie seul l'admin y a acces --}}

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="fas fa-user-tag"></i>
                                    <span> Fournisseurs </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('vendor/add-vendor', []) }}">Ajouter un Fournisseur</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('vendor/manage-vendor', []) }}">Gérer les Fournisseurs</a>
                                    </li>
                                    
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="fas fa-lock"></i>
                                    <span> Gestion des utilisateurs </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="{{ route('addUser') }}">Ajouter un utilisateur</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('users/manage-user', []) }}">Gérer les utilisateurs</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('password/manage-password-reset', []) }}">Gérer</a>
                                    </li>                                                                        
                                </ul>
                            </li>
                            @endif
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>           
             <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                    {{-- debut contenu --}}
                    @yield('content')
                    {{-- fin contenu --}}

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                2024 &copy; Clinique Dr. Dramé Management
                            </div>

                        </div>
                    </div>
                </footer>                
                <!-- end Footer -->

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->



        </div>
        <!-- END wrapper -->

        {{-- <!-- Right Sidebar -->
        <div class="right-bar">
            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i class="dripicons-cross noti-icon"></i>
                </a>
                <h5 class="m-0 text-white">Paramètres</h5>
            </div>
            <div class="slimscroll-menu">
                <!-- User box -->
                <div class="user-box">
                    <div class="user-img">
                        <img src="assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-fluid">
                        <a href="javascript:void(0);" class="user-edit"><i class="mdi mdi-pencil"></i></a>
                    </div>
            
                    <h5><a href="javascript: void(0);">Geneva Kennedy</a> </h5>
                    <p class="text-muted mb-0"><small>Admin Head</small></p>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <h5 class="pl-3">Basic Settings</h5>
                <hr class="mb-0" />

                <div class="p-3">
                    <div class="checkbox checkbox-primary mb-2">
                        <input id="Rcheckbox1" type="checkbox" checked>
                        <label for="Rcheckbox1">
                            Notifications
                        </label>
                    </div>
                    <div class="checkbox checkbox-primary mb-2">
                        <input id="Rcheckbox2" type="checkbox" checked>
                        <label for="Rcheckbox2">
                            API Access
                        </label>
                    </div>
                    <div class="checkbox checkbox-primary mb-2">
                        <input id="Rcheckbox3" type="checkbox">
                        <label for="Rcheckbox3">
                            Auto Updates
                        </label>
                    </div>
                    <div class="checkbox checkbox-primary mb-2">
                        <input id="Rcheckbox4" type="checkbox" checked>
                        <label for="Rcheckbox4">
                            Online Status
                        </label>
                    </div>
                    <div class="checkbox checkbox-primary mb-0">
                        <input id="Rcheckbox5" type="checkbox" checked>
                        <label for="Rcheckbox5">
                            Auto Payout
                        </label>
                    </div>
                </div>

                <!-- Timeline -->
                <hr class="mt-0" />
                <h5 class="px-3">Messages <span class="float-right badge badge-pill badge-danger">25</span></h5>
                <hr class="mb-0" />
                <div class="p-3">
                    <div class="inbox-widget">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/user-2.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Tomaslau</a></p>
                            <p class="inbox-item-text">I've finished it! See you so...</p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/user-3.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Stillnotdavid</a></p>
                            <p class="inbox-item-text">This theme is awesome!</p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/user-4.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Kurafire</a></p>
                            <p class="inbox-item-text">Nice to meet you</p>
                        </div>

                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/user-5.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Shahedk</a></p>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/user-6.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Adhamdannaway</a></p>
                            <p class="inbox-item-text">This theme is awesome!</p>
                        </div>
                    </div> <!-- end inbox-widget -->
                </div> <!-- end .p-3-->

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar --> --}}

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="{{asset('backend/assets/js/vendor.min.js')}}"></script>

        <!-- App js très important pour le left side bar-->
        <script src="{{asset('backend/assets/js/app.min.js')}}"></script>

        <!-- Plugins js-->
        <script src="{{asset('backend/assets/libs/flatpickr/flatpickr.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/jquery-knob/jquery.knob.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/flot-charts/jquery.flot.js')}}"></script>
        <script src="{{asset('backend/assets/libs/flot-charts/jquery.flot.time.js')}}"></script>
        <script src="{{asset('backend/assets/libs/flot-charts/jquery.flot.tooltip.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/flot-charts/jquery.flot.selection.js')}}"></script>
        <script src="{{asset('backend/assets/libs/flot-charts/jquery.flot.crosshair.js')}}"></script>

        @yield('javascript')
        
    </body>

</html>