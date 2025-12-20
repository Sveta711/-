<footer>
    <div class="footer-container">
        <div class="footer-section footer-about">
            <h4 class="footer-logo">AUDIORIA</h4>
            <p>High-quality audiobooks for your daily routine. Experience literature in a new light.</p>
            
            <h5 class="subscribe-title">Stay Updated</h5>
            <form action="subscribe.php" method="POST" class="subscribe-form">
                <input type="email" name="email" placeholder="Enter Your Email" required>
                <button type="submit" class="subscribe-btn">Subscribe</button>
            </form>
        </div>

        <div class="footer-section footer-links">
            <h4>Quick Access</h4>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="library.php">Audiobook Library</a></li>
                <li><a href="genres.php">Genres</a></li>
                <li><a href="favorites.php">My Favorites</a></li>
            </ul>
        </div>

        <div class="footer-section footer-info">
            <h4>Company</h4>
            <ul>
                <li><a href="about.php">About Us</a></li>
                <li><a href="support.php">Contact Us</a></li>
                <li><a href="support.php">FAQ</a></li>
                <li><a href="terms.php">Terms of Use</a></li>
            </ul>
        </div>

        <div class="footer-section footer-social">
            <h4>Follow Us</h4>
            <div class="social-icons">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> AUDIORIA. All rights reserved.</p>
    </div>
</footer>