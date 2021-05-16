<?php
namespace App\Service;

class SelectBoxService
{
    public function generate($element_name, $value, $objects, $required = false)
    {
        $select = '<select id="' . $element_name . '" name="' . $element_name . '" value=' . $value . '>';

        if ( ! $required ) {
            $select .= "<option value=0></option>";
        }

        foreach( $objects as $object )
        {
            if ( $object->getId() === $value ) $selected = " selected ";
            else $selected = "";

            //we veronderstellen hier dat $object
            //de methoden getId() en getName() heeft
            $select .= "<option $selected value=" . $object->getId() . ">" . $object->getName() . "</option>";
        }

        $select .= "</select>";

        return $select;
    }
}