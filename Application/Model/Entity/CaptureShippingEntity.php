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

namespace OxidProfessionalServices\ArvatoAfterPayModule\Application\Model\Entity;

/**
 * Class CaptureShippingEntity: Entity for capture Shipping call.
 */
class CaptureShippingEntity extends \OxidProfessionalServices\ArvatoAfterPayModule\Application\Model\Entity\Entity
{

    /**
     * Getter for checkout id property.
     *
     * @return stdClass $type
     */
    public function getType()
    {
        return $this->_getData('type');
    }

    /**
     * Setter for checkout id property.
     *
     * @param stdClass $type
     */
    public function setType($type)
    {
        $this->_setData('type', $type);
    }

    /**
     * Getter for checkout id property.
     *
     * @return stdClass $shippingCompany
     */
    public function getShippingCompany()
    {
        return $this->_getData('shippingCompany');
    }

    /**
     * Setter for checkout id property.
     *
     * @param stdClass $shippingCompany
     */
    public function setShippingCompany($shippingCompany)
    {
        $this->_setData('shippingCompany', $shippingCompany);
    }

    /**
     * Getter for checkout id property.
     *
     * @return stdClass $trackingId
     */
    public function getTrackingId()
    {
        return $this->_getData('trackingId');
    }

    /**
     * Setter for checkout id property.
     *
     * @param stdClass $trackingId
     */
    public function setTrackingId($trackingId)
    {
        $this->_setData('trackingId', $trackingId);
    }

}