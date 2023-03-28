<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First</title>
    <link rel="stylesheet" href="/first/style.css" type="text/css">
</head>

<body>
    <form action="" method="post" id="input">
        <section id="input-data">
            <section id="input-data-name" class="center direction bottom size">
                <input class="input-field" type="text"  name="name" placeholder="Имя">
            </section>
            <section id="input-data-surname" class="center direction bottom size">
                <input class="input-field" type="text"  name="surname" placeholder="Фамилия">
            </section>
            <section id="input-data-mail" class="center direction bottom size">
                <input class="input-field" type="text" name="mail" data-required="true"  data-symbol="@" placeholder="E-mail">
            </section>
            <section id="input-data-number" class="center direction bottom size">
                <input id="input-data-number-input" class="input-field" type="tel" name="number" data-required="true"
                       data-number="+7" data-min-length="6" maxlength="13" placeholder="Phone">
            </section>
        </section>
        <section id="input-btn" class="center">
            <button id="input-btn-submit" type="submit" name="btn"">Далее</button>
        </section>
    </form>
</body>

<footer>
    <script src="main.js"></script>
</footer>

</html>