<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script src="machine.js"></script>
 <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
 <h1 class="text-center">IsYourPhoneWorthIt?</h1>
 <nav class="navbar navbar-default">
   <ul class="nav navbar-nav navbar-center" style="margin:10px">
    <li><a href="index.html">Home</a></li>
    <li class="active"><a href="data.php">Data</a></li>
    <li><a href="details.html">How it works</a></li>
   </ul>
 </nav>
<?php
$j=0;
$k=0;
$i=0;
$read=file('rawdata.txt');
foreach($read as $line){
    if((int)$line==0)
        break;
    if($i%2==0){
        $x[$j]=(float)$line;
        $j++;
    }
    else{
        $y[$k]=(float)$line;
        $k++;
    }
    $i++;
}
for($i=0;$i<count($x);$i++)
{
    $flaggy=true;
    for($j=0;$j<count($x)-$i-1;$j++)
    {
        if($x[$j]>$x[$j+1])
        {
            $flaggy=false;
            $temp=$x[$j];
            $x[$j]=$x[$j+1];
            $x[$j+1]=$temp;
            $temp=$y[$j];
            $y[$j]=$y[$j+1];
            $y[$j+1]=$temp;
        }
    }
    if($flaggy)
        break;
}
echo "<div class=\"table-responsive\"><table class=\"table table-bordered\"><thead><tr><th style=\"width:50%\">Prices</th><th style=\"width:50%;\">Benchmark</td></tr></thead><tbody>";
for($i=0;$i<count($x);$i++)
{
    echo "<tr><td>";
    echo $x[$i];
    echo "</td><td>";
    echo $y[$i];
    echo "</td></tr>";
}
echo "</tbody></table></div>";
?>
</body>
</html>