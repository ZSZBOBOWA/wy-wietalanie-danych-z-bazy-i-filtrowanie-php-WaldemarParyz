<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method="POST" action="index.php">
    Wpisz nazwisko: <input type="text" name="nazwisko">
    <input type="submit" value="Filtruj">
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "szkola";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Błąd połączenia: " . mysqli_connect_error());
}

if(isset($_POST['nazwisko']) && $_POST['nazwisko'] != '') {
    $nazwisko = $_POST['nazwisko'];
    $nazwisko = mysqli_real_escape_string($conn, $nazwisko);

    $sql = "SELECT * FROM uczniowie WHERE nazwisko='$nazwisko'";
    
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table border='1'><tr><th>Imię</th><th>Nazwisko</th><th>Wiek</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>".$row["imie"]."</td><td>".$row["nazwisko"]."</td><td>".$row["wiek"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Brak wyników";
    }
} else {
    echo "Nie wpisałeś nazwiska";
}

mysqli_close($conn);
?>
</body>
</html>
