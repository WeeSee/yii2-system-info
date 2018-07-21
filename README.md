System/Server Information Helper
--------------------------------

Base on [abhi1693/yii2-system-info](https://github.com/abhi1693/yii2-system-info)
Base on [icex/yii2-system-info](https://github.com/icex/yii2-system-info)



Provides information about your system/server. It automatically detects the type of system that you are using and 
provides you with appropriate information.
 
## Supported OS

- Windows
- Linux
- OSX(Darwin)

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
        "kingzeus/yii2-system-info": "1.0.x"
    }
}
```

And run following command to download extension using **composer**:

```bash
$ php composer.phar update
```

## Usage

```php
// Get the class to work with the current operating system
$system = SystemInfo::getInfo();

// Captain Obvious was here
$system::getHostname();
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
