@extends('layouts.layout')  

@section('titre')  
Editer Produit
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
                            <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pharmaceuticals</a></li>
                            <li class="breadcrumb-item active">Manage Pharmaceutical</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Update #{{ $product->phar_bcode}} - {{ $product->phar_name}}</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Modifier les champs</h4>
                        <!--Add Patient Form-->
                        <form method="post" action="{{ route('product.update', ['id' => $product->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Nom du Produit</label>
                                    <input type="text" required="required" value="{{ $product->phar_name}}" name="phar_name" class="form-control" id="inputEmail4" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4" class="col-form-label">Quantité du Produit(Cartons)</label>
                                    <input required="required" type="text" value="{{ $product->phar_qty}}" name="phar_qty" class="form-control"  id="inputPassword4">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputState" class="col-form-label">Catégorie du Produit</label>
                                    <select id="inputState" required="required" name="category_id" class="form-control">
                                        <option value="{{$product->category_id}}">{{$product->category->pharm_cat_name}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->pharm_cat_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputPassword4" class="col-form-label">Code Barre</label>
                                    <input required="required" type="text" value="{{ $product->phar_bcode}}" name="phar_bcode" class="form-control"  id="inputPassword4">
                                </div>                              
                            </div>
                            <div class="form-group">
                                <label for="inputAddress" class="col-form-label">Pharmaceutical Description</label>
                                <textarea required="required"  type="text" class="form-control" name="phar_desc" id="editor">
                                  {!! $product->phar_desc !!}
                                </textarea>
                            </div>
                            
                        <button type="submit" class="ladda-button btn btn-warning" data-style="expand-right">Mettre à jour</button>

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


