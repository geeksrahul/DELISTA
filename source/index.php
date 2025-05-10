<?php 
    include "db/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home | Delista</title>
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        /* Contact Section */
        #contact {
            background: #f0f0f0;
            padding: 50px 20px;
            text-align: center;
        }

        /* Contact Us Heading */
        .contact-heading {
            margin-bottom: 30px;
        }

        .contact-heading h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 10px;
        }

        .contact-heading p {
            font-size: 16px;
            color: #666;
        }

        /* Contact Container */
        .contact-container {
            max-width: 1000px;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }

        /* Left: Google Map */
        .contact-left, .contact-right {
            flex: 1;
            min-width: 300px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .contact-left h2,
        .contact-right h2 {
            margin-bottom: 15px;
            color: #333;
        }

        .map-container {
            width: 100%;
            height: 300px;
            border-radius: 8px;
            overflow: hidden;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Right: Contact Details */
        .contact-right p {
            margin: 10px 0;
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        .contact-right i {
            margin-right: 10px;
            color: #007bff;
        }

        /* Social Media Icons */
        .social-icons {
            margin-top: 15px;
        }

        .social-icons a {
            color: white;
            font-size: 20px;
            margin-right: 10px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #ff7b00;
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <?php include "header.php"; ?>
    <main>
        <video id="videoPlayer" src="assets/video/hero1.mp4" muted autoplay loop></video>
    </main>
    <section id="categories">
        <h2>Browse Categories</h2>
        <div class="category-container">
            <div class="category-slider">
                <?php 
                    $categories = mysqli_query($conn, "SELECT * FROM CATEGORIES");
                    foreach($categories as $category){
                        echo "
                            <div class='category-box'>
                                <a href='/delista/store/index.php#$category[name]'>
                                    <img src='uploads/categories/$category[image]' alt='$category[name]'>
                                    <div class='category-name'> $category[name] </div>
                                </a>
                            </div>
                        ";
                    }
                ?>
            </div>
            <button id="nextBtn" onclick="scrollSlider(this)">&#10095;</button>
        </div>
    </section>
    <section id="about" class="about-section">
  

  <?php include "about.php"; ?>

    <section id="contact">
        <div class="contact-heading">
            <h1>Contact Us</h1>
            <p>We'd love to hear from you! Reach out to us through any of the channels below.</p>
        </div>

        <div class="contact-container">
            <!-- Left: Google Map -->
            <div class="contact-left">
                <h2>Our Location</h2>
                <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d193.27866144962852!2d71.766813088971!3d21.08929604610638!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be2257a2194faeb%3A0x380de7f784c962c6!2sR%20WEB%20INFOTECH!5e1!3m2!1sen!2sin!4v1742457081343!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <!-- Right: Contact Details -->
            <div class="contact-right">
                <h2>Get in Touch</h2>
                <p><i class="fas fa-map-marker-alt"></i> 214, Dharmvrudhhi Complex, Nr. Khadi Bhandar, Mahuva</p>
                <p><i class="fas fa-phone"></i> +91 9081953002 </p>
                <p><i class="fas fa-envelope"></i> delistastore@gmail.com </p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </section>
    <?php 
        include "footer.php";
    ?>
    <script>
        const scrollSlider = (btn) => {
            console.log(btn);
            const slider = btn.parentElement.firstElementChild;
            slider.scrollBy({ left: 300, behavior: "smooth" });
        }

        const videos = ["hero1.mp4", "hero2.mp4", "hero3.mp4"];
        let i = 0;
        const videoPlayer = document.getElementById("videoPlayer");
        setInterval(() => {
            i = (i + 1) % videos.length;
            videoPlayer.src = "assets/video/" + videos[i];
            videoPlayer.play();
        }, 5000);

    </script>

</body>
</html>