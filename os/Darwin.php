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
 
	class Darwin extends Base
	{

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
			return self::getKeyFreeBSD('kern.version');
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


		/**
		 * Gets Processor's Vendor
		 *
		 * @return string
		 */
		public static function getCpuVendor()
		{
			return self::getKeyFreeBSD('machdep.cpu.vendor');
		}

		/**
		 * Gets Processor's Frequency
		 *
		 * @return string
		 */
		public static function getCpuFreq()
		{
			return self::getKeyFreeBSD('hw.cpufrequency')/1000000 . 'MHz';
		}

		/**
		 * Gets Processor's Architecture
		 *
		 * @return string
		 */
		public static function getCpuArchitecture()
		{
			return  '64Bit';
		}

		/**
		 * Gets system average load
		 *
		 * @return string
		 */
		public static function getLoad()
		{
			return self::getKeyFreeBSD('vm.loadavg');
		}

		/**
		 * Gets system up-time
		 *
		 * @return string
		 */
		public static function getUpTime()
		{
			return self::getKeyFreeBSD('kern.boottime');
		}

		/**
		 * Gets total number of cores
		 *
		 * @return integer
		 */
		public static function getCpuCores()
		{
			return self::getKeyFreeBSD('machdep.cpu.core_count');
		}



		/**
		 * Gets total physical memory
		 *
		 * @return array|null
		 */
		public static function getTotalMemory()
		{
			return self::getKeyFreeBSD('hw.physmem');
		}




	}
