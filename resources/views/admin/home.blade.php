<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Accuiel Dr. Dramé</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('frontend/assets/images/logo/favicon.png')}}" type="image/x-icon">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/animate-3.7.0.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/font-awesome-4.7.0.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap-4.1.3.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/owl-carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/jquery.datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/style.css')}}">

</head>
<body>
    <!-- Preloader Starts -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Preloader End -->

    <!-- Header Area Starts -->
    <header class="header-area">
        <div id="header" id="home">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="{{ url('/')}}"></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="{{ url('/')}}">Accueil</a></li>
                        <li><a href="{{ url('/doctor-login') }}">Docteur</a></li>
                        <li><a href="{{ url('/admin-login') }}">Administrateur</a></li>
                    </ul>
                </nav><!-- #nav-menu-container -->		    		
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->

    <!-- Banner Area Starts -->
    <section class="banner-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h4>Prendre soin d'une meilleure vie</h4>
                    <h1>Clinique Dr. Dramé, une réference pour l'excellence médicale</h1>
                    <p>          
                        Explorez la plateforme exclusive de la Clinique Dr Dramé ! 
                        Connectez-vous pour accéder à des fonctionnalités avancées et gérer efficacement 
                        les opérations médicales et administratives. Bienvenue dans notre espace sécurisé et intuitif. 
                        Ensemble, faisons avancer les soins de santé.
                    </p>
                </div>
            </div>
        </div>
    </section>

   


        <!-- Javascript -->
    <script src="{{asset('frontend/assets/js/vendor/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/bootstrap-4.1.3.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/wow.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/owl-carousel.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/superfish.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/main.js')}}"></script>


</body>
</html>
