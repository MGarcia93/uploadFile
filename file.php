<?php
echo "algo";
if (!empty($_FILES)) {
    foreach ($_FILES as $file)
        var_dump($file);
}
