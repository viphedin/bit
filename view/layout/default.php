<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo \core\App::$app->assets->getHeader(); ?>
    </head>
    <body>
        <div class="header">
            <div class="wrapper">
                <div class="auth-block"><?php \app\widget\User::widget(); ?></div>
                <div class="title">Мои финансы</div>
            </div>
        </div>
        <?php echo $content; ?>
    </body>
</html>