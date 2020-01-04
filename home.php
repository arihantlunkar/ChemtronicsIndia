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
        <link rel="stylesheet" type="text/css" href="assets/css/main.css<?php echo $v; ?>">
        <title>Chemtronics India</title>
    </head> 
    <?php
        require_once 'components/vue-navbar.php';
    ?>   
    <body>        
        <div id="mainPage">
            <vue-navbar></vue-navbar>
            <component :is="currentTemplate" v-if="currentTemplate"></component>
        </div>
        <main id="content" class="container-fluid"></main>
    </body>
</html>
<script type="text/javascript" src="assets/js/main.js<?php echo $v; ?>"></script>
