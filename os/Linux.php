<?php
/**
 * Created by PhpStorm.
 * User: Abhimanyu
 * Date: 16-02-2015
 * Time: 00:06
 */

namespace icex\systemInfo\os;

use icex\systemInfo\interfaces\InfoInterface;
use Exception;

class Linux extends Base
{
    public function __construct()
    {
        if (!is_dir('/sys') || !is_dir('/proc'))
            throw new Exception('Needs access to /proc and /sys to work.');
    }

    /**
     * Gets the name of the Operating System
     *
     * @return string
     */
    public static function getOS()
    {
        return 'Linux';
    }

    /**
     * Gets the Kernel Version of the Operating System
     *
     * @return string
     */
    public static function getKernelVersion()
    {
        $cmd = '/usr/bin/lsb_release -ds';
        try {
            return shell_exec($cmd);
        } catch (\Exception $e) {

        }
    }


    /**
     * Gets Processor's Model
     *
     * @return string
     */
    public static function getCpuModel()
    {
        return Linux::getCpuInfo()['Model'];
    }

    private static function getCpuInfo()
    {
        // File that has it
        $file = '/proc/cpuinfo';

        // Not there?
        if (!is_file($file) || !is_readable($file)) {
            return 'Unknown';
        }

        /*
         * Get all info for all CPUs from the cpuinfo file
         */

        // Get contents
        $contents = trim(@file_get_contents($file));

        // Lines
        $lines = explode("\n", $contents);

        // Holder for current CPU info
        $cur_cpu = [];

        // Go through lines in file
        $num_lines = count($lines);

        for ($i = 0; $i < $num_lines; $i++) {
            // Info here
            $line = explode(':', $lines[$i], 2);

            if (!array_key_exists(1, $line))
                continue;

            $key = trim($line[0]);
            $value = trim($line[1]);


            // What we want are MHZ, Vendor, and Model.
            switch ($key) {

                // CPU model
                case 'model name':
                case 'cpu':
                case 'Processor':
                    $cur_cpu['Model'] = $value;
                    break;

                // Speed in MHz
                case 'cpu MHz':
                    $cur_cpu['MHz'] = $value;
                    break;

                case 'Cpu0ClkTck': // Old sun boxes
                    $cur_cpu['MHz'] = hexdec($value) / 1000000;
                    break;

                // Brand/vendor
                case 'vendor_id':
                    $cur_cpu['Vendor'] = $value;
                    break;

                // CPU Cores
                case 'cpu cores':
                    $cur_cpu['Cores'] = $value;
                    break;
            }

        }

        // Return them
        return $cur_cpu;
    }

    /**
     * Gets Processor's Vendor
     *
     * @return string
     */
    public static function getCpuVendor()
    {
        return Linux::getCpuInfo()['Vendor'];
    }

    /**
     * Gets Processor's Frequency
     *
     * @return string
     */
    public static function getCpuFreq()
    {
        return Linux::getCpuInfo()['MHz'];
    }

    /**
     * Gets Processor's Architecture
     *
     * @return string
     */
    public static function getCpuArchitecture()
    {
        $cmd = 'getconf LONG_BIT';
        try {
            return shell_exec($cmd) . 'Bit';
        } catch (\Exception $e) {

        }
    }

    /**
     * Gets system average load
     *
     * @return string
     */
    public static function getLoad()
    {
        return round(array_sum(sys_getloadavg()) / count(sys_getloadavg()), 2);
    }

    /**
     * Gets system up-time
     *
     * @return string
     */
    public static function getUpTime()
    {
        $cmd = 'uptime -p';
        try {
            return shell_exec($cmd);
        } catch (\Exception $e) {

        }
    }

    /**
     * Gets total number of cores
     *
     * @return integer
     */
    public static function getCpuCores()
    {
        return Linux::getCpuInfo()['Cores'];
    }


    /**
     * Gets total physical memory in bytes
     *
     * @return integer
     */
    public static function getTotalMemory()
    {
        $memory = self::getMemoryInfo();
        if (isset($memory[0])) {
            preg_match('/\d+/', $memory[0], $matches);

            return $matches[0] * 1024;
        }

        return $memory[0];
    }


    private static function getMemoryInfo()
    {
        return @explode("\n", file_get_contents("/proc/meminfo"));

    }
}