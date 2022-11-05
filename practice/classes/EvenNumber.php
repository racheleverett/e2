<?php
class EvenNumber extends Number
{
    public function isValid()
    {
        return parent::isValid() and $this->num % 2 == 0;
    }
}
