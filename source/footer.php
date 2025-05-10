<style>
/* Footer Styles */
.footer {
    background-color: #0B1F41;
    color: white;
    padding: 40px 20px;
    font-family: Arial, sans-serif;
}

.footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
}

.footer-column {
    flex: 1;
    min-width: 220px;
    margin-bottom: 20px;
}

.footer-column h3 {
    font-size: 16px;
    margin-bottom: 15px;
    text-transform: uppercase;
}

.footer-column ul {
    list-style: none;
    padding: 0;
}

.footer-column ul li {
    margin-bottom: 8px;
}

.footer-column ul li a {
    color: white;
    text-decoration: none;
    font-size: 14px;
    opacity: 0.8;
    transition: opacity 0.3s;
}

.footer-column ul li a:hover {
    opacity: 1;
}



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


/* Footer Bottom */
.footer-bottom {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
    opacity: 0.8;
}
</style>
    <footer class="footer">
        <div class="footer-container">
            <!-- Help Section -->
            <div class="footer-column">
                <h3>Categories</h3>
                <ul>
                    <li><a href="#"> PC </a> </li>
                    <li><a href="#"> Laptops </a> </li>
                    <li><a href="#"> Printers </a> </li>
                    <li><a href="#"> Speakers </a> </li>
                    <li><a href="#"> CCTV </a> </li>
                    <li><a href="#"> Nerworking </a> </li>
                </ul>
            </div>
            <!-- About Us Section -->
            <div class="footer-column">
                <h3>BRANDS</h3>
                <ul>
                    <li><a href="#"> HP </a> </li>
                    <li><a href="#"> Dell </a> </li>
                    <li><a href="#"> Lenovo </a> </li>
                    <li><a href="#"> ASUS </a> </li>
                    <li><a href="#"> Hikvision </a> </li>
                    <li><a href="#"> Dauha </a> </li>
                    <li><a href="#"> CP Plus </a> </li>
                </ul>
            </div>
            <!-- Guides Section -->
            <div class="footer-column">
                <h3>Pages</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Store</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Cart</a></li>
                    <li><a href="#">Admin</a></li>
                </ul>
            </div>


            <!-- App Download Section -->
            <div class="footer-column">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-bottom">
            <p>© Delista Store</p>
        </div>
    </footer>