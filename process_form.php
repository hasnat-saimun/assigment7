<?php

// Validate form inputs
if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_FILES['profile_picture'])) {
    die('All fields are required.');
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    die('Invalid email format.');
}

// Save profile picture to server with a unique filename
$upload_directory = 'uploads/';
$filename = uniqid() . '_' . basename($_FILES['profile_picture']['name']);
$target_file = $upload_directory . $filename;

if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
    die('Error uploading file.');
}

// Save user's information to CSV file
$data = [
    $_POST['name'],
    $_POST['email'],
    $filename,
    date('Y-m-d H:i:s')
];

$file = fopen('users.csv', 'a');
fputcsv($file, $data);
fclose($file);

// Start a new session and set a cookie with the user's name
session_start();
$_SESSION['name'] = $_POST['name'];
setcookie('name', $_POST['name'], time() + (86400 * 30), '/'); // Cookie will expire in 30 days

header('Location: display_users.php');
exit();

?>
