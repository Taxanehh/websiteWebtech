<?php
session_start();
?>


<?php
include('../private/shared/header.php');
?>
<div class="header main-header" id="header">
    <?php
    include('../private/shared/navbar.php');
    ?>
</div>
<div class="content">
    <div id="awards">
        <h1>Awards</h1>
        <p>UvA's most awarded Korean Restaurant</p>
        <div class="awards">
            <img class="logo" src="/assets/images/awards/award1.png">
            <img class="logo" src="/assets/images/awards/award2.png">
            <img class="logo" src="/assets/images/awards/award3.png">
            <img class="logo" src="/assets/images/awards/award4.png">
            <img class="logo" src="/assets/images/awards/award6.png">
        </div>
    </div>
    <div class="divider"></div>
    <div id="about">
        <h1>About</h1>
        <div class="about">
            <div class="info">
                <p> Kimi Korean Restaurant UvA <br>
                    Universiteit van Amsterdam Roeterseiland Campus <br>
                    Roetersstraat 11, 1018 WB Amsterdam <br>
                    Universiteit van Amsterdam Science Park 904 <br>
                    Science Park 904, 1098 XH Amsterdam <br>
                    +31 (01) 2345 6789 <br>
                    Kimi@restaurant.uva.nl <br>
                </p>
            </div>
            <div class="roetersbox">
                <h2>Roeterseiland Campus</h2>
                <p>We offer various meat- <br>
                    and rice-dishes at the
                    Roeterseiland Campus. <br>

                    Thanks to our low prices, <br>
                    we strive to prevent food <br>
                    insecurity, althewhilst promoting <br>
                    food security and improved nutrition.
                    We offer various meat- <br>
                    and rice-dishes at the
                    Roeterseiland Campus. <br>

                    Thanks to our low prices, <br>
                    we strive to prevent food <br>
                    insecurity, althewhilst promoting <br>
                    food security and improved nutrition.
                </p>
            </div>
            <div class="scienceparkbox">
                <h2>Science Park 904</h2>
                <p>We offer various meat- <br>
                    and rice-dishes at the
                    Roeterseiland Campus. <br>

                    Thanks to our low prices, <br>
                    we strive to prevent food <br>
                    insecurity, althewhilst promoting <br>
                    food security and improved nutrition.
                    We offer various meat- <br>
                    and rice-dishes at the
                    Roeterseiland Campus. <br>

                    Thanks to our low prices, <br>
                    we strive to prevent food <br>
                    insecurity, althewhilst promoting <br>
                    food security and improved nutrition.
                </p>
            </div>
        </div>
    </div>
</div>
<div id="image-container">
    <div class="images">
        <img src="/assets/images/food/image1.jpg" alt="Image 1">
        <img src="/assets/images/food/image2.jpg" alt="Image 2">
        <img src="/assets/images/food/image3.jpg" alt="Image 3">
        <img src="/assets/images/food/image4.jpg" alt="Image 4">
        <img src="/assets/images/food/image5.jpg" alt="Image 5">
        <img src="/assets/images/food/image6.jpg" alt="Image 6">
        <img src="/assets/images/food/image7.jpg" alt="Image 7">
        <img src="/assets/images/food/image8.jpg" alt="Image 8">
        <img src="/assets/images/food/image9.jpg" alt="Image 9">
    </div>
</div>
<div id="text-bar">
    <div class="text">
        <h3><a href="/reservations"> Click here to make a reservation! </a></h3>
    </div>
</div>
<div id="newsletter-text">
    <div class="newsletter-text">
        <h2>Join Kimi</h2>
        <h3>Be the first to know about Kimi's special events and news</h3>
    </div>
</div>
<div id=newsletter">
    <div class="newsletter">
        <form id="newsletterForm">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="button" onclick="subscribe()">Subscribe</button>
        </form>

        <p id="confirmationMessage"></p>

        <script src="/assets/js/script.js"></script>
    </div>
</div>
<?php
include('../private/shared/footer.php');
include('../private/shared/cookie_consent.php');
?>
