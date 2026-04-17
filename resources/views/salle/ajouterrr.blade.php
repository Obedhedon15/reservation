<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 60px;
        }
        form {
            max-width: 1000px;
            margin: auto;
            padding: 50px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="email"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
    <title>Dashboard</title>

    <!-- Fonts and styles -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/gerantstyle.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper" class="d-flex">

    {{-- Sidebar --}}
    @include('partials.sidebar')

    @if (Session::get('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <!-- Content Wrapper -->
    <div id="" class="d-flex flex-column w-100">

        <!-- Main Content -->
        <div id="content" class="p-4">

            <div class="">
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800"></h1>
               

                <!-- DataTables Example -->
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary"></h6>
                    </div>
                    <div class="card-body">
                         @if (Session::get('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                        

<form method="POST" action="{{ route('handleSalleAjouter') }}" enctype="multipart/form-data">
                    @csrf
    <label for="salle">Salle :</label>
    <input type="text" id="salle" name="salle" required>
    @error('salle')
                <div class="error">{{ $message }}</div>
            @enderror

    <label for="photo">Photo :</label>
    <input type="file" id="photo" name="photo" accept="image/*" required>

    <label for="tarif">Tarif :</label>
    <input type="text" id="tarif" name="tarif" required>

    <label for="acceuil">Acceuil :</label>
    <input type="text" id="aacueil" name="acceuil" required>

    <label for="equipement">Equipement :</label>
    <input type="text" id="equipement" name="equipement" required>

    <label for="staut">Statut :</label>
    <input type="text" id="statut" name="statut" required>

    

    <input type="submit" value="Ajouter Cette salle">
</form>

                    </div>
                </div>

            </div>

        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- JavaScript -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset ('vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="{{ asset ('js/sb-admin-2.min.js"></script>
<script src="{{ asset ('vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset ('vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset ('js/demo/datatables-demo.js"></script>

   