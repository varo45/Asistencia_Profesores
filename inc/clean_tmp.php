<?php
$files = glob('tmp/*.png');
foreach($files as $file)
{
    if(is_file($file))
    {
        unlink($file);
    }
}