<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KCLYNE</title>

    <link href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <link href="{{ asset('css/header-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/product-display.css') }}" rel="stylesheet">

    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    <link href="{{ asset('css/product-create.css') }}" rel="stylesheet">

    
    
</head>

<style>
  .main-home{
  width: 100%;
  height: 100vh;
  background-image: url(images/interface/KCLYNE-Banner.png);
  background-position: center;
  background-size: cover;
  display: grid;
  grid-template-columns: repeat(1, 1fr);
  align-items: center;
}
</style>

<header>

    @auth 

        <a href="/home" class="logo"><img src="images/interface/KCLYNE-Logo.png" alt=""></a>

        <ul class="navmenu">
            <li><a href="/">Home</a></li>
            <li><a href="/">Shop</a></li>
            <li><a href="/">Administration</a></li>
            <li><a href="/">About Us</a></li>
        </ul>

        <div class="nav-icon">
            <form action="/logout" method="POST">
                @csrf
                <i class='bx bxs-user-circle'></i>
                <button class="logout-button" type="submit" class="logout-button">
                    <i class='bx bx-log-out-circle'></i>
                </button>
            </form>
        </div>

    @else   

    <a href="/home" class="logo"><img src="images/interface/KCLYNE-Logo.png" alt=""></a>

    <ul class="navmenu">
        <li><a href="/">Home</a></li>
        <li><a href="/">Shop</a></li>
        <li><a href="/">Administration</a></li>
        <li><a href="/">About Us</a></li>
    </ul>

    <div class="nav-icon">
        <a href="register-page"><i class='bx bx-user-plus'></i></a>
        <a href="login-page"><i class='bx bx-log-in-circle'></i></a>
    </div>  


    @endauth

    

</header>

<body>
    @yield('body')
</body>