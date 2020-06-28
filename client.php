<?php

require_once __DIR__ . '/core/main_functions.php';

use \core\Users;

checkPermissions([Users::ROLE_CLIENT, Users::ROLE_ADMIN, Users::ROLE_MANAGER]);

$lang = new \core\Language();

$lang->setCurrentLanguage(getLang());

$user = getUser();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Client profile</title>
        <link rel="stylesheet" type="text/css" href="/styles.css">
    </head>
    <body>
    <header>
        <?= createNav($user) ?>
        <div class="logout-btn">
            <a href="/logout"><?=$lang->translate('logout') ?></a>
        </div>
        <?= getLangBlock() ?>
    </header>
    <div class="content">
        <div class="block">
            <h1>Client profile</h1>
            <h3>
                <?= $lang->translate($user->getMessage(), ['{role}' => $lang->translate($user->getRole()), '{name}' => $user->getFullName()]) ?>
            </h3>
       </div>
    </div>
    </body>
</html>