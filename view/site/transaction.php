<center>
    <h3>
<?php

if ($result) {
    echo 'Списание прошло успешно';
} else {
    echo '<span style="color: red">' . $message . '</span>';
}

?>
</h3>
<br /><br />
<a href="/">Назад</a>
</center>