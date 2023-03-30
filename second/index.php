<?php
//Подключаем класс
require_once './script/File.php';

//Создаем объект класса
$d = new File();

//Проверяем наличие файла внутри формы
if (!empty($_FILES['form-file'])) $d -> creatFile();

//Если кнопка удаления нажата, то выполняет тело условия, в данном случае - попытка удаления файла и первичная проверка
if (isset($_POST['done'])) $d -> deleteFile();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загрузка файла</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <section id="input-file">
            <input type="file" name="form-file">
            <input type="submit">
        </section>
    </form>
    <form action="" method="post" enctype="application/x-www-form-urlencoded">
        <section id="input-filename-info">
            <p>Для удаления файла - впишите его название.</p>
        </section>
        <section id="input-filename-text">
            <input type="text" name="filename" required>
            <input type="submit" name="done">
        </section>
    </form>
    <section>
        <p>Все файлы на сервере: </p>
    </section>

    <?php
        //По дизайну мне захотелось сделать вывод в нижней части экрана потому как мы не знаем кол-во файлов и их названия
        $d -> getData();
    ?>

</body>
<footer></footer>
</html>