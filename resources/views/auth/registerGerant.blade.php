<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Médecin</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f4f8fc;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border-radius: 16px;
            padding: 40px 30px;
            border: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .section-title {
            font-weight: 600;
            font-size: 2rem;
            color: #007bff;
            text-align: center;
            margin-bottom: 35px;
        }

        .form-group label {
            font-weight: 500;
            color: #333;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ced4da;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: #aab3bb;
            font-style: italic;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 12px;
            padding: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .required::after {
            content: "*";
            color: red;
            margin-left: 4px;
        }

        .alert {
            font-size: 0.9rem;
        }

        .form-row > .col-md-6 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <h3 class="section-title"><i class="fas fa-user"></i> Ajouter un secretaire</h3>

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

                <form method="POST" action="{{ route('handleSecretaireAjouter') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nom" class="required">Nom</label>
                            <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez le nom du secretaire" required>
                        </div>
                        
                    </div>

                    

                    
                        
                    

                    <div class="form-row">
                        
                        <div class="form-group col-md-6">
                            <label for="email" class="required">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="exemple@email.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="required">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Créez un mot de passe sécurisé" required>
                    </div>

                    <button type="submit" class="btn btn-custom btn-block">
                        <i class="fas fa-user-plus"></i> Ajouter le secretaire
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>
