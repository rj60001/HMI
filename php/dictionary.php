<?php
  class dictionary{
    public function dictionary($keyValues = []){ # This constructor is called when a dictionary object is instantiated.
      $this->keys = [];
      $this->values = [];
      for($i=0;$i<count($keyValues);$i++){
        if(gettype($i/2) == "double"){ # If integer is not formed when didvided by two, must be an odd number.
          array_push($this->values, $keyValues[$i]);
        }
        else{ # Else must be even so a key.
          array_push($this->keys, $keyValues[$i]);
        }
      }
    }

    private function getKeyPosition($key){ # Fetch the position of the key. From thsi we can tell if a key exists or not. Only the class definition can call it.
      if(!in_array($key, $this->keys)){ # If the key is not in the array.
        return -1; # Because if no position is found, an error code of -1 s thrown.
      }
      else {
        $pos = array_search($key, $this->keys); # Fetch the position of the key.
        return $pos;
      }
    }

    public function checkKeyExists($key){ # Made a new function with a new name to be more developer friendly as the method name is more relevant.
      $val = dictionary::getKeyPosition($key);
      return ($val = -1 ? FALSE : TRUE); # Return TRUE if a key does have a positiona dn therefore exists. Else, false.
    }

    public function add($key, $value){
      array_push($this->keys, $key); # Append the new key to the end of the $keys array.
      array_push($this->values, $value); # Append the new value to the end of the $values array.
      return 0;
    }

    public function remove($key){
      $pos = dictionary::getKeyPosition($key);
      if($pos != -1){ # Make sure the getKeyPosition() functions has not returned an error.
        array_splice($this->keys, $pos, 1); # Remove the key and value pair from the arrays at the specified postion, $pos. This function shifts indexes too if an element is removed in the middle of an array.
        array_splice($this->values, $pos, 1); # ^
        return 0; # 0 is the success code.
      }
      else {
        return 1;
      }
    }

    public function read($key){ # Read a value froma key.
      $pos = dictionary::getKeyPosition($key);
      if($pos != -1){
        $value = $this->values[$pos]; # Retrive the value at the specified location.
        return $value;
      }
      else {
        return 1;
      }
    }

    public function editValue($key, $value){ # Edit the value as the specified key.
      $pos = dictionary::getKeyPosition($key);
      if($pos != -1){
        $this->values[$key] = $value; # Set value at the corressponding point of its key in the $values array.
        return 0;
      }
      else {
        return 1;
      }
    }

    public function readAll(){
      $finalArray = []; # Initialise the array.
      for($i=0;$i<count($this->keys);$i++){
        array_push($finalArray, $this->keys[$i]);
        array_push($finalArray, $this->values[$i]);
        # Creates an array in the format x, y where x is the key and y is the value.
      }
      return $finalArray;
    }
  }
?>
