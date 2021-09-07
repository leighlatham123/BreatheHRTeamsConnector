<?php declare(strict_types=1);

namespace src\php;

use \lib\env\Env;
use \lib\teams\Teams;
use \lib\breathe\Breathe;

class Console {

    private static $teams;
    private static $breath;

    public function __construct()
    {
        self::$teams = new Teams;
        self::$breath = new Breathe;
        (new Env(__DIR__ . '/../../.env'))->load();   
    }

    //$test = self::$breath->getEmployees();

    public function init()
    {
        $absences_list = self::$breath->getAbsences();

        self::$teams->sendAbsences($absences_list); 

        return (1);
    }
}

spl_autoload_register( function ($className) {
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
});

(new Console())->init();