<?php
session_start();
$conn = new mysqli("localhost", "root", "", "babarossa");
$msg="";

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = sha1($password);
    $userType = $_POST['userType'];

    $sql = "SELECT * FROM user WHERE username=? AND password=? AND user_type=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $userType);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    session_regenerate_id();
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['user_type'];
    session_write_close();

    if($result->num_rows==1 && $_SESSION['role'] == "cyril") {
        header("location: admin.php");
    }else if($result->num_rows==1 && $_SESSION['role'] == "kingsley") {
        header("location: finance.php");
    }else if($result->num_rows==1 && $_SESSION['role'] == "collins") {
        header("location: sales.php");
    }
    else{
        $msg = "Username or Password is incorrect";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Links of CSS files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="assets/css/nice-select.min.css">
    <link rel="stylesheet" href="assets/css/fancybox.min.css">
    <link rel="stylesheet" href="assets/css/odometer.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background-color: black;">
    <div class="container">
    <h3 style="text-align: center; margin-top: 10px; color: #008000">Amazing Grace Parish</h3>
        <div class="box" style="margin: 5% auto;">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <img src="assets/img/logo.gif" style="width: 75%; margin-left: 40px;" alt="img">
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="contact-form">
                    <h3 class="text-center text-light bg-success p-3">Admin role login system</h3>
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" style="color: #222;">
                            <p id="myParagraph" style="color: #d4af37">Enter your details here</p>
                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control" placeholder="Username">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Your password">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="userType" style="color: #008000;"><b>I'm :</b></label>
                                        <input type="radio" name="userType" value="cyril" class="custom-radio" required>&nbsp;<b style="color: #008000;">Admin |</b>
                                        <input type="radio" name="userType" value="kingsley" class="custom-radio" required>&nbsp;<b style="color: #008000;">Finance |</b>
                                        <input type="radio" name="userType" value="collins" class="custom-radio" required>&nbsp;<b style="color: #008000;">Sales |</b>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <button type="submit" class="default-btn" style="box-shadow: 10px 5px 5px rgba(0, 0, 0, 0.25); background-color: #008000;" name="login">Login</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>

                            </div>
                            <h5 class="text-danger text-center"><?= $msg; ?></h5>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>