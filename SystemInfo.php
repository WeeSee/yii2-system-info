<?php
	/**
	 * Created by PhpStorm.
	 * User: Abhimanyu
	 * Date: 15-02-2015
	 * Time: 22:19
	 */

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
