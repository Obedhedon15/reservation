<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Client</title>
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
            background: var(--bg-color);
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-card {
            background-color: var(--card-bg);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 100%;
            max-width: 450px;
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
            z-index: 2; /* S'assure que le champ est au-dessus de tout */
            position: relative;
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
            transition: background-color 0.3s ease, transform 0.2s ease;
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
            <div class="login-card mx-auto">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logoHopital.jpg') }}" alt="Logo" class="logo">
                    <h3 class="section-title">Connexion Client</h3>
                </div>

                @if (Session::get('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
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

                <form id="signup-form" method="POST" action="{{ route('handleUserLogin') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="email" class="form-label required">Adresse Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label required">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-custom w-100">Se connecter</button>
                </form>

                <div class="link-container">
                    <p class="mb-0 text-muted">
                        Vous n'avez pas de compte ? 
                        <a href="{{ route('user.register') }}">Inscrivez-vous ici</a>
                    </p>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>