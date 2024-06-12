<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "survey";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$total_surveys = 0;
$average_age = 0;
$min_age = 0;
$max_age = 0;
$pizza_percentage = 0;
$pasta_percentage = 0;
$pap_and_wors_percentage = 0;
$movie_average_ratings = 0;
$radio_average_ratings = 0;
$eat_out_average_ratings = 0;
$tv_average_ratings = 0;

// Get total number of surveys
$count_sql = "SELECT COUNT(*) as count FROM surveys_table";
$count_result = $conn->query($count_sql);
if ($count_result->num_rows > 0) {
    $count_row = $count_result->fetch_assoc();
    $total_surveys = $count_row['count'];
}

if ($total_surveys > 0) {
    // Get average age
    $average_age_sql = "SELECT AVG(TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE())) AS avg_age FROM surveys_table";
    $average_age_result = $conn->query($average_age_sql);
    if ($average_age_result->num_rows > 0) {
        $age_row = $average_age_result->fetch_assoc();
        $average_age = $age_row['avg_age'];
    }

    // Get minimum age
    $min_age_sql = "SELECT MIN(TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE())) AS min_age FROM surveys_table";
    $min_age_result = $conn->query($min_age_sql);
    if ($min_age_result->num_rows > 0) {
        $min_age_row = $min_age_result->fetch_assoc();
        $min_age = $min_age_row['min_age'];
    }

    // Get maximum age
    $max_age_sql = "SELECT MAX(TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE())) AS max_age FROM surveys_table";
    $max_age_result = $conn->query($max_age_sql);
    if ($max_age_result->num_rows > 0) {
        $max_age_row = $max_age_result->fetch_assoc();
        $max_age = $max_age_row['max_age'];
    }

    // Get food preferences
    $food_sql = "SELECT 
                    (SUM(IF(FIND_IN_SET('Pizza', favorite_food), 1, 0)) / COUNT(*)) * 100 AS pizza_percentage,
                    (SUM(IF(FIND_IN_SET('Pasta', favorite_food), 1, 0)) / COUNT(*)) * 100 AS pasta_percentage,
                    (SUM(IF(FIND_IN_SET('Pap And Wors', favorite_food), 1, 0)) / COUNT(*)) * 100 AS pap_and_wors_percentage
                FROM surveys_table";
    $food_result = $conn->query($food_sql);
    if ($food_result->num_rows > 0) {
        $food_row = $food_result->fetch_assoc();
        $pizza_percentage = $food_row['pizza_percentage'];
        $pasta_percentage = $food_row['pasta_percentage'];
        $pap_and_wors_percentage = $food_row['pap_and_wors_percentage'];
    }

    
    // Get average ratings
    $ratings_sql = "SELECT 
                       AVG(movies_rating) AS movie_average_ratings,
                       AVG(radio_rating) AS radio_average_ratings,
                       AVG(eat_out_rating) AS eat_out_average_ratings,
                       AVG(tv_rating) AS tv_average_ratings
                   FROM surveys_table";
    $ratings_result = $conn->query($ratings_sql);
    if ($ratings_result->num_rows > 0) {
        $ratings_row = $ratings_result->fetch_assoc();
        $movie_average_ratings = $ratings_row['movie_average_ratings'];
        $radio_average_ratings = $ratings_row['radio_average_ratings'];
        $eat_out_average_ratings = $ratings_row['eat_out_average_ratings'];
        $tv_average_ratings = $ratings_row['tv_average_ratings'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="js/bootstrap.min.js">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <h1 class="navbar-brand">_Survey</h1>
            <ul class="navbar-nav mr-auto navbar justify-content-end">
                <li class="nav-item active">
                    <a class="nav-link" href="Index.html">FILL OUT SURVEY</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="viewResults.php">VIEW SURVEY RESULTS</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container" style="margin-top: 10px;">
        <h1 style="text-align: center;">Survey Results</h1>
        <?php if ($total_surveys > 0): ?>
        <div class="row">
            <div class="col-6" style="margin-top: 35px;">
                <h2 style="font-size: x-large;">Total number of surveys:</h2>
            </div>
            <label class="col order-last" style="margin-top: 35px;" id="TotalnumberSurvey"><?php echo $total_surveys; ?></label>
        </div>
        <div class="row">
            <div class="col-6">
                <h2 style="font-size: x-large;">Average age:</h2>
            </div>
            <label class="col order-last" id="averageAge"><?php echo round($average_age, 2); ?></label>
        </div>
        <div class="row">
            <div class="col-6">
                <h2 style="font-size: x-large;">Oldest person who participated in the survey:</h2>
            </div>
            <label class="col order-last" id="maxAge"><?php echo $max_age; ?></label>
        </div>
        <div class="row">
            <div class="col-6">
                <h2 style="font-size: x-large;">Youngest person who participated in the survey:</h2>
            </div>
            <label class="col order-last" id="minAge"><?php echo $min_age; ?></label>
        </div>
        <div class="row">
            <div class="col-6" style="margin-top: 50px;">
                <h2 style="font-size: x-large;">Percentage of the people who like pizza:</h2>
            </div>
            <label class="col order-last" style="margin-top: 50px;" id="pizzaPercentage"><?php echo round($pizza_percentage, 2); ?>%</label>
        </div>
        <div class="row">
            <div class="col-6">
                <h2 style="font-size: x-large;">Percentage of the people who like pasta:</h2>
            </div>
            <label class="col order-last" id="pastaPercentage"><?php echo round($pasta_percentage, 1); ?>%</label>
        </div>
        <div class="row">
            <div class="col-6">
                <h2 style="font-size: x-large;">Percentage of the people who like Pap and Wors:</h2>
            </div>
            <label class="col order-last" id="papAndworsPercentage"><?php echo round($pap_and_wors_percentage, 1); ?>%</label>
        </div>
        <div class="row">
            <div class="col-6" style="margin-top: 50px;">
                <h2 style="font-size: x-large;">People who like to watch movies:</h2>
            </div>
            <label class="col order-last" style="margin-top: 50px;" id="movieAverageRatings"><?php echo round($movie_average_ratings, 1); ?></label>
        </div>
        <div class="row">
            <div class="col-6">
                <h2 style="font-size: x-large;">People who like to listen to radio:</h2>
            </div>
            <label class="col order-last" id="radioAverageRatings"><?php echo round($radio_average_ratings, 1); ?></label>
        </div>
        <div class="row">
            <div class="col-6">
                <h2 style="font-size: x-large;">People who like to eat out:</h2>
            </div>
            <label class="col order-last" id="eatOutAverageRatings"><?php echo round($eat_out_average_ratings, 1); ?></label>
        </div>
        <div class="row" style="margin-bottom: 40px;">
        <div class="col-6 ">
                <h2 style="font-size: x-large;">People who like to watch TV:</h2>
            </div>
            <label class="col order-last" id="tvAverageRatings"><?php echo round($tv_average_ratings,1)?></label>
        </div>
    </div>
</body>
</html>
<?php endif;?>