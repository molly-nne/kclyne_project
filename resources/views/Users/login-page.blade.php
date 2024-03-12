@extends('header')
@extends('footer')

<body>

  <section class="user-login-page">
    <div class="login-page">
      
      <form class="form-login-page" action="/login" method="POST">
        @csrf
        <h2>LOGIN PAGE</h2>
        <input name="loginname" type="text" placeholder="Enter your name">
        <input name="loginpassword" type="password" placeholder="Enter your password">
        <button>Login</button>
        <p>Don't have account? <a href="register-page">Register</a> now!</p>
      </form>
    </div>
  </section>
  
  

</body>


