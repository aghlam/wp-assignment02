<footer>
    <div class="footer-left">
        <?php echo "<h6>Copyright &copy; " . date("Y") . " | Alan Lam - RMIT | All rights reserved</h6>"; ?>
    </div>
    <div class="footer-right center-content">
        <ul>

            <?php 
                if (basename($_SERVER["PHP_SELF"]) != 'index.php') {
                    echo "<li><a href='./index.php'>Home</a></li>";
                }
            ?>

            <li><a href='./myServices.php'>Services</a></li>
            <li><a href='./contact.php'>Contact</a></li>
            <li><a href="#">About Us</a></li>
        </ul>
    </div>
</footer>
