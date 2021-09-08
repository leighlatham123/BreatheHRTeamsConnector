<?php
/**
 * Php version > 5.6
 *  
 * @category Php
 * @package  Null
 * @author   F.R Michel <unknown@unknown.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @version  GIT: 1.0
 * @link     https://github.com/devcoder-xyz/php-dotenv
 * Description
 */

namespace lib\env;

use RuntimeException;
use InvalidArgumentException;

/**
 * The env class to retrieve environment file variables
 * 
 * @category The_Env_Class_To_Retrieve_Environment_File_Variables
 * @package  False
 * @author   Leigh Latham <leighlatham123@gmail.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @link     false
 */
class Env
{
    protected $path;

    /**
     * Env class constructor
     *
     * @param string $path .env file path
     */
    public function __construct($path)
    {
        if (!file_exists($path)) {
            throw new InvalidArgumentException(sprintf('%s does not exist', $path));
        }

        $this->path = $path;

    }

    /**
     * Load values recurisvely from the environment file .env
     *
     * @return void
     */
    public function load()
    {
        if (!is_readable($this->path)) {
            throw new RuntimeException(sprintf('%s file is not readable', $this->path));
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line) {

            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }

    }
}
