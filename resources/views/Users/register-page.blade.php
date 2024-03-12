@extends('header')
@extends('footer')

<body>

  <section class="user-register-page">
    <div class="register-page">
        <form class="form-register-page" action="/register" method="POST">
          @csrf
          <h2 style="text-align: center;">REGISTER PAGE</h2>

          <input name="name" type="text" placeholder="Enter your Name" value="{{ old('name') }}">
          @error('name') <span class="error">{{ $message }}</span>@enderror

          <input name="email" type="text" placeholder="example@gmail.com" value="{{ old('email') }}">
          @error('email')<span class="error">{{ $message }}</span>@enderror

          <input name="password" type="password" placeholder="Enter a Password" value="{{ old('password') }}">
          @error('password')<span class="error">{{ $message }}</span>@enderror

          <button>Register</button>
          <p>Already have an account?<br><a href="login-page">Login</a> now!</p>
        </form>
    </div>
  </section>

</body>
