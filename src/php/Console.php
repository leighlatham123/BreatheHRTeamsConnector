<?php
/**
 * Php version > 5.6
 *  
 * @category Php
 * @package  Null
 * @author   Leigh Latham <leighlatham123@gmail.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @version  GIT: 1.0
 * @link     false
 * Description
 */

declare(strict_types=1);

namespace src\php;

use lib\env\Env;
use lib\teams\Teams;
use lib\breathe\Breathe;

/**
 * The initial entry point for the command line process
 * 
 * @category The_Initial_Entry_Point_For_The_Command_Line_Process.
 * @package  False
 * @author   Leigh Latham <leighlatham123@gmail.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @link     false
 */
class Console
{
    private static $_teams;
    private static $_breath;

    /**
     * Console Class Constructor
     */
    public function __construct()
    {
        self::$_teams = new Teams();
        self::$_breath = new Breathe();
        (new Env(__DIR__ . '/../../.env'))->load();
    }

    //$test = self::$breath->getEmployees();

    /**
     * Undocumented function
     *
     * @return void
     */
    public function init()
    {
        $absences_today = self::$_breath->getAbsences();
        $sicknesses_today = self::$_breath->getSicknesses();

        $all_absences_today = array_merge($absences_today, $sicknesses_today);

        self::$_teams->sendAbsences($all_absences_today);

        $absences_upcoming = self::$_breath->getAbsences(
            date('Y-m-d', strtotime('tomorrow')),
            date('Y-m-d', strtotime('+7 day'))
        );

        self::$_teams->sendUpcomingAbsences($absences_upcoming);
    }
}

spl_autoload_register(
    function ($className) {
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';

        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace)
            . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        include $fileName;
    }
);

(new Console())->init();
