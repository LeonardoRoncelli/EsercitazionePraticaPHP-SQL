<?php
$conn = new mysqli("localhost", "root", "", "roncelli_biblioteca");
if ($conn->connect_error) {
    die("Errore connessione");
}
if(isset($_POST['azione']) && $_POST['azione'] == 'prestito'){
    $conn->query("INSERT INTO Prestiti (id_libro, id_utente, data_inizio, data_fine_prevista)
                  VALUES ('$_POST[id_libro]', '$_POST[id_utente]', CURDATE(), '$_POST[data_fine]')");
}
?>
<?php
if(isset($_POST['azione']) && $_POST['azione'] == 'libro'){
    $conn->query("INSERT INTO Libri (titolo, anno_pubblicazione, isbn, id_autore)
                  VALUES ('$_POST[titolo]', '$_POST[anno]', '$_POST[isbn]', '$_POST[id_autore]')");
}
?>
<h1>Gestione Biblioteca</h1>
<h2>Inserisci Libro</h2>
<form method="POST">
<input type="hidden" name="azione" value="libro">
Titolo: <input name="titolo" required>
Anno: <input name="anno">
ISBN: <input name="isbn">
Autore:
<select name="id_autore">
<?php
$res = $conn->query("SELECT * FROM Autori");
while($a = $res->fetch_assoc()){
    echo "<option value='{$a['id_autore']}'>{$a['nome']} {$a['cognome']}</option>";
}
?>
</select>

<button>Salva</button>
</form>