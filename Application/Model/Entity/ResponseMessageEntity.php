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
 * Class ResponseMessageEntity: Entitiy for response messages.
 */
class ResponseMessageEntity extends \OxidProfessionalServices\ArvatoAfterPayModule\Application\Model\Entity\Entity
{
    /**
     * Constants for type property.
     */
    const TYPE_BUSINESS_ERROR = 'BusinessError';
    const TYPE_TECHNICAL_ERROR = 'TechnicalError';
    const TYPE_NOTIFICATION_MESSAGE = 'NotificationMessage';

    /**
     * Constants for action code property.
     */
    const ACTION_CODE_UNAVAILABLE = 'Unavailable';
    const ACTION_CODE_ASK_CONSUMER_TO_CONFIRM = 'AskConsumerToConfirm';
    const ACTION_CODE_ASK_CONSUMER_TO_REENTER_DATA = 'AskConsumerToReEnterData';
    const ACTION_CODE_OFFER_SECURE_PAYMENT_METHODS = 'OfferSecurePaymentMethods';
    const ACTION_CODE_REQUIRES_SSN = 'RequiresSsn';

    /**
     * Getter for type property.
     *
     * @return string
     */
    public function getType()
    {
        return $this->_getData('type');
    }

    /**
     * Setter for type property.
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->_setData('type', $type);
    }

    /**
     * Getter for code property.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->_getData('code');
    }

    /**
     * Setter for code property.
     *
     * @param string $code
     */
    public function setCode($code)
    {
        $this->_setData('code', $code);
    }

    /**
     * Getter for message property.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->_getData('message');
    }

    /**
     * Setter for message property.
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->_setData('message', $message);
    }

    /**
     * Getter for customer facing message property.
     *
     * @return string
     */
    public function getCustomerFacingMessage()
    {
        return $this->_getData('customerFacingMessage');
    }

    /**
     * Setter for customer facing message property.
     *
     * @param string $customerFacingMessage
     */
    public function setCustomerFacingMessage($customerFacingMessage)
    {
        $this->_setData('customerFacingMessage', $customerFacingMessage);
    }

    /**
     * Getter for action code property.
     *
     * @return string
     */
    public function getActionCode()
    {
        return $this->_getData('actionCode');
    }

    /**
     * Setter for action code property.
     *
     * @param string $actionCode
     */
    public function setActionCode($actionCode)
    {
        $this->_setData('actionCode', $actionCode);
    }

    /**
     * Getter for field reference property.
     *
     * @return string
     */
    public function getFieldReference()
    {
        return $this->_getData('fieldReference');
    }

    /**
     * Setter for field reference property.
     *
     * @param string $fieldReference
     */
    public function setFieldReference($fieldReference)
    {
        $this->_setData('fieldReference', $fieldReference);
    }

}