<?php

namespace icex\systemInfo;

use icex\systemInfo\interfaces\InfoInterface;
use icex\systemInfo\os\Darwin;
use icex\systemInfo\os\Linux;
use icex\systemInfo\os\Windows;

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
