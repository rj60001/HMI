<?php
   function hashing32($str){ # Takes a given string (str) and returns a hashed string with a length of 256 charcaters.
     $chars = str_split($str); # Splits the string into individual charcaters (as the default chunk length of each element of the returned array is 1).
     $finalStr = "";
     foreach ($chars as $char) {
       $ascii = ord($char); # Retrives the ascii denary value of the character.
       $ascii *= 817513877; # ascii denary multiplied by the a large prime number. Malicous users must divide the string by this value in order to find the charcter of the string used accurately,
       # as the reurned value of this statement could be a multiple of many different characters. Therefore malicous users cannot be certain (without enough computational power and time) what the charcater is.
       $hex = dechex($ascii); # Converts the denary value to a hexidecimal form.
       $finalStr .= $hex;
     }
     if(strlen($finalStr) < 32){
       for($i = 0; $i < (32 - strlen($finalStr)); $i++){
         $finalStr .= "1";
       }
     }
     else if(strlen($finalStr) > 32){
       $finalStr = str_split($finalStr, 32)[0]; # Retrive the first 32 charcters of the string.
     }
     return $finalStr;
   }
?>
