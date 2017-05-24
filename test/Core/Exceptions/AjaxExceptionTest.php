<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
 * @link http://easyappointments.org
 * @since v1.1.0
 * ---------------------------------------------------------------------------- */

namespace EAWP\Test\Core\Exceptions;

use EAWP\Core\Exceptions\AjaxException;
use EAWP\Test\PhpUnit\TestCase;

class AjaxExceptionTest extends TestCase
{
    /**
     * @var \Exception
     */
    protected $exception;

    /**
     * @var array
     */
    protected $response;

    public function setUp()
    {
        $code = $this->faker->randomDigit;
        $message = $this->faker->sentence;

        $this->response = [
            'exception' => true,
            'message' => $message,
            'code' => $code,
            'file' => __FILE__,
            'line' => __LINE__ + 3 // Exception instantiation
        ];

        $this->exception = new \Exception($message, $code);
    }

    public function testResponseMethodReturnsCorrectValue()
    {
        $response = AjaxException::response($this->exception, false);

        unset($response['trace'], $response['traceAsString']);

        $this->assertEquals($this->response, $response);
    }

    public function testResponseMethodEncodesValue()
    {
        $response = json_decode(AjaxException::response($this->exception, true), true);

        unset($response['trace'], $response['traceAsString']);

        $this->assertEquals($this->response, $response);
    }
}
