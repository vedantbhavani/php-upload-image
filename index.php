<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'vsdata';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Get image info
    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'images/' . $file_name;
    $sql = "Insert into images (file) values ('$file_name')";
    $result = mysqli_query($conn, $sql);
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h2>File uploded successfully</h2>";
    } else {
        echo "<h2>File not uploded</h2>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <label for="image">Select Image:</label>
        <input type="file" name="image" id="image" required>
        <input type="submit" name="submit" value="Upload">
    </form>
    <div>
        <?php
        $all = "select * from images";
        $resultlast = mysqli_query($conn, $all);
        while ($row = mysqli_fetch_assoc($resultlast)) {
        ?>
            <img src="images/<?php echo $row['file'] ?>" alt="file">
        <?php } ?>
        
    </div>
</body>

</html>