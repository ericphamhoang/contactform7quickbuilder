<?php
/**
 * Created by PhpStorm.
 * User: nikon_000
 * Date: 12/29/2016
 * Time: 12:20 PM
 */

function string_sanitizer($string)
{
    return preg_replace('~[^A-Za-z0-9]~','',$string);
}

function get_value($var)
{
   if (isset($var))
 return $var;
    else return '';
}

$datas = json_decode(file_get_contents(__DIR__.'/data.json'), 1);

$rs = "";

foreach ($datas as $data)
{
    ob_start();
    ?>
    [<?php echo $data['type']?><?php if (@get_value($data['required'])) echo "*"?> <?php echo string_sanitizer(get_value($data['name']))?> class:<?php echo @get_value($data['class'])?> placeholder "<?php echo get_value($data['name'])?><?php if (@get_value($data['required'])) echo "*"?> "]
<?php
    $rs .= trim(ob_get_clean());
}

?>
    <textarea cols="30" rows="10">

        <?php echo $rs;?>

    </textarea>
<?php

echo "<br>";

echo "Mail <br>";

$rs = "";

foreach ($datas as $data)
{
    ob_start();
    ?>
    <p>
        <?php echo get_value($data['name'])?>: [<?php echo string_sanitizer(get_value($data['name']))?>]
    </p>

    <?php
    $rs .= trim(ob_get_clean());
}

echo $rs;