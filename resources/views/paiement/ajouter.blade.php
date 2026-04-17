<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver la salle "{{ $salle->salle }}"</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4A90E2;
            --primary-hover: #357ABD;
            --bg-color: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            --card-bg: #ffffff;
            --text-color: #2c3e50;
            --border-color: #e0e6ed;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--bg-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .reservation-card {
            background-color: var(--card-bg);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: var(--shadow);
            max-width: 650px;
            width: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .reservation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        h2 {
            color: var(--primary-color);
            font-weight: 700;
            text-align: center;
            margin-bottom: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            font-size: 2rem;
        }
        
        .form-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }
        
        .form-label i {
            color: var(--primary-color);
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 14px 20px;
            border: 1px solid var(--border-color);
            background-color: #f9fbfd;
            color: var(--text-color);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            background-color: #ffffff;
            box-shadow: 0 4px 15px rgba(74, 144, 226, 0.2);
            outline: none;
        }
        
        .form-control::placeholder {
            color: #95a5a6;
        }

        .btn-submit {
            background: var(--primary-color);
            color: #fff;
            border-radius: 12px;
            padding: 15px;
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border: none;
            width: 100%;
            text-transform: uppercase;
        }

        .btn-submit:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .alert {
            border-radius: 10px;
            font-weight: 500;
            margin-bottom: 1.5rem;
            border: none;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 5px solid #d9534f;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 5px solid #5cb85c;
        }
        
    </style>
</head>
<body>

<div class="container">
    <div class="reservation-card mx-auto">
        <h2><i class="fas fa-calendar-alt"></i> Réserver la salle "{{ $salle->salle }}"</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('paiements.handleAjouter') }}">
            @csrf
            
            <div class="mb-4">
                <label for="user_display" class="form-label">
                    <i class="fas fa-user"></i> Utilisateur
                </label>
                <input type="text" id="name" class="form-control" value="{{ Auth::user()->nom }} {{ Auth::user()->prenom }}" readonly>
                <input type="hidden" name="name" value="{{ Auth::user()->nom }} {{ Auth::user()->prenom }}">
            </div>
            
            <input type="hidden" name="salle_id" value="{{ $salle->id }}">

            <div class="mb-4">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope"></i> Adresse email
                </label>
                <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email ?? '' }}" required>
            </div>
            
            <div class="mb-4">
                <label for="phone" class="form-label">
                    <i class="fas fa-phone"></i> Téléphone
                </label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Ex: 2250700000000" required>
            </div>
            
            <div class="mb-4">
                <label for="date" class="form-label">
                    <i class="fas fa-calendar-check"></i> Date de réservation
                </label>
                <input type="date" name="date" id="date" class="form-control" min="{{ date('Y-m-d') }}" required>
            </div>
            
            <div class="mb-4">
                <label for="montant_affiche" class="form-label">
                    <i class="fas fa-money-bill-wave"></i> Montant (XOF)
                </label>
                <input type="text" id="montant_affiche" class="form-control" value="{{ number_format($salle->tarif, 0, ',', ' ') }} XOF" readonly>
                <input type="hidden" name="montant" value="{{ $salle->tarif }}">
            </div>
            
            <button type="submit" class="btn-submit">
                Payer & Réserver
            </button>
            
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>