<!DOCTYPE html>
<html>
<head>
    <title>Página de Exemplo</title>
</head>
<body>
    <h1>Página de Exemplo</h1>
    <ul>
        <?php
        foreach ($examples as $key => $example) {
            echo $example->id . ': ' . $example->name . '<br>';
        }
        ?>
    </ul>
</body>
</html>