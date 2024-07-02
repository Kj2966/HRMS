<?php
include('C:\xampp\htdocs\HRMS\includes\config.php');

if ($_POST['add_user'] === 'add_user_db') {
    // Retrieve input values
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    // Handle file upload
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Allowed file extensions
        $allowedExtensions = ['jpg', 'gif', 'png', 'jpeg'];
        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadDir = '../assets/img/profiles/';
            $destPath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $image = $newFileName;
            } else {
                error_log('Error moving the uploaded file.');
                die('There was an error uploading the file. Please try again.');
            }
        } else {
            error_log('Upload failed. Allowed file types: ' . implode(',', $allowedExtensions));
            die('Upload failed. Allowed file types: ' . implode(',', $allowedExtensions));
        }
    } else {
        error_log('No file uploaded or upload error.');
        die('No file uploaded or there was an upload error.');
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and execute the SQL statement
    $qry = "INSERT INTO users (FirstName, LastName, UserName, Email, Password, Phone, Address, Picture) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $qry);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssssss', $firstname, $lastname, $username, $email, $hashedPassword, $phone, $address, $image);
        
        if (mysqli_stmt_execute($stmt)) {
            include('../emailHandeler/mailConfig.php');
            $fileName='../emailHandeler/mailBodyUser.php';
            sendMail($fileName, $email);
            mysqli_stmt_close($stmt);
            header('Location: ../users.php');
            exit();
        } else {
            error_log('Statement execution error: ' . mysqli_stmt_error($stmt));
            die('Error executing statement: ' . mysqli_stmt_error($stmt));
        }
    } else {
        error_log('Statement preparation error: ' . mysqli_error($con));
        die('Error preparing statement: ' . mysqli_error($con));
    }
}
?>
