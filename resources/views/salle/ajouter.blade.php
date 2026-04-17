<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Salle</title>

    <!-- Styles personnalisés -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
            margin: 0;
            padding: 0;
        }

        .form-wrapper {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            margin: 30px;
            width: 100%;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #4e73df;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px 30px;
        }

        form .full-width {
            grid-column: 1 / -1;
        }

        label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #f9f9f9;
        }

        input[type="submit"] {
            background-color: #4e73df;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: #2e59d9;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        @media (max-width: 768px) {
            form {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <!-- FontAwesome & Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles Laravel -->
    <link href="{{ asset('css/gerantstyle.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">

<div id="wrapper" class="d-flex">
    
    {{-- Sidebar incluse --}}
    @include('partials.sidebar')

    <div class="d-flex flex-column w-100 p-4">
        <!-- Messages -->
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        @if (Session::get('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger full-width">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-wrapper">
            <h1><i class="fas fa-plus-circle"></i> Ajouter une Salle</h1>

            <form method="POST" action="{{ route('handleSalleAjouter') }}" enctype="multipart/form-data">
                @csrf

                <div>
                    <label for="salle">Nom de la Salle</label>
                    <input type="text" id="salle" name="salle" value="{{ old('salle') }}" required>
                    @error('salle') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="photo">Photo</label>
                    <input type="file" id="photo" name="photo" accept="image/*">
                    @error('photo') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="tarif">Tarif</label>
                    <input type="text" id="tarif" name="tarif" value="{{ old('tarif') }}" required>
                    @error('tarif') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="accueil">Capacité d'accueil</label>
                    <input type="number" id="accueil" name="accueil" value="{{ old('accueil') }}" min="1" required>
                    @error('accueil') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="full-width">
                    <label for="equipement">Équipement</label>
                    <input type="text" id="equipement" name="equipement" value="{{ old('equipement') }}" required>
                    @error('equipement') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="full-width">
                    <label for="statut">Statut</label>
                    <input type="text" id="statut" name="statut" value="{{ old('statut') }}">
                    @error('statut') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="full-width">
                    <input type="submit" value="Ajouter cette salle">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
</body>
</html>
