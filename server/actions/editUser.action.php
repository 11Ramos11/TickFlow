<?php

include_once(__DIR__.'/../classes/session.class.php');
include_once(__DIR__.'/../classes/connection.db.php');

$session = new Session();

$id = $_POST["id"];

$name = $_POST["name"];

if (!preg_match('/^[a-zA-Z\s]+$/i', $name)){
    $session->setError("Invalid Input", "Name must only contain letters and spaces");
    header("Location: ../pages/dashboard.php?id=$id");  
    exit();
}

$email = $_POST["email"];

if (!preg_match("/^[a-zA-Z0-9.]+@tickflow.com$/i", $email)){
    $session->setError("Invalid Input", "Email must be a valid TickFlow email (user.name123@tickflow.com)");
    header("Location: ../pages/dashboard.php?id=$id");  
    exit();
}

$department = $_POST["department"];

if (!is_numeric($department)){
    $session->setError("Invalid Input", "Department must be a valid department");
    header("Location: ../pages/dashboard.php?id=$id");  
    exit();
}

$sessionUser = $session->getUser();

if (!isset($_POST["role"])){
    $role = $sessionUser->role; 
} else {
    $role = $_POST["role"];
}

if ($sessionUser->role == "Admin" && $role != "Admin" && $sessionUser->id == $id){
    if (count(User::getAdmins()) == 1){
        $session->setError("reg", "There must be at least one admin");
        header("Location: ../pages/dashboard.php?id=$id");  
        exit();
    }
}

if ($sessionUser->role == "Admin" && User::getUserById($id)->role == "Admin" && $sessionUser->id != $id){
    $session->setError("reg", "Admins cannot edit other admins");
    header("Location: ../pages/dashboard.php?id=$id");  
    exit();
}

if ($role != "Admin" && $role != "Agent" && $role != "Client"){
    $session->setError("Invalid Input", "Role must be Admin, Agent or Client");
    header("Location: ../pages/dashboard.php?id=$id");  
    exit();
}

$db = getDatabaseConnection();
$query = $db->prepare("UPDATE User SET name = ?,email = ?,role = ?, department = ? WHERE id = ?");
$result =  $query->execute(array($name,$email,$role,$department, $id));

if (!empty($_FILES['image']['tmp_name'])){

    if (!is_dir('../images')) mkdir('../images');
    if (!is_dir('../images/profiles')) mkdir('../images/profiles');

    // PHP saves the file temporarily here
    // Image is the name of the file input in the form
    $tempFileName = $_FILES['image']['tmp_name'];
    
    // Create an image representation of the original image
    // @ before function is to prevent warning messages
    $original = @imagecreatefromjpeg($tempFileName);
    if (!$original) $original = @imagecreatefrompng($tempFileName);
    if (!$original) $original = @imagecreatefromgif($tempFileName);

    if (!$original) {
        $session->setError('Bad Format', 'Unknown image format');
        header("Location: ../pages/dashboard.php?id=$id");
        exit();
    }

    // delete previous image in any format

    $files = glob("../images/profiles/$id.*"); // get all file names
    foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
    }

    // Generate filenames for original, small and medium files
    $originalFileName = "../images/profiles/$id.jpg";

    error_log($originalFileName);

    $width = imagesx($original);     // width of the original image
    $height = imagesy($original);    // height of the original image
    $square = min($width, $height);  // size length of the maximum square

    // Create and save a small square thumbnail 350x350

    // Create an empty canvas (white)
    $small = imagecreatetruecolor(350, 350);
    $white = imagecolorallocate($small, 255, 255, 255);
    imagefill($small, 0, 0, $white);

    // Resize the original into the small square
    imagecopyresized($small, $original, 0, 0, ($width>$square)?($width-$square)/2:0, ($height>$square)?($height-$square)/2:0, 350, 350, $square, $square);
    // Save the small square thumbnail
    imagejpeg($small, $originalFileName);
}

$session->setSuccess("User Updated", "User updated successfully");

header("Location: ../pages/dashboard.php?id=$id");  


?>