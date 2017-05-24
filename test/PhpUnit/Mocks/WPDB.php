<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
 * @link http://easyappointments.org
 * @since v1.1.0
 * ---------------------------------------------------------------------------- */

namespace EAWP\Test\PhpUnit\Mocks;

use EAWP\Test\PhpUnit\TestCase;

class WPDB extends TestCase
{
    public function reveal()
    {
        $mock = $this->prophesize(\WPDB::class);

        $mock->query->willReturn('null');

        return $mock->reveal();
    }
}
