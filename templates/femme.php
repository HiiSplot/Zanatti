<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://kit.fontawesome.com/96b8dfd23b.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200;12..96,300;12..96,400;12..96,500;12..96,600;12..96,700;12..96,800&family=Caprasimo&family=Gabarito:wght@400;500;600;700;800;900&family=Hedvig+Letters+Serif:opsz@12..24&display=swap" rel="stylesheet">
    <title>ZANATTI - Femme</title>
</head>
<body>
<div class="flexbox">
    <?php require('../templates/layout/header.php'); ?>

    <?php

    function generate_clothing() {
        $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $name_options = ['Pantalon', 'T-shirt', 'Pull', 'Jupe', 'Veste', 'Jean', 'Débardeur', 'Robe', 'Short', 'Chemise'];
        $composition_options = ['Coton', 'Laine', 'Lin', 'Cuir', 'Polyester', 'Elasthanne', 'Viscose'];

        $name_index = array_rand($name_options);
        $name = ucfirst($name_options[$name_index]);
        $price = number_format(round(rand(10, 100) + (rand(0, 99) / 100)));
        $selected_sizes = [];

        // Sélection aléatoire des tailles
        $num_sizes = rand(1, count($sizes));
        for ($i = 0; $i < $num_sizes; $i++) {
            $selected_sizes[] = $sizes[$i];
        }

        // Sélection aléatoire d'une composition
        $selected_composition = $composition_options[array_rand($composition_options)];

        // Associer chaque nom de vêtement à un nom de fichier d'image
        $image_mapping = [];

        for ($i = 0; $i < count($name_options); $i++) {
            $image_mapping[$name_options[$i]] = "img" . $i . ".jpg";
        }

        $image_filename = isset($image_mapping[$name]) ? $image_mapping[$name] : 'default.jpg';

        return [
            'id' => $name_index,
            'name' => $name,
            'price' => $price,
            'sizes' => $selected_sizes,
            'composition' => $selected_composition,
            'image' => $image_filename
        ];
    }

    $clothing_list = [];
    for ($i = 0; $i < 100; $i++) {
        $clothing_list[] = generate_clothing();
    }

    $json_data = json_encode($clothing_list, JSON_PRETTY_PRINT);

    file_put_contents('clothing_data.json', $json_data);

    echo '<div class="flex-container">';
    foreach ($clothing_list as $clothing) {

        echo '<a class="article" href="">';
        echo '<div class="vetement-femmes">';
        echo '<img src="assets/img/' . $clothing['image'] . '">';
        echo '<div class="padding"></div>';
        echo '<h3>' . $clothing['name'] . '</h3><br>';
        echo '<p>' . $clothing['price'] . '€ </p><br>';
        echo '<select>';
        foreach ($clothing['sizes'] as $size) {
            echo '<option>';
            echo $size . '<br>';
            echo '</option>';
        }
        echo '</select>';
        echo '<div class="padding"></div>';
        echo '<p>Composition : ' . $clothing['composition'] . '</p>';
        echo '<div class="padding"></div>';
        echo '<button class="button_slide slide_right">Ajouter au panier <i class="fa-solid fa-cart-shopping"></i></button>';
        echo '<div class="padding"></div>';
        echo '<div class="padding"></div>';
        echo '</div>';
        echo '</a>';
    }
    echo '</div>'

    ?>




    <?php require('../templates/layout/footer.php'); ?>
</div>
</body>
</html>
