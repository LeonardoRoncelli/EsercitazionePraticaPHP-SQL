<?php
$conn = new mysqli("localhost", "root", "", "roncelli_biblioteca");
if ($conn->connect_error) {
    die("Errore connessione");
}
?>
<?php
if(isset($_POST['azione']) && $_POST['azione'] == 'libro'){
    $conn->query("INSERT INTO Libri (titolo, anno_pubblicazione, isbn, id_autore)
                  VALUES ('$_POST[titolo]', '$_POST[anno]', '$_POST[isbn]', '$_POST[id_autore]')");
}
?>
<h1>Gestione Biblioteca</h1>