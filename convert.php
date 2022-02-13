<?php
session_start();
include('Classes/User.php');
include('Classes/Converter.php');

if(isset($_POST['change_user']) && $_POST['change_user'] == true) {
    $_SESSION['user'] = null;
    header("Location: index.php");
}
// Process unit conversion
if(isset($_POST['unit']) && $_POST['quantity'] != 0) {
    
    $converter =  new Converter($_POST['unit'], $_POST['quantity']);
    $converted = $converter->convert();  
    
    $unit = explode("_",$_POST['unit']);

    $history = [
        'unit_from' => $unit[0],
        'unit_to' => $unit[1],
        'quantity' => $_POST['quantity'],
        'converted' => $converted
    ];

    $converter->saveToHistory($_SESSION['user']['id'], $history);

    header("Location: index.php?unit=" . $_POST['unit'] . "&quantity=" . $_POST['quantity'] . "&value=" . $converted);
}