<?php
if(isset($_POST['submitSurvey'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "survey";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        // If connection fails, show an alert
        echo "<script>alert('Connection failed: " . $conn->connect_error . "');</script>";
        exit();
    }

    // Retrieve form data
    $fullName = $_POST['FullName'] ?? '';
    $email = $_POST['email'] ?? '';
    $dateOfBirth = $_POST['date'] ?? '';
    $contactNumber = $_POST['contactNumber'] ?? '';
    $favoriteFood = [];
    if(isset($_POST['Pizza'])) $favoriteFood[] = "Pizza";
    if(isset($_POST['Pasta'])) $favoriteFood[] = "Pasta";
    if(isset($_POST['PapAndWors'])) $favoriteFood[] = "Pap And Wors";
    if(isset($_POST['Other'])) $favoriteFood[] = "Other";
    $favoriteFood = implode(", ", $favoriteFood);

    // Ratings
    $movies = $_POST['movies'] ?? '';
    $radio = $_POST['radio'] ?? '';
    $eatOut = $_POST['eatOut'] ?? '';
    $tv = $_POST['TV'] ?? '';

    // SQL query to insert data
    $sql = "INSERT INTO surveys_table (full_name, email, date_of_birth, contact_number, favorite_food, movies_rating, radio_rating, eat_out_rating, tv_rating)
            VALUES ('$fullName', '$email', '$dateOfBirth', '$contactNumber', '$favoriteFood', '$movies', '$radio', '$eatOut', '$tv')";

    if ($conn->query($sql) === TRUE) {
        // Show success alert
        echo "<script>alert('New record created successfully');</script>";
    } else {
        // Show error alert
        echo "<script>alert('Error: " . $sql . " - " . $conn->error . "');</script>";
    }

    $conn->close();
} else {
    header("Location: index.html");
    exit();
}
?>
