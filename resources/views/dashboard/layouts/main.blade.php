<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Dashboard | {{ $title }}</title>

  <!-- Favicon -->
  <link href="/img/kementan/logo.svg" rel="icon">
  <meta name="csrf-token" content="{{ csrf_token() }}"/>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="/dashboard-asset/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/dashboard-asset/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="/dashboard-asset/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="/dashboard-asset/modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="/dashboard-asset/modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="/dashboard-asset/modules/summernote/summernote-bs4.css">

  <!-- Data Table Editor -->
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="/dashboard-asset/css/style.css">
  <link rel="stylesheet" href="/dashboard-asset/css/components.css">

  @stack('css')

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">

            @include('dashboard.partials.navbar')
      
            <div class="main-sidebar sidebar-style-2">
                @include('dashboard.partials.sidebar')
            </div>
            
            <!-- Main Content -->
            <div class="main-content">
              @yield('container')                
            </div>

            {{-- <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By Farah Fazira Fisylia
                </div>
                <div class="footer-right">
                            
                  
                </div>
            </footer> --}}
        </div>
    </div>
          

    <!-- General JS Scripts -->
    <script src="/dashboard-asset/modules/jquery.min.js"></script>
    <script src="/dashboard-asset/modules/popper.js"></script>
    <script src="/dashboard-asset/modules/tooltip.js"></script>
    <script src="/dashboard-asset/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="/dashboard-asset/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="/dashboard-asset/modules/moment.min.js"></script>
    <script src="/dashboard-asset/js/stisla.js"></script>
    
    <!-- JS Libraies -->
    <script src="/dashboard-asset/modules/simple-weather/jquery.simpleWeather.min.js"></script>
    <script src="/dashboard-asset/modules/chart.min.js"></script>
    <script src="/dashboard-asset/modules/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="/dashboard-asset/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="/dashboard-asset/modules/summernote/summernote-bs4.js"></script>
    <script src="/dashboard-asset/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="/dashboard-asset/js/page/index-0.js"></script>
    
    <!-- Template JS File -->
    <script src="/dashboard-asset/js/scripts.js"></script>
    <script src="/dashboard-asset/js/custom.js"></script>

    {{-- pop up --}}
    
    
    {{-- <script src="/js/editadmin.js"></script> --}}

    <!-- JavaScript Bundle with Popper -->
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>

    <script>
      $(document).ready(function() {
        $('#dataTable').DataTable();
      });
    </script>
    
    {{-- //DATA INDO REGIONAL --}}
    <script>
        $(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

    @stack('script')

</body>
</html>
