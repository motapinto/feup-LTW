<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../database/rents.php');      // properties functions
    
    if(!isset($_SESSION['id']) || isset($_GET['id']) || isset($_GET['daterange']) || isset($_GET['adults']) || isset($_GET['children']) || isset($_GET['babies']))
        header('Location: ../listings/listings_all.php');    
        
    $id = $_GET['id'];
    $daterange = $_GET['daterange'];
    $adults = $_GET['adults'];
    $children = $_GET['children'];
    $babies = $_GET['babies'];

    htmlentities($id, ENT_QUOTES, 'UTF-8');
    htmlentities($adults, ENT_QUOTES, 'UTF-8');
    htmlentities($children, ENT_QUOTES, 'UTF-8');
    htmlentities($babies, ENT_QUOTES, 'UTF-8');

    if(preg_match('/([0-9]{2})\/([0-9]{2})\/([0-9]{4}) - ([0-9]{2})\/([0-9]{2})\/([0-9]{4})/', $_GET['daterange'], $output_array)){
        $date_init = $output_array[3] . '-' . $output_array[2] . '-' . $output_array[1];
        $date_final = $output_array[6] . '-' . $output_array[5] . '-' . $output_array[4];
    }
    else {
        header("Location: ../listings/item.php?id=$id");
    }

    $result = addRent($_SESSION['id'], $id, $date_init, $date_final, 
                $adults, $children, $babies);
    
    if($result !== false){
        $id = $result['id'];
        header("Location: ../listings/item.php?id=$id");
    }

    $_SESSION['err_msg'] = "Failled to add property";
    header('Location: ../properties/add_property.php');
?>