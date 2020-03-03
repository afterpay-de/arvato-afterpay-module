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

use \OxidEsales\Eshop\Core\Registry;

class ValidateBankAccountServiceTest extends \OxidEsales\TestingLibrary\UnitTestCase
{

    public function test_validate()
    {
        $client =
            $this->getMockBuilder(\OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::class)
                ->setMethods(['execute'])
                ->getMock();
        $client
            ->expects($this->once())
            ->method('execute')
            ->will($this->returnValue(111));

        $sut =
            $this->getMockBuilder(\OxidProfessionalServices\ArvatoAfterPayModule\Core\ValidateBankAccountService::class)
                ->setMethods(['getRequestData', 'getClient', '_parseResponse'])
                ->getMock();
        $sut
            ->expects($this->once())
            ->method('getRequestData')
            ->will($this->returnValue(222));
        $sut
            ->expects($this->once())
            ->method('getClient')
            ->will($this->returnValue($client));

        $sut
            ->expects($this->once())
            ->method('_parseResponse')
            ->will($this->returnValue('###OK###'));

        // run
        $this->assertEquals('###OK###', $sut->validate(123, 456));
    }

    public function test_isValid_nosandbox_notvalid()
    {
        Registry::getConfig()->setConfigParam('arvatoAfterpayApiSandboxMode', false);

        $client =
            $this->getMockBuilder(\OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::class)
                ->setMethods(['execute'])
                ->getMock();
        $client
            ->expects($this->once())
            ->method('execute')
            ->will($this->returnValue(111));

        $sut =
            $this->getMockBuilder(\OxidProfessionalServices\ArvatoAfterPayModule\Core\ValidateBankAccountService::class)
                ->setMethods(['getRequestData', 'getClient', '_parseResponse'])
                ->getMock();
        $sut
            ->expects($this->once())
            ->method('getRequestData')
            ->will($this->returnValue(222));
        $sut
            ->expects($this->once())
            ->method('getClient')
            ->will($this->returnValue($client));

        $sut
            ->expects($this->once())
            ->method('_parseResponse')
            ->will($this->returnValue('###OK###'));

        // run
        $this->assertEquals(false, $sut->isValid(123, 456));
    }

    public function test_isValid_nosandbox_valid()
    {
        Registry::getConfig()->setConfigParam('arvatoAfterpayApiSandboxMode', false);

        $entity = oxNew(\OxidProfessionalServices\ArvatoAfterPayModule\Application\Model\Entity\ValidateBankAccountResponseEntity::class);
        $entity->setIsValid('FOOBAR');

        $client =
            $this->getMockBuilder(\OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::class)
                ->setMethods(['execute'])
                ->getMock();
        $client
            ->expects($this->once())
            ->method('execute')
            ->will($this->returnValue(111));

        $sut =
            $this->getMockBuilder(\OxidProfessionalServices\ArvatoAfterPayModule\Core\ValidateBankAccountService::class)
                ->setMethods(['getRequestData', 'getClient', '_parseResponse'])
                ->getMock();
        $sut
            ->expects($this->once())
            ->method('getRequestData')
            ->will($this->returnValue(222));
        $sut
            ->expects($this->once())
            ->method('getClient')
            ->will($this->returnValue($client));

        $sut
            ->expects($this->once())
            ->method('_parseResponse')
            ->will($this->returnValue($entity));

        // run
        $this->assertEquals('FOOBAR', $sut->isValid(123, 456));
    }

    public function test_isValid_sandbox()
    {
        Registry::getConfig()->setConfigParam('arvatoAfterpayApiSandboxMode', true);
        $sut = oxNew(\OxidProfessionalServices\ArvatoAfterPayModule\Core\ValidateBankAccountService::class);
        $this->assertTrue($sut->isValid(123, 456));
    }

}