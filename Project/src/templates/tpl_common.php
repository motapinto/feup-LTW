<?php function draw_header($title) {  ?>
    <!DOCTYPE html>
        <html lang="en-US">
        <head>
            <title><?=$title?></title>
            <meta charset="UTF-8">
            <script src="https://kit.fontawesome.com/2ebd8c9c01.js" crossorigin="anonymous"></script>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">           
            <link rel="stylesheet" href="../styles/nav_bar.css">
            <link rel="stylesheet" href="../styles/login.css">
            <link rel="stylesheet" href="../styles/body.css">
<!--************************ ITEM  ************************-->
            <link rel="stylesheet" href="../styles/item.css">
            <script src="../scripts/item.js"></script>
<!--************************ PROFILE  ************************-->
            <link rel="stylesheet" href="../styles/profile.css">
            <script src="../scripts/profile.js"></script>
        </head>
        <body>
<?php } ?>

<?php function draw_footer() { ?>
        </body>
    </html>
<?php } 

function draw_rating($rating) { 
    for($i = 0; $i < 5; $i++){
        if ($rating <= 0) { ?>
            <i class="material-icons"> star_border</i>
        <?php }
        else if ($rating <= 0.5) { ?>
            <i class="material-icons"> star_half</i>
        <?php }
        else { ?>
            <i class="material-icons"> star</i>
        <?php }
        $rating -= 1;
    }
} ?>