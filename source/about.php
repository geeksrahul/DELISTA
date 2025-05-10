    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }

        /* About Section */
        .about {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px;
            background-color: white;
            gap: 50px;
            animation: fadeIn 1.5s ease-in;
        }

        .about-content {
            max-width: 500px;
            text-align: left;
        }

        .about h2 {
            font-size: 32px;
            color: #333;
        }

        .about p {
            font-size: 18px;
            color: #555;
            margin: 15px 0;
        }

        .explore-btn {
            padding: 10px 20px;
            border: none;
            background-color: #091f40;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
        }

        .explore-btn:hover {
            background-color: #091f40;
            transform: scale(1.1);
        }

        /* Image container */
        .about-image {
            position: relative;
            width: 350px;
            height: 250px;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .about-image img {
            width: 100%;
            height: 100%;
            position: absolute;
            left:0;
            object-fit: cover;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }

        .about-image img.active {
            opacity: 1;
        }

        /* Fade In Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .about {
                flex-direction: column;
                text-align: center;
            }

            .about-content {
                text-align: center;
            }
        }
    </style>

    <section class="about">
        <div class="about-content">
            <h2>About Delista Store</h2>
            <p>At Delista Store, we are committed to bringing you high-quality products with a seamless shopping experience. Our team is dedicated to providing excellent service, ensuring that every customer finds what they need.</p>
            <a href="store/index.php" class='explore-btn'> Explore Store </a>
        </div>
        <div class="about-image">
            <img src="assets/images/img1.webp" class="active" alt="About Us">
            <img src="assets/images/img2.webp" alt="About Us">
            <img src="assets/images/img3.webp" alt="About Us">
        </div>
    </section>

    <script>
        const images = document.querySelectorAll(".about-image img");
        let currentIndex = 0;

        function changeImage() {
            images.forEach((img, index) => {
                img.classList.remove("active"); // Hide all images
                if (index === currentIndex) {
                    img.classList.add("active"); // Show current image
                }
            });
            currentIndex = (currentIndex + 1) % images.length;
        }

        // Change image every 3 seconds
        setInterval(changeImage, 3000);
    </script>

