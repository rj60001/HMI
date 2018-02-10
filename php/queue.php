<?php
  class queue { # Defines the circular queue object class.
    public function queue($length = 100){ # This defines the constructor for instatiations of the class.
      $this->elements = []; # Contains the array of elements in the current queue. Each element contains a value.
      $this->headerPointer = 0; # Contains the index of the elment at the beginning of the queue.
      $this->backPointer = 0; # Contaisn the index for the last element in the queue.
      $length <= 0 ? $this->length = 100 : $this->length = $length; # If the length is lower than or equal to 0, set the length of the queue to a default. Otherwise it is set to a user defiend length.
      for($i = 0; $i < $length; $i++){ # Fills the array with "empty" elements so that the array if fixed in size from instantiation.
        $this->elements[$i] = "";
      }
    }

    public function get(){ # Gets the first value in the queue.
      return $this->elements[$this->headerPointer];
    }

    public function pop(){ # Removes the first element in the queue from the array.
      $this->elements[$this->headerPointer] = ""; # An "empty" element.
      $this->headerPointer++; # Increments the headerPointer to the next element in the queue.
      if(($this->headerPointer + 1) > $this->length){ # If the header pointer is beyond the length of the queue, we move it back to point to the beginning of the queue.
        $this->headerPointer= 0;
      }
    }

    public function append($value){ # Adds an element to back of a queue.
      $this->elements[$this->backPointer] = $value; # Sets the value at the back of the queue.
      if(($this->backPointer + 1) == $this->length){ # If the next element would otherwsie be added to the beyond the queue. Set the backPointer to the front.
        $this->backPointer = 0;
      }
      else {
        $this->backPointer++; # otherwise increment the back pointer so that we can add to the next element.
      }
    }

    public function isEmpty(){
      if($this->get() == ""){ # If the first element in the queue is empty then the entire queue must be empty.
        return TRUE;
      }
      else {
        return FALSE;
      }
    }
  }
?>
