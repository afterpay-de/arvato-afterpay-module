<?php
/**
 * This Software is the property of OXID eSales and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license key
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * @category  module
 * @package   afterpay
 * @author    OXID Professional services
 * @link      http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2020
 */

namespace OxidProfessionalServices\ArvatoAfterPayModule\Tests\Unit\Core;

/**
 * Class ArvatoAfterpayEventsTest: Tests for arvatoAfterpayEvents.
 */
class ArvatoAfterpayEventsTest extends \OxidEsales\TestingLibrary\UnitTestCase
{

    /**
     * setUp helper
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Testing method onActivate
     * The actual test is that there is no oxAdoDbException thrown,
     * i.e. the query works just fine.
     */
    public function testOnActivate()
    {
        $sutReturn = \OxidProfessionalServices\ArvatoAfterPayModule\Core\ArvatoAfterpayEvents::onActivate();
        $this->assertTrue( $sutReturn);
        // Must be idempotent - let's repeat
        $sutReturn = \OxidProfessionalServices\ArvatoAfterPayModule\Core\ArvatoAfterpayEvents::onActivate();
        $this->assertTrue( $sutReturn);
    }


}
