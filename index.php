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
<hr>
<h2>Inserisci Prestito</h2>
<form method="POST">
<input type="hidden" name="azione" value="prestito">
Libro:
<select name="id_libro">
<?php
$res = $conn->query("SELECT * FROM Libri");
while($l = $res->fetch_assoc()){
    echo "<option value='{$l['id_libro']}'>{$l['titolo']}</option>";
}
?>
</select>
Utente:
<select name="id_utente">
<?php
$res = $conn->query("SELECT * FROM Utenti");
while($u = $res->fetch_assoc()){
    echo "<option value='{$u['id_utente']}'>{$u['nome']} {$u['cognome']}</option>";
}
?>
</select>
Data fine:
<input type="date" name="data_fine" required>
<hr>
<h2>Prestiti per utente</h2>
<form method="GET">
<select name="utente">
<?php
$res = $conn->query("SELECT * FROM Utenti");
while($u = $res->fetch_assoc()){
    echo "<option value='{$u['id_utente']}'>{$u['nome']} {$u['cognome']}</option>";
}
?>
</select>
<button>Mostra</button>
</form>
<?php
if(isset($_GET['utente'])){
    $id = $_GET['utente'];
    $res = $conn->query("
        SELECT Prestiti.*, Libri.titolo
        FROM Prestiti
        JOIN Libri ON Prestiti.id_libro = Libri.id_libro
        WHERE id_utente = $id
    ");

    while($p = $res->fetch_assoc()){
        echo "<p>{$p['titolo']} - ";

        if($p['restituito']){
            echo "Restituito";
        } else {
            echo "<a href='?utente=$id&restituisci={$p['id_prestito']}'>Restituisci</a>";
        }

        echo "</p>";
    }
}
?>
<button>Salva</button>
</form>