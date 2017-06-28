<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

namespace EAWP\Test\PhpUnit\Mocks;

/**
 * Class WPFunctions
 *
 * Mocks calls to global namespace WordPress methods.
 *
 * @package EAWP\Test\PhpUnit\Mocks
 */
class WPFunctions
{
    /**
     * @var array
     */
    protected static $functions =  [
        'add_action',
        'add_filter',
        'wp_enqueue_script',
        'wp_enqueue_style',
        '__',
        '_e',
        'add_option',
        'update_option',
        'delete_option',
        'wp_verify_nonce'
    ];

    /**
     * @var array
     */
    protected static $executions = [];

    /**
     * Call this method in each test setup execution.
     */
    public static function setUp()
    {
        self::$executions = [];

        foreach (self::$functions as $function) {
            if (function_exists('\\' . $function)) {
                continue;
            }

            eval('
                namespace {
                    function ' . $function . '() {
                        ' . WPFunctions::class . '::registerExecution(__FUNCTION__, func_get_args());
                    }
                }
            ');
        }

    }

    /**
     * Register an execution of function.
     *
     * This method will store the execution of a mocked function. This is necessary by the WpAssert class in order to
     * check which methods where executed and with which arguments.
     *
     * @param string $function function name to be registered.
     * @param array $arguments Contains the arguments passed to the method.
     */
    public static function registerExecution($function, array $arguments)
    {
        if (!isset(self::$executions[$function])) {
            self::$executions[$function] = [];
        }
        self::$executions[$function][] = $arguments;
    }

    /**
     * Check if a function was executed.
     *
     * Use this function in assertions to check if a specific WP function
     * was executed properly inside the tested classes.
     *
     * @param string $function Function name to be checked.
     *
     * @return bool Returns whether the function was executed.
     */
    public static function isExecuted($function, array $arguments = [])
    {
        if (!isset(self::$executions[$function])) {
            return false;
        }

        return empty($arguments) ? true : in_array($arguments, self::$executions[$function]);
    }
}
