<?php
if($_POST['benchmark']<100 || $_POST['price']<100 || $_POST['benchmark']>250000 || $_POST['price']>250000)
{
    echo "<div style=\"font-size:250%;text-align:center;\">Please give actual values <br/><a href=\"index.html\">Home</a></div>";
    throw new exception();
}
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
$O0=10000.0;
$O1=2.0;
$d0=2.0;
$d1=2.0;
$flag=true;
while(abs($d0)>1000 || abs($d1)>1000)
{
    $d0=diff0($O0,$O1,$x,$y);
    $d1=diff1($O0,$O1,$x,$y);
    $temp0=$O0-$d0*0.000000001;
    $temp1=$O1-$d1*0.000000001;
    $O0=$temp0;
    $O1=$temp1;
}
function diff0($O0,$O1,$x,$y)
{
    $sum=0.0;
    for($i=0;$i<count($x);$i++)
    {
        $sum=$sum+$O0+$O1*$x[$i]-$y[$i];
    }
    return $sum/((float)count($x));
}
function diff1($O0,$O1,$x,$y)
{
    $sum=0.0;
    for($i=0;$i<count($x);$i++)
    {
        $sum=$sum+($O0+$O1*$x[$i]-$y[$i])*$x[$i];
    }
    echo $sum;
    echo "<br/>";
    return $sum/((float)count($x));
}
$f=($O0)+($O1)*((float)$_POST['price']);
echo "<h1 style=\"text-align:center;font-size:400%\">RESULTS</h1>";
echo "<div style=\"text-align:center;font-size:200%\"<br/>Performance Per ₹ : ";
echo round(((float)$_POST['benchmark'])/((float)$_POST['price']),2);
echo "<br/><br/>Expected Benchmark :";
echo (int)$f;
echo "</div><br/><br/><div style=\"font-size:200%;text-align:center;\"><br/>";
if($f>((float)$_POST['benchmark'])*1.2)
{
    echo "<span style=\"color:red\">Not a very good choice of phone.</span><br/>";
}
elseif($f<((float)$_POST['benchmark'])*0.8)
{
    echo "<span style=\"color:green\">Excellent choice of phone!</span><br/>";
}
else
{
    echo "<span style=\"color:blue\">Good choice.</span><br/><br/>";
}
echo "<a href=\"index.html\">Home</a></div>";
$write=fopen('rawdata.txt','a');
fwrite($write,"\n");
fwrite($write,$_POST['price']);
fwrite($write,"\n");
fwrite($write,$_POST['benchmark']);
?>
