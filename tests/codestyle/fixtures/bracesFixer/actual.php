<?php

class BracesFixer
{
    public function getNameLabel( string $name, string $title = null ): string {
        $label = $name;
        if (  $title !== null)
        {
            $label .= " " . $title;
        }

        return $label;
    }
}
