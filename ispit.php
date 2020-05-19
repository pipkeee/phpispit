<?php
if(!file_exists("words.json"))
$file=fopen("words.json", "w");
?>


<form action='ispit.php' method='POST'>
Unesite rijec: <input type='text' name='x'><br>
<input type='submit' value='Pošalji'>
</form>


<?php
function brojSlova($x)
{
  $brS=0;
  for($i=0; $i<strlen($x); $i++)
  {
    if(ctype_alpha($x[$i]))
      $brS=$brS+1;
    else
      $brS=$brS;
  }
  return $brS;
}

function brojSamoglasnika($x)
{
  $brSa=0;
  $s=strtolower($x);
  for($i=0; $i<strlen($s); $i++)
  {
    if($s[$i]>='a' && $s[$i]<='z')
    {
      if($s[$i]=='a' || $s[$i]=='e' || $s[$i]=='i' || $s[$i]=='o' || $s[$i]=='u') $brSa++;
    }
  }
  return $brSa;
}

function brojSuglasnika($x)
{
  $brSu=0;
  $s=strtolower($x);
  for($i=0; $i<strlen($s); $i++)
  {
    if($s[$i]>='a' && $s[$i]<='z')
    {
      if($s[$i]!='a' && $s[$i]!='e' && $s[$i]!='i' && $s[$i]!='o' && $s[$i]!='u') $brSu++;
    }
  }
  return $brSu;
}

function unos($x)
{
  if(file_exists('words.json'))
  {
    $extra=$x;
    $final=json_encode($extra);
    if(file_put_contents('words.json', $final.PHP_EOL, FILE_APPEND))
    {
      echo "<br><br>Rijec je dodana u datoteku!<br><br>";
    }
  }
  else
  {
    echo "<br><br>Trazena datoteka ne postoji!<br><br>";
  }
}

if(isset($_POST['x']))
{
  $x=$_POST['x'];
  if(strlen($x)>0)
  {
    unos($x);
  }
  else{
echo "Molimo unesite vasu rijec ispravno!";
}
}

  echo "<td width='50%' align='center'>";
  echo "<table border=1 width='70%'>";
  echo "<tr><th>Rijec</th> <th>Broj slova</th> <th>Broj suglasnika</th> <th>Broj samoglasnika</th></tr>";
  $file=fopen("words.json", "r") or exit("Ne postoji JSON datoteka");
  if(filesize("words.json")!=0)
  {
    while(!feof($file))
    {
      $x=fgets($file);
      $xx=substr($x,1,(strlen($x)-3));
      $brojSlova=brojSlova($x);
      $brojSuglasnika=brojSuglasnika($x);
      $brojSamoglasnika=brojSamoglasnika($x);
      if($brojSlova!=0) echo "<tr align='center'> <td>$xx</td> <td>$brojSlova</td> <td>$brojSuglasnika</td> <td>$brojSamoglasnika</td></tr>";
    }
  }  
  fclose($file);
  echo "</table>";
 echo "</td></tr></table>";
?>
