<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="">
</head>
<body>
  <!-- Section: Design Block -->
<section class=" text-center text-lg-start">

    <div class="card mb-3">
      <div class="row g-0 d-flex align-items-center">
        <h1 class="text-center">Login Form</h1>
        @if(session('error'))
        <div class="alert alert-danger">
           {{session('error')}}
        </div>
        @endif
        <div class="col-lg-4 d-none d-lg-flex">
          <img src="https://c4.wallpaperflare.com/wallpaper/127/164/7/kid-luffy-monkey-d-luffy-one-piece-anime-hd-wallpaper-preview.jpg" alt="Trendy Pants and Shoes"
            class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
        </div>
        <div class="col-lg-8">
          <div class="card-body py-5 px-md-5">
  
            <form method="POST" action="/login/act">
              @csrf
            
              <div class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Email address</label>
                <input type="email" id="form2Example1" class="form-control" name="email">
              </div>
  
              <div class="form-outline mb-4">
                <label class="form-label" for="form2Example2">Password</label>
                <input type="password" id="form2Example2" class="form-control" name="password"> 
              </div>
  
              <div class="row mb-4">
                <div class="col">
                    <a href="/forgotPass">Forgot password?</a>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block mb-4" value="register">Sign in</button>
        
            </form>
  
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>