<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "myhmsdb");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

if (isset($_POST['patsub'])) {
    $email = $_POST['email'];
    $password = $_POST['password2'];
    $query = "SELECT * FROM patreg WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['pid'] = $row['pid'];
        $_SESSION['username'] = $row['fname'] . " " . $row['lname'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['gender'] = $row['gender'];
        $_SESSION['contact'] = $row['contact'];
        $_SESSION['email'] = $row['email'];
        header("Location:admin-panel.php");
    } else {
        echo "<script>alert('Invalid Username or Password. Try Again!'); window.location.href = 'index1.php';</script>";
    }
}

if (isset($_POST['update_data'])) {
    $contact = $_POST['contact'];
    $status = $_POST['status'];
    $query = "UPDATE appointmenttb SET payment='$status' WHERE contact='$contact'";
    $result = mysqli_query($con, $query);

    if ($result) {
        header("Location:updated.php");
    }
}

if (isset($_POST['doc_sub'])) {
    $doctor = $_POST['doctor'];
    $dpassword = $_POST['dpassword'];
    $demail = $_POST['demail'];
    $docFees = $_POST['docFees'];
    $query = "INSERT INTO doctb(username,password,email,docFees) VALUES('$doctor','$dpassword','$demail','$docFees')";
    $result = mysqli_query($con, $query);

    if ($result) {
        header("Location:adddoc.php");
    }
}

function display_admin_panel()
{
    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<style type="text/css">
    button:hover{cursor:pointer;}
    #inputbtn:hover{cursor:pointer;}
</style>
<body style="padding-top:50px;">
<div class="jumbotron" id="ab1"></div>
<div class="container-fluid" style="margin-top:50px;">
    <div class="row">
        <!-- Rest of your HTML/PHP code for the admin panel here -->
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<!--Sweet alert js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        swal({
            title: "Welcome!",
            text: "Have a nice day!",
            imageUrl: "images/sweet.jpg",
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: "Custom image",
            animation: false
        });
    });
</script>
</body>
</html>
HTML;
}

?>
 