<h1>DS : php rocher</h1>
<h2>Vincent Rocher CIR 2</h2>
<hr>
<hr>
<h2>exercice : 1</h2>
<?php
echo"<h3>1.</h3>";
$phrase = "Engage le jeu que je le gagne";
function isPalindrome($phrase){
    $text = str_replace(" ","",strtolower($phrase));
    $textreverse=strrev($text);
    if($text==$textreverse){
        return true;
    }else{
        return false; 
    }
}
echo isPalindrome($phrase);
echo"<h3>2.</h3>";
$phrase = "Bonjour Madame";
function biggestPalindrome($phrase){
    $text = str_replace(" ","",strtolower($phrase));//on enlèvre les espaces et on mets en minuscule
    $len=strlen($text);
    $biggestPalindrome="";
    for($i=0; $i<$len-1;$i++){
        for($j=$i+1; $j<$len;$j++){
            if($text[$i]==$text[$j] && $i!=$j){ 
                if(isPalindrome(substr($text,$i,$j-$i+1)) && strlen(substr($text,$i,$j-$i+1))>strlen($biggestPalindrome)){
                    $biggestPalindrome=substr($text,$i,$j-$i+1);
                }
            }
        }
    }

    if(strlen($biggestPalindrome)==0){
        return 'wrong';
    }else{
        return $biggestPalindrome;
    }
}
echo biggestPalindrome($phrase);
?>
<hr>
<h2>exercice : 2</h2>
<?php
echo"<h3>1.</h3>";
function chiffrementROT13($text){
    $lens = strlen($text);
    $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for($pos=0; $pos<$lens;$pos++){
        if(strpos($charset,$text[$pos])!==FALSE){
            $num = strpos($charset,$text[$pos]);
            if (($num+13)>=26){
                $stock = $num+13 - 26;
            }else{
                $stock = $num+13;
            }
        }
        $text[$pos] = $charset[$stock];
    }
    return $text;
}
echo"<h3>2.</h3>";
function dechiffrementROT13($text){
    $lens = strlen($text);
    $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $stock =0;
    for($pos=0; $pos<$lens;$pos++){
        if(strpos($charset,$text[$pos])!==FALSE){
            $num = strpos($charset,$text[$pos]);
            if (($num-13)<0){
                $stock = 26+($num-13);
            }else{
                $stock = $num-13;
            }
        }
        $text[$pos] = $charset[$stock];
    }
    return $text;
}
echo"<h3>3.</h3>";
echo $text="ATTAQUEZASTERIX";
echo"</br>";
echo"</br> - chiffrementROT13 : ";
echo $result = chiffrementROT13($text);
echo"</br> - dechiffrementROT13 : ";
echo dechiffrementROT13($result)."</br>";
?>