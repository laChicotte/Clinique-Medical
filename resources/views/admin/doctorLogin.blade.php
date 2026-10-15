<!DOCTYPE html>
<html lang="fr">
    
<head>
        <meta charset="utf-8" />
        <title>Connexion Docteur</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="MartDevelopers" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}">

        <!-- App css -->
        <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
        <!--Load Sweet Alert Javascript-->

        <script src="{{asset('backend/assets/js/swal.js')}}"></script>
        <!--Inject SWAL-->

    </head>

    <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <a href="{{ url('/') }}">
                                        <span><img src="{{asset('backend/assets/images/logo-dark.png')}}" alt="" height="22"></span>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Entrer votre email et votre mot de passe pour vous connecter.</p>
                                </div>

                                <form method='post' >

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Email du Médecin</label>
                                        <input class="form-control" name="doc_number" type="text" id="emailaddress" required="" placeholder="Enter your doctor number">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Mot de passe</label>
                                        <input class="form-control" name="doc_pwd" type="password" required="" id="password" placeholder="Enter your password">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" name="doc_login" type="submit"> Se Connecter </button>
                                    </div>

                                </form>

                               

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="his_doc_pwd_reset.php" class="text-white-50 ml-1">Mot de passe oublié?</a></p>
                               <!-- <p class="text-white-50">Don't have an account? <a href="his_admin_register.php" class="text-white ml-1"><b>Sign Up</b></a></p>-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <footer class="footer footer-alt">
            2020 - 2024 &copy; GUEZZ <a href="#" target="_blank" class="text-white-50">Dev</a>
        </footer>
        <!-- Vendor js -->
        <script src="{{asset('backend/assets/js/vendor.min.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('backend/assets/js/app.min.js')}}"></script>
        
    </body>

</html>