<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste reservation</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #007bff;
            --primary-hover: #0056b3;
            --secondary-color: #f8f9fa;
            --text-color: #343a40;
            --heading-color: #495057;
            --card-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
        }

        .navbar {
            background-color: #fff;
            box-shadow: var(--card-shadow);
        }

        .sidebar {
            background-color: #343a40;
            color: #fff;
            min-height: 100vh;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            transition: color 0.3s;
        }

        .sidebar .nav-link:hover {
            color: #fff;
        }

        .page-title {
            color: var(--heading-color);
            font-weight: 700;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e9ecef;
            border-radius: 15px 15px 0 0;
        }

        .table thead th {
            border-bottom: 2px solid #dee2e6;
            background-color: #e9ecef;
            color: var(--heading-color);
        }

        .table-responsive {
            padding: 1rem;
        }

        .btn-action {
            border-radius: 8px;
            padding: 5px 12px;
            font-size: 0.875rem;
            margin-right: 5px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #c82333;
        }
        
        /* Sidebar et Navbar (exemples) */
        .topbar {
            background-color: #fff;
            box-shadow: var(--card-shadow);
        }
        .sidebar-brand-icon img {
            width: 40px;
            height: 40px;
        }

        /* Adjustments for a cleaner look */
        #dataTable_wrapper {
            padding: 0 1rem;
        }

    </style>
</head>
<body id="page-top">

<div id="wrapper">

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <h1 class="h3 m-0 page-title">Salle de fête EMMANUEL</h1>
            </nav>
            <div class="container-fluid">

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Mes reservations</h6>
                        </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Utilisateur</th>
                                        <th>Salle</th>
                                        <th>Date</th>
                                        <th>Heure début</th>
                                        <th>Heure fin</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservations as $reservation)
                                        <tr>
                                            <td>{{ $reservation->id }}</td>
                                            <td>{{ $reservation->user->email }}<br>({{ $reservation->user->prenom }} {{ $reservation->user->nom }})</td>
                                            <td>{{ $reservation->salle?->nom ?? 'Salle introuvable' }}</td>
                                            <td>{{ $reservation->date_reservation }}</td>
                                            <td>{{ \Carbon\Carbon::parse($reservation->heure_debut)->format('H:i') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($reservation->heure_fin)->format('H:i') }}</td>
                                            <td><span class="badge bg-{{ strtolower($reservation->statut) == 'confirmée' ? 'success' : 'warning' }}">{{ $reservation->statut ?? 'Non défini' }}</span></td>
                                            <td>
                                                <a href="{{ route('reservation.modifier', $reservation->id) }}" class="btn btn-sm btn-primary btn-action"><i class="fas fa-edit"></i> Modifier</a>
                                                
                                                <form action="{{ route('reservation.supprimer', $reservation->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger btn-action"><i class="fas fa-trash"></i> Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json"
            }
        });
    });
</script>

</body>
</html>