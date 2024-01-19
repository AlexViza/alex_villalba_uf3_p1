<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Movies</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
</head>

<body>
    <header>
        <div class="container-fluid p-0" align="center">
            <img src="https://png.pngtree.com/background/20210711/original/pngtree-coming-soon-movie-in-cinema-theater-billboard-sign-on-red-theater-picture-image_1157635.jpg" class="img-fluid" alt="Header">
        </div>
    </header>

    <main class="container mt-4">
        @yield('content') 
    </main>

    <footer class="bg-dark text-light mt-5 py-4 text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Contacto</h3>
                <p>Correo: alejandro.viza2004@gmail.com</p>
                <p>Teléfono: +34 343 12 75 56</p>
            </div>
            <div class="col-md-6">
                <h3>Síguenos</h3>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#" class="text-light"><i class="fab fa-facebook"></i>Facebook</a></li>
                    <li class="list-inline-item"><a href="#" class="text-light"><i class="fab fa-twitter"></i>Twitter</a></li>
                    <li class="list-inline-item"><a href="#" class="text-light"><i class="fab fa-instagram"></i>Instagram</a></li>
                </ul>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <p class="mb-0">&copy; 2023 Cinema</p>
                <p class="mb-0">¡Descubre nuevas historias en la pantalla grande!</p>
            </div>
        </div>
    </div>
</footer>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
</body>

</html>
