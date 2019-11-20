<?php function draw_header($title) {  ?>
    <!DOCTYPE html>
        <html lang="en-US">
        <head>
            <title><?=$title?></title>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.min.css">            <link rel="stylesheet" href="../styles/nav_bar.css">
            <link rel="stylesheet" href="../styles/login.css">
            <link rel="stylesheet" href="../styles/body.css">
        </head>
        <body>
<?php } ?>

<?php function draw_footer() { ?>
        </body>
    </html>
<?php } ?>