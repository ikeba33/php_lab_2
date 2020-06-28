<?php

require_once __DIR__ . '/core/main_functions.php';

if(!isGuest()) {
    redirectToProfile(getUser());
}

$login = $password = $error = '';

if(!empty($_POST)) {
    $user_o = new \core\Users();

    $login = $_POST['login'];
    $password = $_POST['password'];
    
    $user = $user_o->getUserFromLoginAndPassword($login, $password);
    
    if($user == null) {
        $error = 'Неправильные данные для входа!';
    } else {
        if(isset($_POST['lang'])) {
            $user->setLang($_POST['lang']);
        }
    
        if($user->getLang()) {
            logIn($user->getLogin(), $user->getPassword());
            setLang($user->getLang());
            $error = redirectToProfile($user);
        } else {
            $error = 'Пожалуйста выберите язык для входа!';
            $languages = getLanguageSelect();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lab2</title>
        <link rel="stylesheet" type="text/css" href="/styles.css">
    </head>
    <body>
    <div class="content">
        <div class="block">
            <form action="/" method="POST">
                <div style="color: red; text-align: center;">
                    <?= $error ?>
                </div>
                <div>
                    <label>Логин:</label>
                    <input type='text' name='login' value='<?=$login?>'>
                </div>
                <div>
                    <label>Пароль:</label>
                    <input type='text' name='password' value='<?=$password?>'>
                </div>
                <?php if(isset($languages)) { ?>
                    <div>
                        <label>Язык:</label>
                        <?= $languages ?>
                    </div>
                <?php } ?>
                <div class="btn-block">
                    <button type="submit">
                        Войти
                    </button>
                </div>
            </form>
       </div>
    </div>
    </body>
</html>

