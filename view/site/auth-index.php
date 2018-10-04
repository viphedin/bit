<div style="margin: 0 auto; width: 40%">
    <p>Пользователь <?php echo $user->login; ?></p>
    <p>На счету <?php echo $account->amount; ?> руб.</p
    <br />
    <br />
    <h3>Перевести</h3>
    <form action="/transaction" method="GET">
        <div class="form-group">
            <label for="login">Сумма:</label>
            <input type="text" class="form-control" name="amount">
        </div>

        <button type="submit" style="float: right;">Выполнить</button>
        <br style="clear: both;"/>
    </form>
</div>