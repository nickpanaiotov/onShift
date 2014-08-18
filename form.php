<form method="POST">
    <?php echo'<td colspan="4">'?>

    <?php echo'</td>'?>
    <?php echo'<td colspan="1">'?>
    <select name="shift" required="true">
        <option value="1">Смяна А</option>
        <option value="2">Смяна Б</option>
        <option value="3">Смяна В</option>
        <option value="4">Смяна Г</option>
    </select>
    <?php echo'</td>'?>

    <?php echo'<td colspan="1">'?>
    <select name="month" required="true">
        <option value="" disabled>Месец</option>
        <option value="01">Януари</option>
        <option value="02">Февруари</option>
        <option value="03">Март</option>
        <option value="04">Април</option>
        <option value="05">Май</option>
        <option value="06">Юни</option>
        <option value="07">Юли</option>
        <option value="08">Август</option>
        <option value="09">Септември</option>
        <option value="10">Октомври</option>
        <option value="11">Ноември</option>
        <option value="12">Декември</option>
    </select>
    <?php echo'</td>'?>

    <?php echo'<td>'?>
    <input type="submit" value="Избери">
    <?php echo'</td>'?>
</form>
<?php
$url = 'calendar.php';

$field1=0;
$field2=1;

$fields = array(
    'shift'=> $field1,
    'month'=> $field2,
);
$postvars = http_build_query($fields);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, count($fields));
curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);

$result = curl_exec($ch);

curl_close($ch);

