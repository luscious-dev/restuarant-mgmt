<?php

$variable = -1.7E-4;
echo 'Integer: ';
echo (integer)$variable;
echo '<br>';
echo 'Float: ';
echo (float)$variable;
echo '<br>';
echo 'Boolean: ';
echo (boolean)$variable;
echo '<br>';
echo 'String: ';
echo (string)$variable;
echo '<br>';

$coursecode = array("COSC400", "COSC405", "COSC408");
$CODE= "coursecode";
$COSC400="Project";
$COSC405="Web Application Engineering II";
$COSC408="Compiler Construction";
$o = "DEVELOPER CONFUSION :(";
echo '<br>';
echo ${$coursecode[1]}; //what will be the output?
echo '<br>';
echo ${$CODE}[1]; //what will be the output?
echo '<br>';
echo $$CODE[1];
$wale = $GLOBALS;
echo $wale['coursecode']

for($i=2;$i<5;$i++){
    echo  'wale';
}
?>