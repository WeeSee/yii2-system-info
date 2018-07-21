<?php

namespace weesee\systemInfo;

use weesee\systemInfo\interfaces\InfoInterface;
use weesee\systemInfo\os\Darwin;
use weesee\systemInfo\os\Linux;
use weesee\systemInfo\os\Windows;

class SystemInfo
{
    /**
     * @return InfoInterface
     */
    public static function getInfo()
    {

        switch (strtolower(PHP_OS)) {
            case 'linux':
                return new Linux();
                break;
            case 'darwin':
                return new Darwin();
                break;
            case 'winnt':
                return new Windows();
            default:

                break;
        }


        return NULL;
    }
}
