<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4963e7e1a2.js" crossorigin="anonymous"></script>
    <title>Controle de Séries</title>
</head>

<body>
    <nav class="navbar navbar-light bg-light mb-2 d-flex justify-content-between">
        <div class="container-fluid">
          <a class="navbar-brand" href={{ route('listar_series') }}>Inicio</a>
        @auth
          <a class="text-danger" href='/sair'>Sair</a>
        @endauth
        @guest
            <a  href='/entrar'>Entrar</a>
        @endguest
        </div>
      </nav>
    <div class="container">
        <div class="container-fluid bg-light py-5">
            <h1>@yield('cabecalho')</h1>
        </div>

        @yield('conteudo')
    </div>
</body>

</html>
