<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SAAS - FreelanceProjectManagement</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/material-icon/css/material-design-iconic-font.css') }}">
    <link href="{{ asset('dist/css/tabler.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-flags.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-payments.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-vendors.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/demo.min.css')}}" rel="stylesheet"/>
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>

    <div class="main">

    @yield('body')
    </div>

    <!-- JS -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
      <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('dist/js/tabler.min.js?1695847769')}}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js?1695847769')}}" defer></script>
    <script>

      function togglePassword(inputId) {
          var passwordInput = document.getElementById(inputId);
          var eyeIcon = document.querySelector('#' + inputId + '-icon');
  
          if (passwordInput.type === 'password') {
              passwordInput.type = 'text';
              eyeIcon.classList.remove('icon-eye');
              eyeIcon.classList.add('icon-eye-off');
          } else {
              passwordInput.type = 'password';
              eyeIcon.classList.remove('icon-eye-off');
              eyeIcon.classList.add('icon-eye');
          }
      }
      </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>