<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ISI BURGER | Accueil</title>
  
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('storage/assets/dashboard/img/burger-icon.png') }}" type="image/x-icon">
  
  <!-- Custom styles -->
  <link rel="stylesheet" href="{{ asset('storage/assets/dashboard/css/style.min.css') }}">
  <link rel="stylesheet" href="{{ asset('storage/assets/dashboard/css/style.css') }}">

  <!-- Feather Icons -->
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

  <style>
    /* Style général */
    body {
      font-family: Arial, sans-serif;
      background: #f8f9fa;
      color: #333;
      margin: 0;
      padding: 0;
    }

    /* Navigation */
    .main-nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      background: white;
      position: fixed;
      width: 100%;
      top: 0;
      left: 0;
      z-index: 1000;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .logo-text {
      font-size: 24px;
      font-weight: bold;
      text-transform: uppercase;
      display: flex;
      align-items: center;
    }
    .logo-text span {
      display: block;
      padding: 5px 8px;
      font-size: 26px;
    }
    .logo-text .isi {
      color: blue;
    }
    .logo-text .burger {
      color: white;
      background: blue;
      border-radius: 5px;
    }

    /* Boutons alignés horizontalement */
    .buttons {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .buttons a {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 10px 15px;
      border-radius: 6px;
      font-size: 1rem;
      text-decoration: none;
      transition: all 0.3s;
      text-align: center;
    }
    .btn-primary {
      background: blue;
      color: white;
    }
    .btn-primary:hover {
      background: darkblue;
    }
    .btn-secondary {
      background: white;
      color: blue;
      border: 2px solid blue;
    }
    .btn-secondary:hover {
      background: lightblue;
    }

    /* Section Hero */
    .hero {
      background: url('{{ asset('storage/images/image.png') }}') center/cover no-repeat;
      height: 80vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: white;
      position: relative;
      margin-top: 70px; /* Ajustement pour ne pas cacher le contenu sous la navbar */
    }
    .hero-overlay {
      position: absolute;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.1);/* Bleu foncé */
    }
    .hero-content {
      position: relative;
      z-index: 1;
    }
    .hero h1 {
      font-size: 3rem;
      font-weight: bold;
      text-transform: uppercase;
      margin-bottom: 10px;
      color: white;
    }
    .hero p {
      font-size: 1.3rem;
      margin-bottom: 10px;
    }

    /* Section Burgers */
    .burgers {
      text-align: center;
      padding: 50px 20px;
    }
    .burgers-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 15px;
      justify-content: center;
      padding: 10px;
    }
    .burger-card {
      background: white;
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: transform 0.3s;
    }
    .burger-card:hover {
      transform: scale(1.05);
    }
    .burger-card img {
      width: 100%;
      border-radius: 8px;
    }
    .btn-order {
      display: block;
      margin: 10px auto;
      padding: 10px 15px;
      background: blue;
      color: white;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.3s;
    }
    .btn-order:hover {
      background: darkblue;
    }
  </style>
</head>

<body>

  <!-- Navigation -->
  <nav class="main-nav">
    <div class="logo-text">
      <span class="isi">🍔 ISI BURGER</span>
    </div>
    <div class="buttons">
      <a href="" class="btn-primary"><i data-feather="info"></i> À propos</a>
      <a href="" class="btn-secondary"><i data-feather="mail"></i> Contact</a>
      <a href="{{ route('login') }}" class="btn-primary"><i data-feather="log-in"></i> Se connecter</a>
      <a href="{{ route('register') }}" class="btn-secondary"><i data-feather="user-plus"></i> S'inscrire</a>
    </div>
  </nav>

  <!-- Section Hero -->
  <section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1>Bienvenue chez ISI BURGER</h1>
      <p>Découvrez les meilleurs burgers faits avec passion et des ingrédients frais !</p>
    </div>
  </section>

  <!-- Section Burgers -->
  <section class="burgers">
    <h2>Nos Meilleurs Burgers 🍔</h2>
    <div class="burgers-container">
      <div class="burger-card">
        <img src="{{ asset('storage/images/burger.png') }}" alt="Burger Classique">
        <h3>Burger Classique</h3>
        <p>670F</p>
        <a href="{{ route('login') }}" class="btn-order">Commander</a>
      </div>
      <div class="burger-card">
        <img src="{{ asset('storage/images/burger3.jpg') }}" alt="Burger Fromage">
        <h3>Burger Fromage</h3>
        <p>700F</p>
        <a href="{{ route('login') }}" class="btn-order">Commander</a>
      </div>
      <div class="burger-card">
        <img src="{{ asset('storage/images/burger-bg.jpg') }}" alt="Burger Spécial">
        <h3>Burger Spécial</h3>
        <p>3900F</p>
        <a href="{{ route('login') }}" class="btn-order">Commander</a>
      </div>
      <div class="burger-card">
        <img src="{{ asset('storage/images/burger3.jpg') }}" alt="Burger Gourmet">
        <h3>Burger Gourmet</h3>
        <p>800F</p>
        <a href="{{ route('login') }}" class="btn-order">Commander</a>
      </div>
      <div class="burger-card">
        <img src="{{ asset('storage/images/burger-bg.jpg') }}" alt="Burger Spécial">
        <h3>Burger Spécial</h3>
        <p>1300F</p>
        <a href="{{ route('login') }}" class="btn-order">Commander</a>
      </div>
      <div class="burger-card">
        <img src="{{ asset('storage/images/burger3.jpg') }}" alt="Burger Gourmet">
        <h3>Burger Gourmet</h3>
        <p>1000F</p>
        <a href="{{ route('login') }}" class="btn-order">Commander</a>
      </div>
      <div class="burger-card">
        <img src="{{ asset('storage/images/burger-bg.jpg') }}" alt="Burger Spécial">
        <h3>Burger Spécial</h3>
        <p>1500F</p>
        <a href="{{ route('login') }}" class="btn-order">Commander</a>
      </div>
      <div class="burger-card">
        <img src="{{ asset('storage/images/burger3.jpg') }}" alt="Burger Gourmet">
        <h3>Burger Gourmet</h3>
        <p>2000F</p>
        <a href="{{ route('login') }}" class="btn-order">Commander</a>
      </div>
      <div class="burger-card">
        <img src="{{ asset('storage/images/burger3.jpg') }}" alt="Burger Gourmet">
        <h3>Burger Gourmet</h3>
        <p>2000F</p>
        <a href="{{ route('login') }}" class="btn-order">Commander</a>
      </div>
      <div class="burger-card">
        <img src="{{ asset('storage/images/burger3.jpg') }}" alt="Burger Gourmet">
        <h3>Burger Gourmet</h3>
        <p>2000F</p>
        <a href="{{ route('login') }}" class="btn-order">Commander</a>
      </div>
      <div class="burger-card">
        <img src="{{ asset('storage/images/burger3.jpg') }}" alt="Burger Gourmet">
        <h3>Burger Gourmet</h3>
        <p>2000F</p>
        <a href="{{ route('login') }}" class="btn-order">Commander</a>
      </div>
      <div class="burger-card">
        <img src="{{ asset('storage/images/burger3.jpg') }}" alt="Burger Gourmet">
        <h3>Burger Gourmet</h3>
        <p>2000F</p>
        <a href="{{ route('login') }}" class="btn-order">Commander</a>
      </div>
    </div>
  </section>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      feather.replace();
    });
  </script>


</body>


</html>
