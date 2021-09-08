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

namespace lib\traits;

/**
 * The Microsoft teams trait in use by teams class
 * 
 * @category The_Breathe_Trait_In_Use_By_Breathe_Class
 * @package  False
 * @author   Leigh Latham <leighlatham123@gmail.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @link     false
 */
trait TeamsTrait
{
    /**
     * Undocumented function
     *
     * @param array $payload An array of values to be encoded for request
     * 
     * @return void
     */
    private function _encodePayload($payload)
    {
        return json_encode($payload);
    }
}