<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schroniska</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #e9eff1;
    color: #333;
    margin: 0;
    padding: 20px;
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 0 auto;
    max-width: 800px;
}

.shelter {
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 10px;
    width: 100%;
    margin-bottom: 30px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease-in-out;
}

.shelter:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.shelter img {
    width: 100%;
    height: auto;
    border-radius: 10px;
    margin-bottom: 15px;
}

.shelter h3 {
    margin-top: 0;
    color: #0056b3;
    font-size: 24px;
}

.shelter p {
    color: #555;
    line-height: 1.6;
}


.shelter p:first-child {
    font-weight: bold;
    color: #ff00ff; 
}


.shelter p:nth-child(3), 
.shelter p:nth-child(4) {
    font-style: italic;
    color: #007600; 
}
.shelter button {
    background-color: #0056b3;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 15px;
    transition: background-color 0.3s;
}

.shelter button:hover {
    background-color: #004494;
}


    </style>
</head>
<body>

<div class="container">
    <?php
    require('./connection.php');
    
    try {
        $query = animalover::connect()->prepare("SELECT * FROM shelter");
        $query->execute();
        $shelters = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($shelters as $shelter) {
            echo "<div class='shelter'>";
            echo "<img src='" . htmlspecialchars($shelter['Img']) . "' alt='Zdjęcie schroniska'>";
            echo "<h3>" . htmlspecialchars($shelter['ShelterName']) . "</h3>";
            echo "<p>Lokalizacja: " . htmlspecialchars($shelter['Location']) . "</p>";
            echo "<p>Telefon: " . htmlspecialchars($shelter['Phone']) . "</p>";
            echo "<p>Miasto: " . htmlspecialchars($shelter['City']) . "</p>";
            echo "<p>" . htmlspecialchars($shelter['Description']) . "</p>";
            echo "<button onclick='location.href=\"view-animals.php?shelterId=" . $shelter['ID'] . "\"'>Wyświetl zwierzęta tego schroniska</button>";
            echo "</div>";
        }
    } catch (PDOException $e) {
        echo "Błąd połączenia: " . $e->getMessage();
    }
    ?>
    
</div>

</body>
</html>
