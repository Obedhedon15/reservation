<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
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
    @include('partials.sidebarSec')
    <!-- Content Wrapper -->
    <div id="" class="d-flex flex-column w-100">

        <!-- Main Content -->
        <div id="content" class="p-4">

            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Salle de fete EMMANUEL</h1>
               

                <!-- DataTables Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Liste des reservations</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
    <tr>
        <th>Id</th>
        <th>Utilisateur</th>
        <th>Salle</th>
        <th>Date</th>
        <th>Heure début</th>
        <th>Heure fin</th>
        <th>Statut</th>
        <th>Actions</th> {{-- ✅ Nouvelle colonne --}}
    </tr>
</thead>
<tbody>
    @foreach ($reservations as $reservation)
        <tr>
            <td>{{ $reservation->id }}</td>
            <td>{{ $reservation->user->email }} {{ $reservation->user->prenom }}</td>
            <td>{{ $reservation->salle?->salle ?? 'Salle introuvable' }}</td>
       
            <td>{{ $reservation->date_reservation }}</td>
            <td>{{ $reservation->heure_debut }}</td>
            <td>{{ $reservation->heure_fin }}</td>
            <td>{{ $reservation->statut ?? 'Non défini' }}</td>
            <td>
                {{-- Lien vers l'édition --}}
                <a href="{{ route('reservation.valider', $reservation->id) }}" class="btn btn-sm btn-primary">Validerr</a>
                
                
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

   