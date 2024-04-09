<?php

// php-cs-fixer:ignore-file

class Filter
{
    //example comment for ignored file
    public static function even($array){
        return array_filter($array,
            fn (int $i) =>
                $i
                %
                2 === 0
        );
    }
}
