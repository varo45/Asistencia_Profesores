<?php

function limpia($directorio)
{
  $dir=opendir($directorio);
  while($file=readdir($dir))
  {
  echo "$file <br>";
    if (preg_match('/png$/',$file))
    {
      if (! file_exists('tmp/'.$file.'.lock'))
	unlink('tmp/'.$file);
    }
  }
}

  if (! file_exists('/usr/bin/qrencode'))
    die('<h4>Hay que instalar qrencode</h4>');

switch ($_REQUEST['op'])
{
  default:
    limpia('./tmp');

    echo "<form action='$_SERVER[PHP_SELF]' method='post'>";
    echo "<textarea name='content'>";

    echo "</textarea>";
    echo "<input type='submit' name='op' value='Generar' />";

    echo "</form>";
    break;

  case "Generar":

  ob_clean();

  $fichero=uniqid().".png";

  system ("qrencode -d 144 -s 5 '$_REQUEST[content]' -o tmp/$fichero");
  touch('tmp/'.$fichero.'.lock');

  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename='.$fichero);
  header('Content-Transfer-Encoding: binary');
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize("tmp/$fichero"));
  
  echo "<img src='tmp/$fichero' alt='$_REQUEST[content]' />";

  readfile("tmp/$fichero");

  unlink("tmp/$fichero".".lock");
   

  break;
}