<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2015
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * Class WpMock
 *
 * Handles the execution of the WordPress global function that need to be mocked
 * for the tests. This method is tightly coupled with the WpFunctions.php file
 * and together they consist a global WP functions mocking library. For WP class
 * objects use the PHPUnit MockBuilder utility.
 */
class WpMock {

    /**
     * Stores the executions of the mocked functions.
     *
     * @var array
     */
    private static $executions;

    /**
     * Setup WpMock Class
     *
     * Call this method inside every test setUp() method in order to initialize
     * the WpMock for handling the WP function calls of each test method.
     */
    public static function setUp() {
        self::$executions = array();
    }

    /**
     * Register an execution of function.
     *
     * This method will store the execution of a mocked function. This is necessary
     * by the WpAssert class in order to check which methods where executed and with
     * which arguments.
     *
     * @param string $function function name to be registered.
     * @param array $arguments Contains the arguments passed to the method.
     */
    public static function registerExecution($function, array $arguments) {
        if (!isset(self::$executions[$function]))
            self::$executions[$function] = array();
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
    function isExecuted($function, array $arguments = array()) {
        if (!isset(self::$executions[$function]))
            return false;

        if (empty($arguments)) {
            return true; // Function is executed, don't consider arguments.
        } else {
            return in_array($arguments, self::$executions[$function]);
        }
    }
}