<?php
    $v = '?v1.1';
?>
<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="assets/js/vue.js"></script>
        <script type="text/javascript" src="assets/js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="assets/js/axios.min.js"></script>
        <script type="text/javascript" src="assets/js/global.js<?php echo $v; ?>"></script>
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-select.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome-4.7.0/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/auth.css<?php echo $v; ?>">
        <title>Login To Your Account</title>
    </head>
    <?php        
        // if(isset($_SESSION['user_userid'])){
        //     header('Location: home.php#ajax/dashboard.php');
        // }
        require_once 'auth/login.php';
        require_once 'auth/forgot-password.php';
        require_once 'auth/register.php';
    ?>
    <body>      
        <div id="authApp">
            <component :is="currentTemplate"></component>
        </div>
    </body>
</html>
<script type="text/javascript" src="assets/js/auth.js<?php echo $v; ?>"></script>
