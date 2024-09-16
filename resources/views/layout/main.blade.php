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