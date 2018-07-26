<?php

namespace weesee\systemInfo\models;

use yii;
use yii\base\Model;
use weesee\systemInfo\SystemInfo as SystemInfoDetails;
use weesee\systemInfo\os\Base;

class SystemInfo extends Model
{
    public $os;
    public $kernelVersion;
    public $hostname;
    public $cpuModel;
    public $cpuVendor;
    public $cpuFreq;
    public $cpuArchitecture;
    public $cpuCores;
    public $load;
    public $upTime;
    public $phpVersion;
    public $serverName;
    public $serverProtocol;
    public $serverSoftware;
    public $totalMemory;

    public function getInfo()
    {
        $osInfo = SystemInfoDetails::getInfo(); 
        foreach($this->attributes as $name => $value) {
            $func = "get".ucfirst($name);
            $this->$name = $osInfo::$func();
        }
    }

}
