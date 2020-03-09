<?php

namespace YogaCMS\UI\Utils;

use Arr as ArrTool;

class Arr extends ArrTool
{
    
    /**
     * Insert a Value Before a Key
     *
     */
    static function insertBefore(&$array, $position, $insert)
    {
        if (is_int($position)) {
            array_splice($array, $position, 0, $insert);
        } else {
            $pos   = array_search($position, array_keys($array));
            $array = array_merge(
                array_slice($array, 0, $pos),
                $insert,
                array_slice($array, $pos)
            );
        }
    }

    /**
     * Insert a Value After a Key
     *
     */
    static function insertAfter(&$array, $position, $insert)
    {
        if (is_int($position)) {
            array_splice($array, $position, 0, $insert);
        } else {
            $pos   = array_search($position, array_keys($array));
            $array = array_merge(
                array_slice($array, 0, $pos + 1),
                $insert,
                array_slice($array, $pos - 1)
            );
        }
    }
}
