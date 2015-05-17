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
 
	class SystemInfo
	{
		/**
		 * @return InfoInterface
		 */
		public static function getInfo()
		{
		    switch(PHP_OS)
		    {
		        case 'Linux':
		            break;
		        case 'Darwin':
		            return new Darwin();
		            break;
		        
		        default:
		            
		            break;
		    }
		    

			return NULL;
		}
	}
