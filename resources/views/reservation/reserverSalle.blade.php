<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver la salless "{{ $salle->nom }}"</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #007bff;
            --primary-hover: #0056b3;
            --bg-color: #f0f2f5;
            --card-bg: #ffffff;
            --text-color: #495057;
            --border-color: #ced4da;
            --shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .reservation-card {
            background-color: var(--card-bg);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: var(--shadow);
            max-width: 600px;
            width: 100%;
        }

        h2 {
            color: var(--primary-color);
            font-weight: 700;
            text-align: center;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }

        label {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .btn-submit {
            background-color: var(--primary-color);
            color: #fff;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: background-color 0.3s ease;
            border: none;
            width: 100%;
        }

        .btn-submit:hover {
            background-color: var(--primary-hover);
        }

        .alert {
            border-radius: 10px;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
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
    <div class="mb-3">
                <label for="user_display" class="form-label">Utilisateur</label>
                <input type="text" id="name" class="form-control" value="{{ Auth::user()->nom }} {{ Auth::user()->prenom }}" readonly>
                <input type="hidden" name="name" value="{{ Auth::id() }}">
            </div>
    <input type="hidden" name="salle_id" value="{{ $salle->id }}">

   
    {{-- Email --}}
    <div class="mb-3">
        <label for="email" class="form-label">Adresse email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email ?? '' }}" required>
    </div>

    {{-- Téléphone --}}
    <div class="mb-3">
        <label for="phone" class="form-label">Téléphone</label>
        <input type="text" name="phone" id="phone" class="form-control" placeholder="Ex: 2250700000000" required>
    </div>

    {{-- Date de réservation --}}
    <div class="mb-3">
        <label for="date" class="form-label">Date de réservation</label>
        <input type="date" name="date" id="date" class="form-control" min="{{ date('Y-m-d') }}" required>
    </div>

    {{-- Montant --}}
    <div class="mb-3">
        <label for="montant" class="form-label">Montant (XOF)</label>
        <input type="number" id="montant" class="form-control" value="{{ $salle->tarif }}" readonly>
    </div>

    <button type="submit" class="btn-submit">Payer & Réserver</button>
</form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>