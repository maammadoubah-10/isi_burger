<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Verification</title>
    <link rel="shortcut icon" href="{{ asset('assets/dashboard/img/svg/logo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('storage/assets/dashboard/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/dashboard/css/style.css') }}">
</head>

<body>
  <div class="layer"></div>
  <main class="page-center">
    <article class="verification">
      <h1 class="verification__title">Verify Your Email</h1>
      <p class="verification__subtitle">
        Thanks for signing up! Please check your email and click on the verification link.
        If you didn't receive the email, you can request a new one.
      </p>

      <form class="verification-form form" method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button class="form-btn primary-default-btn transparent-btn">Resend Verification Email</button>
      </form>

      <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button class="form-btn secondary-btn transparent-btn">Log Out</button>
      </form>
    </article>
  </main>

    <!-- Chart library -->
    <script src="{{ asset('storage/assets/dashboard/plugins/chart.min.js') }}"></script>
    <!-- Icons library -->
    <script src="{{ asset('storage/assets/dashboard/plugins/feather.min.js') }}"></script>
    <!-- Custom scripts -->
    <script src="{{ asset('storage/assets/dashboard/js/script.js') }}"></script>
</body>

</html>
