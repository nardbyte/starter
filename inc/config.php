<?php
// Database configuration
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "starter");

// Version
define("VERSION", "1.0.5");

// Database connection using PDO
try {
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to get configuration data
    $stmt = $conn->prepare("SELECT * FROM config WHERE id = 1");
    $stmt->execute();
    $configData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Assign the obtained values to constants
    define("SITENAME", $configData['site_name']);
    define("DESCRIPTION", $configData['site_description']);
    define("URL", $configData['site_url']);
    define("MAIL", $configData['admin_email']);

} catch (PDOException $e) {
    die("Database connection error: " . $e->getMessage());
}
