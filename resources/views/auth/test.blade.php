<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Patient</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f2f7fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        .logo {
            width: 80px;
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #007bff;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 91, 187, 0.5);
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .section-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #007bff;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .required:after {
            content: "*";
            color: red;
            margin-left: 5px;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('images/logoHopital.jpg') }}" alt="Logo" class="logo">
                    <h3 class="section-title ml-3">Connexion Gerant</h3>
                </div>
@if (Session::get('error'))
<div class="alert alert-success">{{ Session::get('error')}}</div>
@endif
                <!-- Affichage des erreurs -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="signup-form" method="POST" action="{{ route('handleGerantLogin') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="email" class="required">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="motdepasse" class="required">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-custom btn-block">Soumettre</button>
                </form>
                
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>