<?php
function getPokemon($pokemon_name) {
    $url = 'https://pokeapi.co/api/v2/pokemon/' . strtolower($pokemon_name);
    
    // Make GET request to PokeAPI
    $response = file_get_contents($url);
    
    if ($response === false) {
        return false;
    }
    
    // Decode JSON response
    $pokemon_data = json_decode($response, true);
    
    return $pokemon_data;
}

// Handle form submission
if (isset($_POST['pokemon_name'])) {
    $pokemon_name = $_POST['pokemon_name'];
    $pokemon_data = getPokemon($pokemon_name);
    
    // Display Pokémon details
    if ($pokemon_data !== false) {
        $name = ucfirst($pokemon_data['name']);
        $image_url = $pokemon_data['sprites']['front_default'];
        $type = $pokemon_data['types'][0]['type']['name'];
        $height = $pokemon_data['height'] / 10; // Convert to meters
        $weight = $pokemon_data['weight'] / 10; // Convert to kilograms
        
        echo '<div class="pokemon-card">';
        echo '<h2>' . $name . '</h2>';
        echo '<img src="' . $image_url . '" alt="' . $name . '">';
        echo '<p><strong>Type:</strong> ' . ucfirst($type) . '</p>';
        echo '<p><strong>Height:</strong> ' . $height . ' m</p>';
        echo '<p><strong>Weight:</strong> ' . $weight . ' kg</p>';
        echo '</div>';
    } else {
        echo '<p>Pokémon not found.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Search</title>
    <style>
        .pokemon-card {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }
        .pokemon-card img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Pokémon Search</h1>
    <form action="" method="post">
        <label for="pokemon_name">Enter Pokémon Name:</label>
        <input type="text" id="pokemon_name" name="pokemon_name" required>
        <button type="submit">Search</button>
    </form>
</body>
</html>
