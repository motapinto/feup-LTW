<?php function draw_header($title, $script = NULL) {  ?>
    <!DOCTYPE html>
        <html lang="en-US">
        <head>
            <title><?=$title?></title>
            <meta charset="UTF-8">
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">           
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

            <!--**************************** DATE RANGE ******************************-->
            <script type="text/javascript" src="../../assets/daterange/moment.min.js"></script>
            <script type="text/javascript" src="../../assets/daterange/daterangepicker.js"></script>
            <link rel="stylesheet" type="text/css" href="../../assets/daterange/daterangepicker.css" />
            <!--**************************** FONTAWESOME *****************************-->
            <script src="../../assets/fontawesome/js/all.js"></script>
            <link rel="stylesheet" href="../../assets/fontawesome/css/all.css">
            <!--************************ MATERIALIZE INPUTS  *************************-->
            <script src="../../assets/materialize/js/materialize.min.js"></script>
            <link rel="stylesheet" href="../../assets/materialize/css/materialize.css">
            <!--************************ DOUBLE RANGE SLIDER  *************************-->
            <link rel="stylesheet" href="../../assets/materialize/extras/noUiSlider/nouislider.css">
            <script src="../../assets/materialize/extras/noUiSlider/nouislider.js"></script>
            <!--************************ PHOTO GALLERY LIB ****************************-->
            <script src="./../assets/galleria/dist/galleria.min.js"></script>

<!--************************ COMMON  *************************-->
            <link rel="stylesheet" href="../styles/body.css">
            <script src="../scripts/common.js" defer></script>
            <link rel="stylesheet" href="../styles/nav_bar.css">
<!--************************* HOME  **************************-->
            <link rel="stylesheet" href="../styles/listings.css">            
            <link rel="stylesheet" href="../styles/filter.css">
<!--********************** PROPERTIES  ***********************-->
            <link rel="stylesheet" href="../styles/properties.css">
<!--******************** AUTHENTICATION  *********************-->
            <link rel="stylesheet" href="../styles/authentication.css">
<!--************************* ITEM  **************************-->
            <link rel="stylesheet" href="../styles/item.css">
<!--************************ PROFILE  ************************-->
            <link rel="stylesheet" href="../styles/profile.css">
<!--************************ MESSAGES  ************************-->
            <link rel="stylesheet" href="../styles/messages.css">
            <link rel="stylesheet" href="../styles/item.css">

            <?php if($script !== NULL){ ?>
                <script src="../scripts/<?=$script?>.js" defer></script>  
            <?php } ?>
        </head>
        <body>
<?php } ?>

<script>
(function() {
                if (Galleria) { $("body").text('Galleria works') }
            }());

</script>

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
} 

function encodeForAJAX($array){
    print('{');
    foreach ($array as $key => $value) {
        print(' "'.$key.'"'.':'.$value.' ');
    }
    print('}');
}
?>