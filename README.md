# Yii2 extension to get Operating System Systen Information

Provides information about your system/server. 

It automatically detects the type of system that you are using and provides you with appropriate information.


## Supported OS

- Windows
- Linux
- OSX (Darwin)

## Methods

- getOS
- getKernelVersion
- getHostname
- getCpuModel
- getCpuVendor
- getCpuFreq
- getCpuArchitecture
- getCpuCores
- getLoad
- getUpTime
- getPhpVersion
- getServerName
- getServerProtocol
- getServerSoftware
- getTotalMemory

## Installation

Add System-Info to the require section of your **composer.json** file:

```php
{
    "require": {
        "weesee/yii2-system-info": "~1.1.0"
    }
}
```

And run following command to download extension using **composer**:

```bash
$ php composer.phar update
```

## Usage

Get all Data in your controller/action:
```php
use weesee\systemInfo\models\SystemInfo;

public function actionShowinfo()
{
    // Initialize  Information to work with the current operating system
    $sysInfo = new SystemInfo();
    // get system details as Yii2 model
    $sysInfo->getInfo();
    // hand it over to view
    return $this->render('sysinfo',['sysInfo'=>$sysInfo]);
}
```

and display in your view with a model:
```php
echo DetailView::widget([
    'model' => $sysInfo,
    'attributes' => $sysInfo->attributes(),
]);

echo $sysInfo->totalMemory;
```

## FAQ

#### `COM` not found

From `PHP 5.4.5`, `COM` is no longer built into the php core. You have to add `COM` support in `php.ini`:

```php
[COM_DOT_NET] 
extension=php_com_dotnet.dll 
```

Otherwise you will see this in your error log: `Fatal error: Class \'COM\' not found`

## Contribution

Contributing instructions are located in [CONTRIBUTING.md](CONTRIBUTING.md) file.

## Author & Credits

Author: weesee@web.de

Credits to:
* [abhi1693/yii2-system-info](https://github.com/abhi1693/yii2-system-info)
* [icex/yii2-system-info](https://github.com/icex/yii2-system-info)

(C) 2018 WeeSee
