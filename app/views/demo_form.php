<!DOCTYPE html>
<html>
<head>
    <title>Página de formulário</title>
</head>
<body>
    <h1>Página de formulário</h1>
    <form action="<?=$url?>" method="post">
        <?=$csrf_token?>
        <label>Nome:</label><br>
        <input type="text" name="name"><br>
        <br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>