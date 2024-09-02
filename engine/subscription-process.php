<?php    

include('configure.php');
$conn = new Database();
date_default_timezone_set('Africa/Lagos');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $subscription_categories = $_POST["subscription_category"];
    $date =  $date = date("D, F d, Y g:iA");
    if (empty($email)) {
        echo "Please enter your  email address";
    }
    
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo"Email format not supported";
    }

    elseif (empty($subscription_categories)) {
        echo "Please select at least one subscription category";
    } else {
        // Serialize the array
        $serialized_categories = serialize($subscription_categories);

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO subscriptions (email, subscription_category,date) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $stmt->error);
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("sss", $email, $serialized_categories,$date);
        if ($stmt->execute()) {
            echo "1";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>
