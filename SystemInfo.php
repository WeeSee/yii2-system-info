<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 15-02-2015
	 * Time: 22:19
	 */

	namespace kingzeus\systemInfo;

	use kingzeus\systemInfo\interfaces\InfoInterface;
    use kingzeus\systemInfo\os\Darwin;
use kingzeus\systemInfo\os\Linux;
use kingzeus\systemInfo\os\kingzeus\systemInfo\os;
use kingzeus\systemInfo\os\Windows;
    
	class SystemInfo
	{
		/**
		 * @return InfoInterface
		 */
		public static function getInfo()
		{
		    
		    switch( strtolower(PHP_OS))
		    {
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
