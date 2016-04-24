<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Tmprepo\Console;

use Composer\Script\Event;
use Exception;

/**
 * Provides installation hooks for when this application is installed via
 * composer. Customize this class to suit your needs.
 */
class Installer
{

    public static function postUpdate(Event $event)
    {
        define('DS', DIRECTORY_SEPARATOR);
        
        $thisVendorDir = dirname(dirname(__DIR__));
        $vendorDir = dirname(dirname($thisVendorDir));
        $rootDir = dirname($vendorDir);
        
        $io = $event->getIO();
        $io->write($thisVendorDir);
        $io->write($vendorDir);
        $io->write($rootDir);
        
        if (self::moveElfidnerFiles($thisVendorDir, $vendorDir)) {
            return true;
        }
        
        return false;
    }

    
    public static function moveElfidnerFiles($thisVendorDir, $vendorDir)
    {
        
        $elfinderDir = $vendorDir . DS . 'studio-42' . DS . 'elfinder';
        $webrootDir = $thisVendorDir . DS . 'webroot';
        $webrootElfinderDir = $webrootDir . DS . 'elfinder';
        
        // create the webroot directory if does not exist
        if (!file_exists($webrootDir)) {
            if (mkdir($webrootDir)) {
                ;
            } else {
                throw new Exception('Can not create webroot directory');
            }
        }
        
        if (!file_exists($webrootElfinderDir)) {
            if (mkdir($webrootElfinderDir)) {
                ;
            } else {
                throw new Exception('Can not create webroot elfinder directory');
            }
        }
        
        
        // move files
        if (self::copyall($elfinderDir . DS . 'css', $webrootElfinderDir . DS . 'css')
            && self::copyall($elfinderDir . DS . 'js', $webrootElfinderDir . DS . 'js')
            && self::copyall($elfinderDir . DS . 'img', $webrootElfinderDir . DS . 'img')
            && self::copyall($elfinderDir . DS . 'sounds', $webrootElfinderDir . DS . 'sounds')
            && self::copyall($elfinderDir . DS . 'files', $webrootElfinderDir . DS . 'files')) {
            return true;
        }        
        
        throw new Exception('Can not copy elfinder files');
    }
	
    
    public static function copyall($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        
        $status = true;
        while (($file = readdir($dir)) !== false) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . DS . $file)) {
                    if (self::copyall($src . DS . $file, $dst . DS . $file)) {
                        ;
                    } else {
                        $status = false;
                        break;
                    }
                } else {
                    if (copy($src . DS . $file, $dst . DS . $file)) {
                        ;
                    } else {
                        $status = false;
                        break;
                    }
                }
            }
        }
        closedir($dir);

        return $status;
    }
    
}
