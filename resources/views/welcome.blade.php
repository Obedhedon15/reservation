<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event SERVICE</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Lora:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">

    <style>
        :root {
            --primary-color: #2c3e50;    /* Dark Blue-Gray */
            --secondary-color: #f39c12; /* A warm orange accent */
            --text-color: #555;
            --light-bg: #f8f9fa;
            --white-color: #ffffff;
            --border-color: #e0e0e0;
            --card-bg: #fff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            background-color: var(--light-bg);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Lora', serif;
            color: var(--primary-color);
            font-weight: 700;
        }

        /* Navbar Styling */
        .navbar {
            background-color: var(--white-color);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        .navbar-brand {
            font-family: 'Lora', serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--primary-color) !important;
        }
        .nav-link {
            font-weight: 600;
            color: var(--primary-color) !important;
            transition: color 0.3s ease;
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--secondary-color);
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 70%;
        }
        .btn-custom {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: var(--primary-color);
            color: var(--white-color);
        }

        /* Hero Section */
        .hero-section {
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1549488349-e09b1f558a8a?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white-color);
            text-align: center;
            position: relative;
        }
        .hero-content h1 {
            font-size: 4.5rem;
            color: var(--white-color);
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            animation: fadeInDown 1s ease-out;
        }
        .hero-content p {
            font-size: 1.4rem;
            max-width: 700px;
            margin: 0 auto 2rem;
            animation: fadeInUp 1s ease-out;
        }
        .btn-primary-custom {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: var(--white-color);
            border-radius: 50px;
            padding: 12px 30px;
            font-size: 1.1rem;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
            animation: zoomIn 1s ease-out;
        }
        .btn-primary-custom:hover {
            background-color: #e67e22; /* A slightly darker shade */
            border-color: #e67e22;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(243, 156, 18, 0.4);
        }

        /* General Section Styling */
        .section-title {
            font-size: 3rem;
            text-align: center;
            margin-bottom: 5rem;
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
            background-color: var(--secondary-color);
            border-radius: 2px;
        }
        .py-5 { padding-top: 5rem !important; padding-bottom: 5rem !important; }

        /* About Section */
        .about-section {
            background-color: var(--white-color);
        }
        .about-section p {
            font-size: 1.1rem;
            max-width: 900px;
            margin: 0 auto;
            color: var(--text-color);
        }

        /* Halls Section */
        #salles .card {
            border: none;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: var(--card-bg);
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        #salles .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        #salles .card-img-top {
            height: 280px;
            object-fit: cover;
        }
        #salles .card-body {
            padding: 2rem;
            flex-grow: 1;
        }
        #salles .card-title {
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }
        #salles .card-text {
            color: var(--text-color);
            font-weight: 300;
        }
        #salles .card-text i {
            color: var(--secondary-color);
            width: 25px;
        }
        #salles .card .badge {
            font-weight: 600;
            padding: 0.5em 1em;
            border-radius: 50px;
        }
        .badge-success { background-color: #28a745; color: #fff; }
        .badge-danger { background-color: #dc3545; color: #fff; }
        .badge-warning { background-color: #ffc107; color: #212529; }
        .card-footer-custom {
            padding: 1.5rem 2rem;
            background-color: var(--light-bg);
            border-top: 1px solid var(--border-color);
            text-align: center;
        }

        /* Services Section */
        .services-section .service-box {
            background-color: var(--white-color);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            text-align: center;
        }
        .services-section .service-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        .services-section .service-box i {
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 25px;
            animation: bounceIn 1s ease-out;
        }
        .services-section .service-box h5 {
            font-size: 1.6rem;
            margin-bottom: 15px;
        }

        /* Testimonials Section */
        .testimonial-carousel {
            background-color: var(--primary-color);
            color: var(--white-color);
            padding: 5rem 0;
        }
        .testimonial-carousel .section-title {
            color: var(--white-color);
        }
        .testimonial {
            background-color: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 15px;
            padding: 2.5rem;
            font-style: italic;
            font-size: 1.1rem;
            position: relative;
            text-align: center;
            height: 100%;
        }
        .testimonial::before {
            content: '\f10d'; /* Font Awesome quote icon */
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 2.5rem;
            color: var(--secondary-color);
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0.3;
        }
        .testimonial p {
            margin: 0;
            font-size: 1.1rem;
        }
        .testimonial-author {
            margin-top: 1.5rem;
            font-weight: 600;
            font-style: normal;
        }
        .testimonial-author img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 3px solid var(--secondary-color);
            object-fit: cover;
            margin-bottom: 10px;
        }

        /* Contact Section */
        #contact .form-control {
            border-radius: 0.5rem;
            padding: 15px;
            border: 1px solid var(--border-color);
        }
        #contact .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(243, 156, 18, 0.25);
        }

        /* Footer */
        footer {
            background-color: var(--primary-color);
            color: var(--white-color);
            padding: 4rem 0 2rem;
            text-align: center;
        }
        footer .social-icons a {
            color: var(--white-color);
            font-size: 1.8rem;
            margin: 0 12px;
            transition: color 0.3s ease;
        }
        footer .social-icons a:hover {
            color: var(--secondary-color);
        }
        footer p {
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .hero-content h1 { font-size: 3rem; }
            .hero-content p { font-size: 1.2rem; }
            .section-title { font-size: 2.5rem; margin-bottom: 3rem; }
            .navbar-brand { font-size: 1.6rem; }
            .btn-custom { margin-top: 10px; }
            .navbar-nav { margin-top: 1rem; }
        }
        @media (max-width: 768px) {
            .hero-content h1 { font-size: 2.5rem; }
            .hero-content p { font-size: 1rem; }
            .section-title { font-size: 2rem; }
            .service-box { margin-bottom: 1.5rem; }
        }

        /* Scroll Animation (optional but recommended) */
        .animated {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .animated.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3">
        <div class="container">
            <a class="navbar-brand" href="#">Salle Event SERVICE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#about">À propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#salles">Salles</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
                <div class="d-flex">
                    <a href="{{ route('user.login') }}" class="btn btn-custom me-2">Client</a>
                    <a href="{{ route('gerant.login') }}" class="btn btn-custom">Gérant</a>
                    <a href="{{ route('admin.login') }}" class="btn btn-custom me-2">Admin</a>
                
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="hero-content text-center">
            <h1>Créez des souvenirs inoubliables</h1>
            <p class="lead">Découvrez la salle de fête EMMANUEL, le cadre parfait pour vos événements à Lubumbashi.</p>
            <a href="#salles" class="btn btn-primary-custom">Découvrir Nos Salles</a>
        </div>
    </section>

    <section id="about" class="py-5 about-section">
        <div class="container text-center">
            <h2 class="section-title animated">À propos de nous</h2>
            <p class="text-muted animated">
                Située au cœur de Lubumbashi, la **Salle EMMANUEL** est votre destination privilégiée pour tous vos événements mémorables. Que ce soit pour un **mariage de rêve**, une **conférence professionnelle**, un **anniversaire vibrant** ou toute autre célébration, notre équipe dévouée vous accompagne avec **professionnalisme et style**. Nous nous engageons à transformer vos visions en réalités exceptionnelles, en offrant des espaces élégants et des services sur mesure pour garantir le succès de chaque occasion.
            </p>
        </div>
    </section>

    <section id="salles" class="py-5">
        <div class="container">
            <h2 class="section-title animated">Nos salles</h2>
            <div class="row g-4">
                @if(isset($salles) && $salles->count() > 0)
                    @foreach ($salles as $salle)
                        <div class="col-md-6 col-lg-4 d-flex">
                            <div class="card h-100 animated">
                                <a href="{{ asset('storage/' . $salle->photo) }}" data-lightbox="salles-gallery" data-title="Salle {{ $salle->salle }}">
                                    @if($salle->photo)
                                        <img src="{{ asset('storage/' . $salle->photo) }}" class="card-img-top" alt="Salle {{ $salle->salle }}">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1579546950920-80d19f6a1529?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="Pas d'image">
                                    @endif
                                </a>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $salle->salle }}</h5>
                                    <p class="card-text"><i class="fas fa-users"></i> Capacité : **{{ $salle->accueil }}** personnes</p>
                                    <p class="card-text"><i class="fas fa-cogs"></i> Équipements : {{ $salle->equipement }}</p>
                                    <p class="card-text">
                                        Statut :
                                        <span class="badge badge-{{ $salle->statut == 'Disponible' ? 'success' : ($salle->statut == 'Occupé' ? 'danger' : 'warning') }}">{{ $salle->statut }}</span>
                                    </p>
                                    <p class="card-text fw-bold mt-auto"><i class="fas fa-money-bill-wave"></i> Prix : {{ number_format((float)$salle->tarif, 0, ',', ' ') }} USD</p>
                                </div>
                                
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center animated">
                        <p class="text-muted">Aucune salle disponible actuellement. <a href="#contact">Contactez-nous</a> pour plus d'informations.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section id="services" class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title animated">Nos services</h2>
            <div class="row text-center g-4">
                <div class="col-md-6 col-lg-4 d-flex">
                    <div class="service-box animated">
                        <i class="fas fa-chair"></i>
                        <h5>Mobilier Complet</h5>
                        <p>Nous fournissons tout le mobilier nécessaire, des chaises élégantes aux tables bien dressées, adaptés à votre thème et au nombre d'invités.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-flex">
                    <div class="service-box animated">
                        <i class="fas fa-microphone-alt"></i>
                        <h5>Sonorisation & Éclairage</h5>
                        <p>Profitez d'un système audio de haute qualité et d'un éclairage professionnel pour créer l'ambiance parfaite pour votre événement.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-flex">
                    <div class="service-box animated">
                        <i class="fas fa-parking"></i>
                        <h5>Parking Sécurisé</h5>
                        <p>Vos invités bénéficieront d'un parking spacieux et sécurisé sur place, pour une tranquillité d'esprit totale.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-flex">
                    <div class="service-box animated">
                        <i class="fas fa-utensils"></i>
                        <h5>Service Traiteur</h5>
                        <p>Des options de restauration exquises, adaptées à vos goûts et à votre budget, avec des menus personnalisés.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-flex">
                    <div class="service-box animated">
                        <i class="fas fa-palette"></i>
                        <h5>Décoration Personnalisée</h5>
                        <p>Notre équipe de décorateurs transforme l'espace selon vos souhaits, créant une atmosphère unique et mémorable.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-flex">
                    <div class="service-box animated">
                        <i class="fas fa-wifi"></i>
                        <h5>Connectivité Wi-Fi</h5>
                        <p>Accès Wi-Fi haut débit disponible dans toutes nos salles pour que vous et vos invités restiez connectés.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonials" class="testimonial-carousel">
        <div class="container">
            <h2 class="section-title animated">Ce que nos clients disent</h2>
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center">
                            <div class="col-lg-8">
                                <div class="testimonial animated">
                                    <p>"Un service exceptionnel et une salle magnifique ! Notre mariage fut un rêve devenu réalité grâce à l'équipe de la Salle EMMANUEL. Tout était parfait, de la décoration à la coordination."</p>
                                    <div class="testimonial-author">
                                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=2787&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Marie & Jean">
                                        <p><strong>Marie & Jean</strong><br><em>Mariés</em></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <div class="col-lg-8">
                                <div class="testimonial animated">
                                    <p>"L'organisation de notre conférence annuelle a été impeccable. La salle était parfaitement équipée et le support technique excellent. Nous reviendrons sans hésiter."</p>
                                    <div class="testimonial-author">
                                        <img src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Directeur Xyz Corp.">
                                        <p><strong>Directeur Xyz Corp.</strong><br><em>Conférence</em></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <div class="col-lg-8">
                                <div class="testimonial animated">
                                    <p>"J'ai célébré mon anniversaire à la Salle EMMANUEL et c'était inoubliable ! L'ambiance était festive et le personnel aux petits soins. Merci pour cette merveilleuse soirée !"</p>
                                    <div class="testimonial-author">
                                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=2788&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Sophie L.">
                                        <p><strong>Sophie L.</strong><br><em>Anniversaire</em></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <section id="contact" class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title animated">Contactez-nous</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8 animated">
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
            <div class="social-icons mb-4">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <p class="mb-0">&copy; 2025 Salle de fête EMMANUEL. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        // Scroll animation script
        document.addEventListener("DOMContentLoaded", function() {
            const animatedElements = document.querySelectorAll('.animated');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            animatedElements.forEach(element => {
                observer.observe(element);
            });
        });
    </script>
</body>
</html>