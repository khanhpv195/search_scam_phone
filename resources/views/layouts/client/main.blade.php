<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Number Spam Checker</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
<div id="main-wrapper"> <!-- Main wrapper to hold everything for sticky footer -->
    <header class="bg-light p-3 mb-3 border-bottom header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a href="/"><img src="https://via.placeholder.com/100x50?text=Logo" alt="Logo" class="logo"></a>
                <!-- Toggle and other nav elements -->
            </nav>
        </div>
    </header>
    <div class="content">
        @yield('content')
    </div>

    <footer class="p-4 mt-4 border-top">
        <div class="container">
            <div class="row">
                <!-- Column 1: Links -->
                <div class="col-md-4">
                    <h5 class=" mb-3">Về chúng tôi</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor.</p>
                </div>

                <!-- Column 3: About Us -->
                <div class="col-md-4">
                    <h5 class=" mb-3">Chính sách</h5>
                    <ul class="list-unstyled">
                        <li><a href="/terms-of-use" class="text-decoration-none">Điều khoản sử dụng</a></li>
                        <li><a href="/privacy-policy" class="text-decoration-none">Chính sách bảo mật</a></li>
                        <li><a href="/privacy-policy" class="text-decoration-none">Về chúng tôi</a></li>
                    </ul>
                </div>

                <!-- Column 2: Logo -->
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <img src="https://via.placeholder.com/100x50?text=Logo+BCT" alt="Logo Bộ Công Thương" class="logo">
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
@stack('scripts')
</body>
</html>
