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

namespace OxidProfessionalServices\ArvatoAfterpayModule\Application\Model\Parser;

/**
 * Class CaptureShippingResponseParser: Parser for the capture shipping response.
 */
class CaptureShippingResponseParser extends \OxidProfessionalServices\ArvatoAfterpayModule\Application\Model\Parser\Parser
{
    /**
     * Parses a standard object into a entity.
     *
     * @param stdClass $object
     *
     * @return CaptureShippingResponseEntity
     */
    public function parse(\stdClass $object)
    {
        $responseMessage = oxNew(\OxidProfessionalServices\ArvatoAfterpayModule\Application\Model\Entity\CaptureShippingResponseEntity::class);
        if (isset($object->shippingNumber)) {
            $responseMessage->setShippingNumber($object->shippingNumber);
        }
        if (isset($object->message)) {
            $responseMessage->setErrors([$object->message]);
        }
        return $responseMessage;
    }
}
