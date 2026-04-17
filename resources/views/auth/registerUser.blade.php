<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Client</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #007bff;
            --primary-hover: #0056b3;
            --text-color: #495057;
            --link-color: #007bff;
            --bg-color: #f0f2f5;
            --card-bg: #ffffff;
            --border-color: #ced4da;
            --input-focus-shadow: rgba(0, 123, 255, 0.25);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }

        .signup-card {
            background-color: var(--card-bg);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 100%;
            max-width: 600px; /* Augmentation de la largeur pour un formulaire plus long */
            z-index: 1;
        }

        .logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-color);
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem var(--input-focus-shadow);
        }

        .btn-custom {
            background-color: var(--primary-color);
            color: white;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        
        .btn-custom:hover {
            background-color: var(--primary-hover);
        }
        
        .link-container {
            margin-top: 1rem;
            text-align: center;
        }
        
        .link-container a {
            color: var(--link-color);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .link-container a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        
        .required::after {
            content: " *";
            color: red;
            font-weight: normal;
        }
        
        .alert {
            border-radius: 10px;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="signup-card mx-auto">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logoHopital.jpg') }}" alt="Logo" class="logo">
                    <h3 class="section-title">Inscription Client</h3>
                    <p class="text-muted">Créez votre compte pour réserver une salle.</p>
                </div>

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

                <form id="signup-form" method="POST" action="{{ route('handleUserAjouter') }}">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nom" class="form-label required">Nom</label>
                            <input type="text" class="form-control" name="nom" id="nom" required>
                        </div>
                        <div class="col-md-6">
                            <label for="prenom" class="form-label required">Prénom</label>
                            <input type="text" class="form-control" name="prenom" id="prenom" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="telephone" class="form-label required">Téléphone</label>
                        <input type="tel" class="form-control" name="telephone" id="telephone" required>
                    </div>

                    <div class="mb-3">
                        <label for="adresse" class="form-label required">Adresse</label>
                        <input type="text" class="form-control" name="adresse" id="adresse" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label required">Adresse Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label required">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    
                    <button type="submit" class="btn btn-custom w-100">S'inscrire</button>
                </form>
                
                
                
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>