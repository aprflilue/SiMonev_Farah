<!-- Topbar Start -->
<div class="container-fluid px-5 d-none d-lg-block">
  <div class="row gx-5 py-3 align-items-center">
      <div class="col-lg-3">
          <div class="d-flex align-items-center justify-content-start">
              <i class="bi bi-phone-vibrate fs-1 text-primary me-2"></i>
              <h2 class="mb-0">+012 345 6789</h2>
          </div>
      </div>
      <div class="col-lg-6">
          <div class="d-flex align-items-center justify-content-center">
              <a href="index.html" class="navbar-brand ms-lg-5">
                  <h1 class="m-0 display-4 text-primary"><span class="text-secondary">Farm</span>Fresh</h1>
              </a>
          </div>
      </div>
      <div class="col-lg-3">
          <div class="d-flex align-items-center justify-content-end">
              <a class="btn btn-primary btn-square rounded-circle me-2" href="#"><i class="fab fa-twitter"></i></a>
              <a class="btn btn-primary btn-square rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
              <a class="btn btn-primary btn-square rounded-circle me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
              <a class="btn btn-primary btn-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
          </div>
      </div>
  </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5">
  <a href="index.html" class="navbar-brand d-flex d-lg-none">
      <h1 class="m-0 display-4 text-secondary"><span class="text-white">Farm</span>Fresh</h1>
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav mx-auto py-0">
          <a href="/" class="nav-item nav-link active">Home</a>
          <a href="/about" class="nav-item nav-link">About</a>
          <a href="/dashboard" class="nav-item nav-link">Dashboard</a>
          
          <div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
              <div class="dropdown-menu m-0">
                  <a href="blog.html" class="dropdown-item">Blog Grid</a>
                  <a href="detail.html" class="dropdown-item">Blog Detail</a>
                  <a href="feature.html" class="dropdown-item">Features</a>
                  <a href="team.html" class="dropdown-item">The Team</a>
                  <a href="testimonial.html" class="dropdown-item">Testimonial</a>
              </div>
          </div>
          @auth
          hello, {{auth()->user()->username}}
          <form action="/logout" method="post">
            @csrf
            @method("DELETE")
            <button type="submit" class="collapse-item"><i class="fas fa-sign-in-alt"></i>&emsp; Logout</button>
          </form>
          @else
          <a href="/login" class="nav-item nav-link">Login Guys</a>
          @endif
      </div>
  </div>
</nav>
<!-- Navbar End -->