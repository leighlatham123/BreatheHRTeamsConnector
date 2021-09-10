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

    /**
     * Initiates the process to retrieve 'all events' both holiday and sicknesses
     * 
     * @param string $start_date String formatted date in formate YYYY-MM-DD
     * @param string $end_date   String formatted date in formate YYYY-MM-DD
     *
     * @return void
     */
    public function allEvents($start_date, $end_date)
    {
        $absences_today = self::$_breath->getAbsences(
            $start_date, 
            $end_date
        );

        $sicknesses_today = self::$_breath->getSicknesses(
            $start_date, 
            $end_date
        );

        $all_absences_today = array_merge($absences_today, $sicknesses_today);

        self::$_teams->sendAbsences($all_absences_today);
    }

    /**
     * Initiates the process to retrieve 'upcoming holidays' both holiday and sicknesses
     * 
     * @param string $start_date String formatted date in formate YYYY-MM-DD
     * @param string $end_date   String formatted date in formate YYYY-MM-DD
     *
     * @return void
     */
    public function upcomingHolidays($start_date, $end_date)
    {
        $absences_upcoming = self::$_breath->getAbsences(
            $start_date,
            $end_date
        );

        self::$_teams->sendUpcomingAbsences($absences_upcoming);
    }

    /**
     * Initiates the process to retrieve 'sicknesses' both holiday and sicknesses
     * 
     * @param string $start_date String formatted date in formate YYYY-MM-DD
     * @param string $end_date   String formatted date in formate YYYY-MM-DD
     *
     * @return void
     */
    public function sicknesses($start_date, $end_date)
    {
        $sicknesses = self::$_breath->getSicknesses(
            $start_date, 
            $end_date
        );

        self::$_teams->sendUpcomingAbsences($sicknesses);
    }

    /**
     * Initiates the process to retrieve 'holidays' both holiday and sicknesses
     * 
     * @param string $start_date String formatted date in formate YYYY-MM-DD
     * @param string $end_date   String formatted date in formate YYYY-MM-DD
     *
     * @return void
     */
    public function holidays($start_date, $end_date)
    {
        $holidays = self::$_breath->getAbsences(
            $start_date, 
            $end_date
        );

        return $holidays;
    }

    /**
     * Initiates the process to retrieve an 'employee' by a given ID
     * 
     * @param integer $id Numeric emplpyee ID
     *
     * @return void
     */
    public function employee($id)
    {
        $employee = self::$_breath->getEmployee($id);

        return $employee;
    }

    /**
     * Initiates the process to retrieve 'all employees'
     *
     * @return void
     */
    public function employees()
    {
        $employees = self::$_breath->getEmployees();

        return $employees;
    }
}


/**
 * PSR-0: Class Autoloading
 */
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

/**
 * Reads the user input options and initiates the relevant request processes
 * 
 * @param mixed $options Array of options provided by the user
 *
 * @return void
 */
function loadQuery($options) 
{
    if (!count($options)) {
        die(
            "Missing required arguments. Please specify which query connection method you would like to run. Use flag '-q help' as an argument for options." . PHP_EOL
        );
    }

    $query_option = $options['q'];
    $start = $options['s'] ?? date('Y-m-d');
    $end = $options['e'] ?? date('Y-m-d');
    $from = $options['f'] ?? date('Y-m-d', strtotime('tomorrow'));
    $to = $options['t'] ?? date('Y-m-d', strtotime('+7 day'));
    $id = $options['i'] ?? null;

    $console = new Console();
    
    switch(strtolower($query_option)) {
    case "events":
        $console->allEvents($start, $end);
        break;
    case "upcoming":
        $console->upcomingHolidays($from, $to);
        break;
    case "holidays":
        $console->holidays($start, $end);
        break;
    case "sicknesses":
        $console->sicknesses($start, $end);
        break;
    case "employee":
        if (!$id) {
            die("Employee ID flag '-i' is required. Example: -q employee -i 000000");
        }
        $console->employee($id);
        break;
    case "employees":
        $console->employees();
        break;
    case "help":
        getHelp();
        break;
    case "exit":
        exit();
        break;
    default:
        exit("Unrecognised option '$query_option'. Exiting." . PHP_EOL);
        break;
    }
}

/**
 * Function to return the help menu text to the console for the user
 * 
 * @return void
 */
function getHelp() 
{
    printf("Flag -i {id} is a numeric identifier in format integer" . PHP_EOL);
    printf("Flags -s {start} and -e {end} are dates in format YYYY-MM-DD" . PHP_EOL);
    printf("Flags -f {from} and -t {to} are dates in format YYYY-MM-DD" . PHP_EOL . PHP_EOL);

    $mask = "|%10.20s |%10.20s |%20.90s\n";

    printf($mask, str_pad("Option", 20), str_pad("Flag(s)", 20), str_pad("Description", 20));
    printf($mask, str_repeat("-", 20), str_repeat("-", 20), str_repeat("-", 20));
    printf($mask, str_pad("events", 20), str_pad("-s -e", 20), str_pad("Get all events", 20));
    printf($mask, str_pad("upcoming", 20), str_pad("-f -t", 20), str_pad("Get all upcoming events", 20));
    printf($mask, str_pad("holidays", 20), str_pad("-s -e", 20), str_pad("Get all upcoming holidays", 20));
    printf($mask, str_pad("sicknesses", 20), str_pad("-s -e", 20), str_pad("Get all upcoming sicknesses", 20));
    printf($mask, str_pad("employee", 20), str_pad("-i", 20), str_pad("Get single employee info by id", 20));
    printf($mask, str_pad("employees", 20), str_pad("", 20), str_pad("Get all employees info", 20));
}

/**
 * Get all of the provided input options from users command
 */
loadQuery(getopt("q:s:e:i:f:t"));
