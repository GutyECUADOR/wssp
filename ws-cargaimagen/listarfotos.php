<?PHP
include ("config.php");
?>

<?
$resultado = mysql_query("SELECT * FROM fotos ORDER BY id ASC");
while($row=mysql_fetch_array($resultado))
{

echo "$row[id]";
echo "<br>"; 
?>

<img src="<? echo "$row[Foto1]"; ?>" width="100" height="100" />

<?
echo "<br>";  

}
?>