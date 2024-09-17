<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ARDAN</title>
    <link rel="stylesheet" href="css/StyleMain/main.css">
</head>
<body>
    {{-- navbar area --}}
    <nav class="navbar">
        <div class="area-kiri-navbar">
            {{-- <div class="image-brand"></div> --}}
            <img class="image-brand" src="image/imageHeader/logoArdan.png" alt="">
        </div>
        <div class="area-kanan-navbar">
            <div class="menu-link-navbar">
                <a class="link" href=""><p>Home</p></a>
                <div class="dropdown">
                    <a class="link dropText" id="dropdown-toggle">Media & Program<i class="arrow-down"></i></a>
                    <div class="dropdown-content" id="dropdown-menu">
                      <a href="#">Program</a>
                      <div class="line"></div>
                      <a href="#">Info News</a>
                      <div class="line"></div>
                      <a href="#">Event</a>
                      <div class="line"></div>
                      <a href="#">Playlist Youtube</a>
                      <div class="line"></div>
                      <a href="#">Podcast</a>
                      <div class="line"></div>
                    </div>
                  </div>
                <a class="link" href=""><p>Announcer</p></a>
                <a class="link" href=""><p>Chart</p></a>
                <a class="link" href=""><p>Schedule</p></a>
                <a class="link" href=""><p>Contact</p></a>
            </div>
        </div>
    </nav>
    {{-- ------- --}}


    {{-- main content area --}}
    <main class="main">
        @yield('content')
    </main>
    {{-- ------- --}}

    <footer class="footer">
      <div class="top-footer">
        <div class="area-kiri-footer">
          <div class="area-group-kiri">
            <div class="area-text-contact">
              <h1 class="text-contact">CONTACT US</h1>
            </div>
            <div class="area-footer-address">
              <p class="footer-address">Email : example@gmail.com</p>
              <p class="footer-address">Telepon : +62 085862839923 </p>
              <p class="footer-address">Alamat :lorem ipsum dolor sit amet</p>
            </div>
          </div>
        </div>
        <div class="area-kanan-footer">
          <div class="area-group-kanan">
            <div class="area-text-socmed">
              <h1 class="text-socmed">Social Media</h1>
            </div>
            <div class="area-footer-socmed">
              <div class="kotak-socmed"></div>
              <div class="kotak-socmed"></div>
              <div class="kotak-socmed"></div>
              <div class="kotak-socmed"></div>
            </div>
            <div class="area-text-socmed2">
              <h1 class="text-socmed2">Get it on</h1>
            </div>
            <div class="area-footer-download">
              <div class="kotak-download"></div>
              <div class="kotak-download"></div>
            </div>
          </div>
        </div>
      </div>
        <div class="bottom-footer">
            <h1 class="text-copyRight">CopyRight 2024</h1>
        </div>
    </footer>
</body>
<script>
    // JavaScript untuk toggle dropdown saat diklik
document.getElementById('dropdown-toggle').addEventListener('click', function(event) {
  // Toggle class 'show' untuk menampilkan atau menyembunyikan dropdown
  document.getElementById('dropdown-menu').classList.toggle('show');

  // Mencegah link default jika ada di dropdown-text
  event.preventDefault();
});

// Tutup dropdown jika klik di luar dropdown
window.onclick = function(event) {
  if (!event.target.matches('.arrow-down')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
};

</script>
</html>