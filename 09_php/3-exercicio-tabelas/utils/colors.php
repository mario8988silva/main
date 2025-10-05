<?php

/**
 * #000000
 *    r g b
 * 
 * red -> 0-255
 * green -> 0-255
 * blue -> 0-255
 */


// 15. Utility function to generate random colors.
// 17. If false, returns hex color like #a3f2c1
function randomColor(bool $rgb, int $alpha = 100): string
{
    $red = rand(0, 255);
    $green = rand(0, 255);
    $blue = rand(0, 255);

    // 16. If $rgb is true, returns rgba(...)
    if ($rgb) {
        $alpha /= 100;
        return "rgba($red, $green, $blue, $alpha)";
    }

    $hexRed = str_pad(dechex($red), 2, '0', STR_PAD_LEFT);
    $hexGreen = str_pad(dechex($green), 2, '0', STR_PAD_LEFT);
    $hexBlue = str_pad(dechex($blue), 2, '0', STR_PAD_LEFT);

    return "#$hexRed$hexGreen$hexBlue";
    // return sprintf("#%02x%02x%02x", $red, $green, $blue);
    // return sprintf("#%06x", rand(0, 255 ** 3));
}

// 18. Used in draw.view.phtml to color each cell.

// 19. draw.view.phtml