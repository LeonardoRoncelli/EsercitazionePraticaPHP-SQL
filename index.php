<?php
$conn = new mysqli("localhost", "root", "", "roncelli_biblioteca");
if ($conn->connect_error) {
    die("Errore connessione");
}
?>
<h1>Gestione Biblioteca</h1>