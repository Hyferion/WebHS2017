<!DOCTYPE html>
<html>
<title>Cars & Cars</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/w3c.css">
<body>

<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-wide w3-padding w3-card-2">
        <a href="#home" class="w3-bar-item w3-button"><b>CC</b> Cars & Cars</a>
        <!-- Float links to the right. Hide them on small screens -->
        <div class="w3-right w3-hide-small">
            <a href="./products.php" class="w3-bar-item w3-button">Shop</a>
            <a href="./account.php" class="w3-bar-item w3-button">Account</a>
            <a href="#about" class="w3-bar-item w3-button">About</a>
        </div>
    </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
    <img class="w3-image" src="../src/background.jpg" alt="Car" width="1500" height="800">
    <div class="w3-display-middle w3-margin-top w3-center">
        <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>CC</b>
            </span> <span class="w3-hide-small w3-text-light-grey"> Cars & Cars</span></h1>
    </div>
</header>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

    <!-- Project Section -->
    <div class="w3-container w3-padding-32" id="news">
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">NEWS</h3>
    </div>

    <div class="w3-row-padding">
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-display-container">
                <div class="w3-display-topleft w3-black w3-padding">New Ferrari F50</div>
                <img src="../src/ferrari.jpg" alt="Car" style="width:100%">
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-display-container">
                <div class="w3-display-topleft w3-black w3-padding">Tobias is a pussy</div>
                <img src="../src/car1.jpg" alt="Car" style="width:100%">
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-display-container">
                <div class="w3-display-topleft w3-black w3-padding">Something new</div>
                <img src="../src/car2.jpg" alt="Car" style="width:100%">
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-display-container">
                <div class="w3-display-topleft w3-black w3-padding">Bla bla bla</div>
                <img src="../src/car3.jpg" alt="Car" style="width:100%">
            </div>
        </div>
    </div>


    <!-- About Section -->
    <div class="w3-container w3-padding-32" id="about">
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">About</h3>
        <p>Wir wollen der allerbeste sein, wie keiner vor mir war.. Dadadda, bereise ich das ganze Land, ich kenne die Gefaaaaaahr. POKEMON
        </p>
    </div>

    <div class="w3-row-padding w3">
        <div class="w3-col l3 m6 w3-margin-bottom">
            <img src="../src/silas.jpg" alt="" style="width:100%">
            <h3>Silas Stulz</h3>
            <p class="w3-opacity">Founder</p>
            <p>Best OW Player EUW</p>
            <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <img src="../src/manuel.jpg" alt="" style="width:100%">
            <h3>Manuel Egli</h3>
            <p class="w3-opacity">Founder</p>
            <p>Worst OW Player EUW</p>
            <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
        </div>

    <!-- Contact Section -->
    <div class="w3-container w3-padding-32" id="contact">
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Contact</h3>
        <p>Lets get in touch and talk about your and our next dream car!</p>
        <form action="/action_page.php" target="_blank">
            <input class="w3-input" type="text" placeholder="Name" required name="Name">
            <input class="w3-input w3-section" type="text" placeholder="Email" required name="Email">
            <input class="w3-input w3-section" type="text" placeholder="Subject" required name="Subject">
            <input class="w3-input w3-section" type="text" placeholder="Comment" required name="Comment">
            <button class="w3-button w3-black w3-section" type="submit">
                <i class="fa fa-paper-plane"></i> SEND MESSAGE
            </button>
        </form>
    </div>

    <!-- End page content -->
</div>

<!-- Google Map -->
<div id="googleMap" class="w3-aqua" style="width:100%;height:450px;"></div>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-16">
    Silas Stulz & Manuel Egli <?php echo date('Y') ?>
</footer>

<!-- Add Google Maps -->
<script>
    function myMap()
    {
        myCenter=new google.maps.LatLng(47.142208, 7.244754);
        var mapOptions= {
            center:myCenter,
            zoom:13, scrollwheel: true, draggable: false,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        var map=new google.maps.Map(document.getElementById("googleMap"),mapOptions);

        var marker = new google.maps.Marker({
            position: myCenter,
        });
        marker.setMap(map);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAP3rNovzb7KSWWP8B1T3eX6kw_YvOIvYI&callback=myMap"></script>
</body>
</html>