<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une réservation</title>

    <!-- Fonts and styles -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/gerantstyle.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

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
            margin: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        h1 {
            text-align: center;
            color: #4e73df;
            margin-bottom: 30px;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
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
        input[type="time"],
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #f9f9f9;
        }

        input[readonly] {
            background-color: #e9ecef;
            color: #495057;
        }

        input[type="submit"] {
            background-color: #1cc88a;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: #17a673;
        }

        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
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
</head>
<body id="page-top">

<div id="wrapper" class="d-flex">
    
    
    <div class="d-flex flex-column w-100 p-4">
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-wrapper">
            <h1><i class="fas fa-edit"></i> Modifier une réservation</h1>

            <form method="POST" action="{{ route('handleReservationModifier', $reservation->id) }}">
                @csrf

                <div class="full-width">
                    <label for="user">Utilisateur :</label>
                    <input type="text" id="user" value="{{ $reservation->user->email }}" readonly>
                </div>

                <div class="full-width">
                    <label for="salle">Salle :</label>
                    <select id="salle" name="salle_id" required>
                        @foreach($salles as $salle)
                            <option value="{{ $salle->id }}" {{ $reservation->salle_id == $salle->id ? 'selected' : '' }}>
                                {{ $salle->salle }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="date_reservation">Date de réservation :</label>
                    <input type="date" id="date_reservation" name="date_reservation"
                           value="{{ $reservation->date_reservation }}" required>
                </div>

                <div>
                    <label for="heure_debut">Heure de début :</label>
                    <input type="time" id="heure_debut" name="heure_debut"
                           value="{{ $reservation->heure_debut }}" required>
                </div>

                <div>
                    <label for="heure_fin">Heure de fin :</label>
                    <input type="time" id="heure_fin" name="heure_fin"
                           value="{{ $reservation->heure_fin }}" required>
                </div>

                <div class="full-width">
                    <input type="submit" value="Mettre à jour la réservation">
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
