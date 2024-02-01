<?php
session_start();

include('../private/shared/header.php');
require_once(__DIR__ . '/../private/utils.php');
?>
    <div class="header about-header" id="header">
        <?php
        include('../private/shared/navbar.php');
        ?>
        <div class="about-us-text">
            <h1>Kimi Korean Restaurant UvA</h1>
            <h2>Welcome to 키미 Kimi, where culinary excellence meets a commitment to righteousness, upheld values, and
                unwavering loyalty. Our restaurant is a celebration of not just delicious food, but also a dedication to
                the principles that guide us in every aspect of our business.

                At 키미 Kimi, we believe in upholding the highest standards of quality in our ingredients and preparation
                methods. Our culinary team is passionate about creating dishes that not only tantalize the taste buds
                but also reflect our commitment to integrity and authenticity.

                The name "Kimi" encapsulates our core values – Righteous, Upheld, Loyal. We strive to embody these
                principles in every interaction, from our warm and welcoming atmosphere to the impeccable service you
                receive at your table.

                Whether you're savoring our meticulously crafted menu items or enjoying the inviting ambiance, 키미 Kimi
                is more than a dining experience – it's a testament to our dedication to excellence and the values that
                define us. Join us on a gastronomic journey where every dish tells a story of integrity, upheld
                traditions, and the loyalty we extend to our patrons.
        </div>
    </div>


<?php
include('../private/shared/footer.php');
include('../private/shared/cookie_consent.php');
?>