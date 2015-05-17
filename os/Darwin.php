<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 16-02-2015
	 * Time: 00:06
	 */

	namespace kingzeus\systemInfo\os;

	use kingzeus\systemInfo\interfaces\InfoInterface;
	use Exception;
	use PDO;
	use Yii;
 
	class Darwin extends Base
	{
		public function __construct()
		{
//			if (!is_dir('/sys') || !is_dir('/proc'))
//				throw new Exception('Needs access to /proc and /sys to work.');
		}

		/**
		 * Gets the name of the Operating System
		 *
		 * @return string
		 */
		public static function getOS()
		{
			return 'Darwin';
		}

		/**
		 * Gets the Kernel Version of the Operating System
		 *
		 * @return string
		 */
		public static function getKernelVersion()
		{
			return shell_exec('/usr/bin/lsb_release -ds');
		}



		/**
		 * Gets Processor's Model
		 *
		 * @return string
		 */
		public static function getCpuModel()
		{
			return self::getKeyFreeBSD('hw.model');
		}
		//确定执行文件位置 FreeBSD
		
		private static function findCommandFreeBSD($commandName)
		{
		
		    $path = array('/bin', '/sbin', '/usr/bin', '/usr/sbin', '/usr/local/bin', '/usr/local/sbin');
		
		    foreach($path as $p)
		    {
		
		        if (@is_executable("$p/$commandName")) return "$p/$commandName";
		
		    }
		
		    return false;
		
		}
		
		//执行系统命令 FreeBSD
		private static function doCommandFreeBSD($commandName, $args)
		{
		
		    $buffer = "";
		
		    if (false === ($command = self::findCommandFreeBSD($commandName))) return false;
		
		    if ($fp = @popen("$command $args", 'r'))
		    {
		
		        while (!@feof($fp))
		        {
		
		            $buffer .= @fgets($fp, 4096);
		
		        }
		
		        return trim($buffer);
		
		    }
		
		    return false;
		
		}
		// 取得参数值 FreeBSD
        private static function getKeyFreeBSD($keyName)
        {
        	return self::doCommandFreeBSD('sysctl', "-n $keyName");
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

				$key   = trim($line[0]);
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
			return '';//Darwin::getCpuInfo()['Vendor'];
		}

		/**
		 * Gets Processor's Frequency
		 *
		 * @return string
		 */
		public static function getCpuFreq()
		{
			return Darwin::getCpuInfo()['MHz'];
		}

		/**
		 * Gets Processor's Architecture
		 *
		 * @return string
		 */
		public static function getCpuArchitecture()
		{
			return shell_exec('getconf LONG_BIT') . 'Bit';
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
			return shell_exec('uptime -p');
		}

		/**
		 * Gets total number of cores
		 *
		 * @return integer
		 */
		public static function getCpuCores()
		{
			return Darwin::getCpuInfo()['Cores'];
		}





		/**
		 * Gets total physical memory
		 *
		 * @return array|null
		 */
		public static function getTotalMemory()
		{
			// todo
		}



		private static function getMemoryInfo()
		{
			$data = @explode("\n", file_get_contents("/proc/meminfo"));

		}
	}
