<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="judul-content">
        <h1>Beranda</h1>
    </div>
    <div class="isi-content">
        <?php 
        echo "<h1>Hallo $_SESSION[level]</h1>"      
        ?>
  
            <div class="judul-home">
                <h1>Selamat Datang di Aplikasi Toko Nugraha</h1>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127394.8873206403!2d114.9108804950975!3d-3.7905298459907004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de659635f6e838d%3A0x756fbab1dc928b0c!2sDamit%20Hulu%2C%20Kec.%20Batu%20Ampar%2C%20Kabupaten%20Tanah%20Laut%2C%20Kalimantan%20Selatan!5e0!3m2!1sid!2sid!4v1685596272001!5m2!1sid!2sid" width="1000" height="450" style="border:2px solid #fff; margin-top:10px; border-radius:20px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
    </div>
    <footer class="credit">
                <div>
                    <p>&copy; 2023 <a href="#">Kelompok 9</a>. All rights reserved.</p>
                </div>
    </footer>
</body>

</html>