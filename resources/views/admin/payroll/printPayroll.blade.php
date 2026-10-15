@extends('layouts.layout')  

@section('titre')
Gérer les Salaires
@endsection  

@section('content') 

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Paies</a></li>
                            <li class="breadcrumb-item active">Génerer les paies</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Fiche de Paie</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <!-- Logo & title -->
                    <div class="clearfix">
                        <div class="float-left">
                            <img src="{{asset('backend/assets/images/logo-dark.png')}}" alt="" height="20">
                        </div>
                        <div class="float-right">
                            <h4 class="m-0 d-print-none">{{$payroll->employee->doc_fname.' '.$payroll->employee->doc_lname}}</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mt-3">
                                <p><b></b></p>
                                <p class="text-muted"></p>
                            </div>
                        </div><!-- end col -->
                        <div class="col-md-4 offset-md-2">
                            <div class="mt-3 float-right">
                                <p class="m-b-10"><strong>Mois et Année : </strong> <span class="float-right">&nbsp; {{ date('F Y', mktime(0, 0, 0, $payroll->pay_month, 1, $payroll->pay_year)) }}</span></p>
                                <p class="m-b-10"><strong>Génerer le  : </strong> <span class="float-right"> &nbsp;&nbsp;&nbsp;&nbsp; {{$payroll->created_at->format('d-m-Y')}} </span></p>
                                <p class="m-b-10"><strong>Etat de paie : </strong> <span class="float-right"><span class="badge badge-success">Payé</span></span></p>
                                <p class="m-b-10"><strong>Numéro de l'employé : </strong> <span class="float-right">N8TI0</span></p>
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->
                    <!-- end row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table mt-4 table-centered">
                                    <thead>
                                    <tr><th>#</th>
                                        <th>Département de l'employé</th>
                                        <th style="width: 10%">Salaire Brut</th>
                                        <th style="width: 10%">(PAYE)Taux</th>
                                        <th style="width: 10%" class="text-right">Total Taxes</th>
                                    </tr></thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>{{$payroll->employee->doc_dept}} </td>
                                            <td>GNF {{$payroll->pay_brut_salary}}</td>
                                            <td>{{((($payroll->pay_brut_salary - $payroll->pay_net_salary) / $payroll->pay_brut_salary) * 100)}} %</td>            
                                            <td class="text-right">GNF {{$payroll->pay_brut_salary - $payroll->pay_net_salary}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive -->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="clearfix pt-5">
                                <h3 class="text-muted">Le Directeur fondateur</h3>
                                <small class="text-muted">
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                </small>
                                <h3 class="text-muted">Imprimé à Conakry le </h3>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-sm-6">
                            <div class="float-right">
                                <p><b>Sub-total:</b> <span class="float-right">GNF {{$payroll->pay_brut_salary}}</span></p>
                                <p><b>PAYE Tax (16%) :</b> <span class="float-right"> &nbsp;&nbsp;&nbsp; {{$payroll->pay_brut_salary - $payroll->pay_net_salary}} </span></p>
                                <h3>GNF {{$payroll->pay_net_salary}}</h3>
                            </div>
                            <div class="clearfix"></div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="mt-4 mb-1">
                        <div class="text-right d-print-none">
                            <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-printer mr-1"></i>Imprimer</a>
                        </div>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
        <!-- end row --> 
        
    </div> <!-- container -->

</div> <!-- content -->


@endsection  

@section('javascript')  
<!-- Footable js -->
<script src="{{asset('backend/assets/libs/footable/footable.all.min.js')}}"></script>
<!-- Init js -->
<script src="{{asset('backend/assets/js/pages/foo-tables.init.js')}}"></script>
@endsection 
