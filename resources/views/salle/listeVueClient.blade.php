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
    @include('partials.sidebarClient')
    <!-- Content Wrapper -->
    <div id="" class="d-flex flex-column w-100">

        <!-- Main Content -->
        <div id="content" class="p-4">

            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Salle de fête EMMANUEL</h1>

                <!-- DataTables Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Liste des salles</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Salle</th>
                                        <th>Photo</th>
                                        <th>Tarif</th>
                                        <th>Accueil</th>
                                        <th>Équipement</th>
                                        <th>Statut</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salles as $salle)
                                        <tr>
                                            <td>{{ $salle->id }}</td>
                                            <td>{{ $salle->salle }}</td>
                                            <td>
                                                @if($salle->photo)
                                                    <img src="{{ asset($salle->photo) }}" alt="photo" width="100">
                                                @else
                                                    Aucune
                                                @endif
                                            </td>
                                            <td>{{ $salle->tarif }}</td>
                                            <td>{{ $salle->accueil }}</td>
                                            <td>{{ $salle->equipement }}</td>
                                            <td>{{ $salle->statut }}</td>
                                            
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
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

</body>
</html>  