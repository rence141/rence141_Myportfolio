<?php
// Simple test first
echo "PHP is working!<br>";

// Include the main portfolio file
if (file_exists('portfolio.php')) {
    include 'portfolio.php';
} else {
    echo "Error: portfolio.php not found!";
}
?> 