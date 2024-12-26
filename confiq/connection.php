<?php

function connect (){
try {
    $connection = new PDO("mysql:host=localhost;dbname=facebooks", "mukul01", "mukul01");
    return $connection;
} catch (PDOException $error) {
   echo $error->getMessage();
}
}

?>