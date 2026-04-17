<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salle de fête EMMANUEL - Lubumbashi</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">

    <style>
        :root {
            --primary-purple: #8A2BE2; /* Amethyst / Royal Violet */
            --secondary-gold: #FFD700; /* Gold */
            --light-rose: #F8E7E7; /* Pale Rose */
            --dark-blue: #2c3e50; /* Dark Blue-Gray for footer */
            --text-color: #333;
            --light-bg: #f8f9fa;
        }

        body {
            font-family: 'Nunito', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            overflow-x: hidden; /* Prevent horizontal scroll */
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            color: var(--primary-purple);
        }

        .navbar {
            background-color: rgba(255,255,255,0.98);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .navbar-brand {
            color: var(--primary-purple) !important;
            font-weight: bold;
            font-size: 2rem;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .nav-link {
            color: var(--text-color) !important;
            font-weight: 600;
            margin-right: 15px;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-purple) !important;
        }

        .btn-custom-outline {
            border-color: var(--primary-purple);
            color: var(--primary-purple);
            border-radius: 50px;
            padding: 8px 20px;
            margin-left: 10px;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .btn-custom-outline:hover {
            background-color: var(--primary-purple);
            color: white;
        }

        .btn-primary-custom {
            background-color: var(--primary-purple);
            color: white;
            border-radius: 50px;
            padding: 12px 30px;
            font-size: 1.1rem;
            font-weight: 700;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(138, 43, 226, 0.3);
        }

        .btn-primary-custom:hover {
            background-color: #6a1aae; /* A slightly darker shade of purple */
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(138, 43, 226, 0.4);
        }

        .hero-section {
            height: 90vh;
            background: url('https://images.unsplash.com/photo-1549488349-e09b1f558a8a?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
            text-align: center;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.6);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 20px;
            animation: fadeIn 1.5s ease-out;
        }

        .hero-content h1 {
            font-size: 4rem;
            margin-bottom: 15px;
            color: white;
            animation: slideInLeft 1s ease-out;
        }

        .hero-content p {
            font-size: 1.5rem;
            color: var(--light-rose);
            animation: slideInRight 1s ease-out;
        }

        .section-title {
            font-size: 3rem;
            text-align: center;
            margin-bottom: 60px;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: var(--secondary-gold);
            border-radius: 2px;
        }

        .about-section p {
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
        }

        .card {
            border-radius: 0.75rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            overflow: hidden; /* Ensures border-radius applies to image */
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .card-body {
            padding: 25px;
        }

        .card-title {
            color: var(--primary-purple);
            font-size: 1.75rem;
            margin-bottom: 15px;
        }

        .card-text {
            color: #555;
            font-size: 1rem;
            margin-bottom: 8px;
        }

        .card-text .fas {
            color: var(--secondary-gold);
            margin-right: 8px;
        }

        .badge {
            font-size: 0.9em;
            padding: 0.5em 0.8em;
            border-radius: 5px;
            font-weight: 600;
        }

        .services-section .col-md-4 {
            padding: 30px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 30px;
        }
        
        .services-section .col-md-4:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .services-section .fas {
            font-size: 3rem;
            color: var(--primary-purple);
            margin-bottom: 20px;
            animation: bounceIn 1s ease-out;
        }

        .services-section h5 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .testimonial {
            font-style: italic;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            position: relative;
            border-left: 5px solid var(--secondary-gold);
        }

        .testimonial .blockquote-footer {
            margin-top: 15px;
            font-size: 0.9em;
            color: #777;
        }

        .testimonial .client-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--primary-purple);
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin-right: 15px;
            vertical-align: middle;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        #contact .form-control {
            border-radius: 0.5rem;
            padding: 12px 15px;
            border: 1px solid #ddd;
            transition: border-color 0.3s ease;
        }

        #contact .form-control:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 0.25rem rgba(138, 43, 226, 0.25);
        }

        footer {
            background-color: var(--dark-blue);
            color: white;
            padding: 40px 0;
            text-align: center;
        }

        footer .social-icons a {
            color: white;
            font-size: 1.5rem;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        footer .social-icons a:hover {
            color: var(--secondary-gold);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInLeft {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); opacity: 1; }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            .hero-content p {
                font-size: 1.2rem;
            }
            .section-title {
                font-size: 2rem;
            }
            .navbar-brand {
                font-size: 1.5rem;
            }
            .nav-link {
                margin-right: 0;
                text-align: center;
            }
            .btn-custom-outline {
                margin-left: 0;
                margin-top: 10px;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Salle EMMANUEL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#about">À propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#salles">Salles</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
                <div class="d-flex">
                    <a href="{{ route('user.login') }}" class="btn btn-custom-outline me-2">Connexion Client</a>
                    <a href="{{ route('secretaire.login') }}" class="btn btn-custom-outline me-2">Connexion Agent</a>
                    <a href="{{ route('gerant.login') }}" class="btn btn-custom-outline">Connexion Gérant</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="hero-content">
            <h1>Organisez votre événement parfait</h1>
            <p class="lead">Bienvenue à la salle de fête EMMANUEL, votre partenaire événementiel à Lubumbashi.</p>
            <a href="#salles" class="btn btn-primary-custom mt-4">Découvrir Nos Salles</a>
        </div>
    </section>

    <hr class="my-5">

    <section id="about" class="py-5 about-section">
        <div class="container">
            <h2 class="section-title">À propos de nous</h2>
            <p class="text-center text-muted">
                Située au cœur de Lubumbashi, la **Salle EMMANUEL** est votre destination privilégiée pour tous vos événements mémorables. Que ce soit pour un **mariage de rêve**, une **conférence professionnelle**, un **anniversaire vibrant** ou toute autre célébration, notre équipe dévouée vous accompagne avec **professionnalisme et style**. Nous nous engageons à transformer vos visions en réalités exceptionnelles, en offrant des espaces élégants et des services sur mesure pour garantir le succès de chaque occasion.
            </p>
        </div>
    </section>

    <hr class="my-5">
<section id="salles" class="py-5">
    <div class="container">
        <h2 class="section-title">Nos salles</h2>
        <div class="row">
            @if(isset($salles) && $salles->count() > 0)
                @foreach ($salles as $salle)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if($salle->photo)
                                <img src="{{ asset('storage/' . $salle->photo) }}" class="card-img-top" alt="Salle {{ $salle->salle }}">
                            @else
                                <img src="{{ asset('images/placeholder.jpg') }}" class="card-img-top" alt="Pas d'image">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $salle->salle }}</h5>
                                <p class="card-text"><i class="fas fa-users text-primary"></i> Capacité : {{ $salle->accueil }} personnes</p>
                                <p class="card-text"><i class="fas fa-cogs text-primary"></i> Équipements : {{ $salle->equipement }}</p>
                                <p class="card-text text-primary font-weight-bold"><i class="fas fa-money-bill-wave"></i> {{ number_format((float)$salle->tarif, 0, ',', ' ') }} USD</p>
                                <p class="card-text">Statut :
                                    <span class="badge badge-{{ $salle->statut == 'Disponible' ? 'success' : ($salle->statut == 'Occupé' ? 'danger' : 'warning') }}">
                                        {{ $salle->statut }}
                                    </span>
                                </p>
                                <a href="{{ route('reservation.salle', $salle->id) }}" class="btn btn-primary-custom mt-auto">Réserver</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <p class="text-muted">Aucune salle disponible actuellementttt. <a href="#contact">Contactez-nous</a>.</p>
                </div>
            @endif
        </div>
    </div>
</section>


    <hr class="my-5">

    <section id="services" class="py-5 services-section">
        <div class="container">
            <h2 class="section-title">Nos services</h2>
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <i class="fas fa-chair fa-2x mb-3"></i>
                    <h5>Mobilier Complet</h5>
                    <p>Nous fournissons tout le mobilier nécessaire, des chaises élégantes aux tables bien dressées, adaptés à votre thème et au nombre d'invités.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="fas fa-microphone fa-2x mb-3"></i>
                    <h5>Sonorisation & Éclairage</h5>
                    <p>Profitez d'un système audio de haute qualité et d'un éclairage professionnel pour créer l'ambiance parfaite pour votre événement.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="fas fa-parking fa-2x mb-3"></i>
                    <h5>Parking Sécurisé</h5>
                    <p>Vos invités bénéficieront d'un parking spacieux et sécurisé sur place, pour une tranquillité d'esprit totale.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="fas fa-utensils fa-2x mb-3"></i>
                    <h5>Service Traiteur</h5>
                    <p>Des options de restauration exquises, adaptées à vos goûts et à votre budget, avec des menus personnalisés.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="fas fa-hand-holding-heart fa-2x mb-3"></i>
                    <h5>Décoration Personnalisée</h5>
                    <p>Notre équipe de décorateurs transforme l'espace selon vos souhaits, créant une atmosphère unique et mémorable.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="fas fa-wifi fa-2x mb-3"></i>
                    <h5>Connectivité Wi-Fi</h5>
                    <p>Accès Wi-Fi haut débit disponible dans toutes nos salles pour que vous et vos invités restiez connectés.</p>
                </div>
            </div>
        </div>
    </section>

    <hr class="my-5">

    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">Témoignages</h2>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial">
                        <div class="d-flex align-items-center mb-3">
                            <div class="client-avatar">M J</div>
                            <div>
                                <strong>Marie & Jean</strong>
                            </div>
                        </div>
                        "Un service exceptionnel et une salle magnifique ! Notre mariage fut un rêve devenu réalité grâce à l'équipe de la Salle EMMANUEL. Tout était parfait, de la décoration à la coordination."
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial">
                        <div class="d-flex align-items-center mb-3">
                            <div class="client-avatar">D X</div>
                            <div>
                                <strong>Directeur Xyz Corp.</strong>
                            </div>
                        </div>
                        "L'organisation de notre conférence annuelle a été impeccable. La salle était parfaitement équipée et le support technique excellent. Nous reviendrons sans hésiter."
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial">
                        <div class="d-flex align-items-center mb-3">
                            <div class="client-avatar">S L</div>
                            <div>
                                <strong>Sophie L.</strong>
                            </div>
                        </div>
                        "J'ai célébré mon anniversaire à la Salle EMMANUEL et c'était inoubliable ! L'ambiance était festive et le personnel aux petits soins. Merci pour cette merveilleuse soirée !"
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="my-5">

    <section id="contact" class="py-5">
        <div class="container">
            <h2 class="section-title">Contactez-nous</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <p class="text-center text-muted mb-5">
                        Vous avez des questions ou souhaitez réserver une salle ? Remplissez le formulaire ci-dessous et notre équipe vous contactera dans les plus brefs délais.
                    </p>
                    <form>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Nom complet" aria-label="Nom complet" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Adresse email" aria-label="Adresse email" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <input type="text" class="form-control" placeholder="Sujet de votre message" aria-label="Sujet" required>
                        </div>
                        <div class="mb-4">
                            <textarea class="form-control" rows="6" placeholder="Votre message" aria-label="Votre message" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary-custom">Envoyer votre message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5">
        <div class="container">
            <div class="social-icons mb-3">
                <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <p class="mb-0">&copy; 2025 Salle de fête EMMANUEL. Tous droits réservés.</p>
            <p class="small text-muted mt-2">Design et développement par [Votre Nom/Agence]</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</body>
</html>