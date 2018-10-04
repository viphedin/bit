<div style="margin: 0 auto; width: 40%">
    <form action="/login" method="POST">
        <?php if ($error) { ?><span class="error float-right">Wrong login or password</span><?php } ?>
        <div class="form-group">
            <label for="login">Логин:</label>
            <input type="text" class="form-control" name="login" value="<?php echo $form->login; ?>">
        </div>
        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" class="form-control" name="password" value="<?php echo $form->password; ?>">
        </div>

        <button type="submit" style="float: right;">Войти</button>
        <br style="clear: both;"/>
    </form>
</div>