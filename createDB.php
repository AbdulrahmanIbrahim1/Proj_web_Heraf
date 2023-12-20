<?php
$host = 'localhost';
$dbname = 'heraf';
$User = 'root';
$pass = 'Boda2410';


    $pdo = new PDO("mysql:host=$host;", $User, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // إنشاء قاعدة البيانات
    $createDatabaseSQL = "CREATE DATABASE IF NOT EXISTS $dbname";
    $pdo->exec($createDatabaseSQL);
    echo "Database created successfully\n";

    // استخدام قاعدة البيانات
    $useDatabaseSQL = "USE $dbname";
    $pdo->exec($useDatabaseSQL);
    echo "Using database: $dbname\n";

    // إنشاء جداول البيانات
    $createTablesSQL = "
        CREATE TABLE IF NOT EXISTS clients (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(255),
            last_name VARCHAR(225),
            email VARCHAR(255),
            pass_word VARCHAR(225),
            country VARCHAR(225),
            governorate VARCHAR(225),
            photo VARCHAR(225),
            phone VARCHAR(225)
        );

        CREATE TABLE IF NOT EXISTS employer (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(255),
            last_name VARCHAR(225),
            email VARCHAR(255),
            pass_word VARCHAR(225),
            country VARCHAR(225),
            governorate VARCHAR(225),
            photo VARCHAR(225),
            phone VARCHAR(225),
            elherfa VARCHAR(225),
            about VARCHAR(225)
        );

        CREATE TABLE IF NOT EXISTS review (
            id INT AUTO_INCREMENT PRIMARY KEY,
            employer_id INT,
            review VARCHAR(1024),
            rate INT,
            client_id INT,
            FOREIGN KEY (client_id) REFERENCES clients(id),
            FOREIGN KEY (employer_id) REFERENCES employer(id)
        );

        CREATE TABLE IF NOT EXISTS skills (
            id INT AUTO_INCREMENT PRIMARY KEY,
            employer_id INT,
            skill VARCHAR(255),
            FOREIGN KEY (employer_id) REFERENCES employer(id)
        );

        CREATE TABLE IF NOT EXISTS projects (
            id INT AUTO_INCREMENT PRIMARY KEY,
            employer_id INT,
            project_name VARCHAR(225),
            photo VARCHAR(225),
            details VARCHAR(1024),
            FOREIGN KEY (employer_id) REFERENCES employer(id)
        );
    ";

    $pdo->exec($createTablesSQL);
    echo "Tables created successfully\n";
// } catch (PDOException $e) {
//     die("Error: " . $e->getMessage());
// }
?>
