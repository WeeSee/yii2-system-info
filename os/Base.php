<?php

namespace weesee\systemInfo\os;

use weesee\systemInfo\interfaces\InfoInterface;
use Exception;

abstract class Base implements InfoInterface
{
    public function __construct()
    {

    }

    /**
     * Gets the name of the Operating System
     *
     * @return string
     */
    abstract public static function getOS();

    /**
     * Gets the Kernel Version of the Operating System
     *
     * @return string
     */
    abstract public static function getKernelVersion();


    /**
     * Gets Processor's Model
     *
     * @return string
     */
    abstract public static function getCpuModel();


    /**
     * Gets Processor's Vendor
     *
     * @return string
     */
    abstract public static function getCpuVendor();

    /**
     * Gets Processor's Frequency
     *
     * @return string
     */
    abstract public static function getCpuFreq();

    /**
     * Gets Processor's Architecture
     *
     * @return string
     */
    abstract public static function getCpuArchitecture();

    /**
     * Gets system average load
     *
     * @return string
     */
    abstract public static function getLoad();

    /**
     * Gets system up-time
     *
     * @return string
     */
    abstract public static function getUpTime();

    /**
     * Gets total number of cores
     *
     * @return integer
     */
    abstract public static function getCpuCores();


    /**
     * Gets the hostname
     *
     * @return string
     */
    public static function getHostname()
    {
        return php_uname('n');
    }


    /**
     * Gets Current PHP Version
     *
     * @return string
     */
    public static function getPhpVersion()
    {
        return phpversion();
    }

    /**
     * Gets Server Name
     *
     * @return string
     */
    public static function getServerName()
    {
        return $_SERVER['SERVER_NAME'];
    }

    /**
     * Gets Server Protocol
     *
     * @return string
     */
    public static function getServerProtocol()
    {
        return $_SERVER['SERVER_PROTOCOL'];
    }

    /**
     * Gets the type of server e.g. apache
     *
     * @return string
     */
    public static function getServerSoftware()
    {
        return $_SERVER['SERVER_SOFTWARE'];
    }

    /**
     * Gets total physical memory
     *
     * @return array|null
     */
    abstract public static function getTotalMemory();

}