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

namespace OxidProfessionalServices\ArvatoAfterPayModule\Core;

use \OxidEsales\Eshop\Core\Registry;

/**
 * Class ClientConfigurator: Configures a client for the AfterPay webservice.
 */
class ClientConfigurator
{
    /**
     * Saves used API key to session, ensuring that subsequent calls will be made to the same API key.
     * It also enables saving of API key into AfterpayOrder table for backend usage
     * @param $bIsInstallmentApi
     */
    public function saveApiKeyToSession($bIsInstallmentApi)
    {
        list($url, $key) = $this->getApiCredentials($bIsInstallmentApi);

        if (!isAdmin()) {
            Registry::getSession()->setVariable('arvatoAfterpayApiKey', $key);
        }
    }

    /**
     * Returns a configured webservice client for the authorize payment webservice.
     *
     * @return WebServiceClient
     */
    public function getAuthorizePaymentClient()
    {
        $client = $this->getBaseClient(
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::HTTPMETHOD_AUTHORIZE_CHECKOUT,
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::FUNCTION_AUTHORIZE_CHECKOUT,
            null
        );
        return $client;
    }

    /**
     * Returns a configured webservice client for the capture webservice.
     *
     * @param $sOrderNr
     *
     * @param $sRecordedApiKey
     *
     * @return WebServiceClient
     * @throws CurlException
     * @internal param $bIsInstallmentApi
     * @internal param $sRecordedApiKey
     *
     */
    public function getCaptureClient($sOrderNr, $sRecordedApiKey)
    {
        if (!$sOrderNr) {
            throw new \OxidProfessionalServices\ArvatoAfterPayModule\Core\Exception\CurlException('sOrderNr was empty');
        }

        $client = $this->getBaseClient(
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::HTTPMETHOD_CAPTURE,
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::FUNCTION_CAPTURE,
            [$sOrderNr],
            null,
            $sRecordedApiKey
        );
        return $client;
    }

    /**
     * Returns a configured webservice client for the void webservice.
     *
     * @param $sOrderNr
     *
     * @param $sRecordedApiKey
     *
     * @return WebServiceClient
     * @throws CurlException
     * @internal param $bIsInstallmentApi
     * @internal param $sRecordedApiKey
     *
     * @codeCoverageIgnore Live API connection - Mocked away in tests
     *
     */
    public function getVoidClient($sOrderNr, $sRecordedApiKey)
    {
        if (!$sOrderNr) {
            throw new \OxidProfessionalServices\ArvatoAfterPayModule\Core\Exception\CurlException('sOrderNr was empty');
        }

        $client = $this->getBaseClient(
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::HTTPMETHOD_VOID,
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::FUNCTION_VOID,
            [$sOrderNr],
            null,
            $sRecordedApiKey
        );
        return $client;
    }

    /**
     * Returns a configured webservice client for the GetOrder webservice.
     * @url https://developer.afterpay.io/api/method/ordermanagement/getorder
     *
     * @param $sOrderNr
     * @param $sRecordedApiKey
     *
     * @return WebServiceClient
     * @throws CurlException
     *
     * @codeCoverageIgnore Live API connection - Mocked away in tests
     *
     */
    public function getOrderDetailsClient($sOrderNr, $sRecordedApiKey)
    {
        if (!$sOrderNr) {
            throw new \OxidProfessionalServices\ArvatoAfterPayModule\Core\Exception\CurlException('sOrderNr was empty');
        }
        if (!$sRecordedApiKey) {
            throw new \OxidProfessionalServices\ArvatoAfterPayModule\Core\Exception\CurlException('$sRecordedApiKey was empty');
        }

        $client = $this->getBaseClient(
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::HTTPMETHOD_ORDERDETAILS,
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::FUNCTION_ORDERDETAILS,
            [$sOrderNr],
            null,
            $sRecordedApiKey
        );
        return $client;
    }

    /**
     * Returns a configured webservice client for the capture shipping webservice.
     *
     * @param $sOrderNr
     * @param $lastCaptureId
     *
     * @param $bIsInstallmentApi
     * @param $sRecordedApiKey
     *
     * @return WebServiceClient
     * @throws CurlException
     */
    public function getCaptureShippingClient(
        $sOrderNr,
        $lastCaptureId,
        $bIsInstallmentApi = false,
        $sRecordedApiKey = ''
    ) {
        if (!$sOrderNr) {
            throw new \OxidProfessionalServices\ArvatoAfterPayModule\Core\Exception\CurlException('sOrderNr was empty');
        }
        if (!$lastCaptureId) {
            throw new \OxidProfessionalServices\ArvatoAfterPayModule\Core\Exception\CurlException('lastCaptureId was empty');
        }

        $client = $this->getBaseClient(
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::HTTPMETHOD_CAPTURESHIPPING,
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::FUNCTION_CAPTURESHIPPING,
            [$sOrderNr, $lastCaptureId],
            $bIsInstallmentApi,
            $sRecordedApiKey
        );
        return $client;
    }

    /**
     * Returns a configured webservice client
     *
     * @param bool $bIsInstallmentApi
     * @param string $sRecordedApiKey
     *
     * @return WebServiceClient
     */
    public function getValidateBankAccountClient(
        $bIsInstallmentApi = false,
        $sRecordedApiKey = ''
    ) {
        $client = $this->getBaseClient(
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::HTTPMETHOD_VALIDATEBANKACCOUNT,
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::FUNCTION_VALIDATEBANKACCOUNT,
            null,
            $bIsInstallmentApi,
            $sRecordedApiKey
        );
        return $client;
    }

    /**
     * @param string $sOrderNr
     * @param $sRecordedApiKey
     *
     * @return WebServiceClient
     * @throws CurlException
     */
    public function getRefundClient($sOrderNr, $sRecordedApiKey = '')
    {
        if (!$sOrderNr) {
            throw new \OxidProfessionalServices\ArvatoAfterPayModule\Core\Exception\CurlException('sOrderNr was empty');
        }

        $client = $this->getBaseClient(
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::HTTPMETHOD_REFUND,
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::FUNCTION_REFUND,
            [$sOrderNr],
            null,
            $sRecordedApiKey
        );
        return $client;
    }

    /**
     * @param $bIsInstallmentApi
     * @param $sRecordedApiKey
     *
     * @return WebServiceClient
     */
    public function getAvailablePaymentMethodsClient($bIsInstallmentApi = false, $sRecordedApiKey = '')
    {
        $client = $this->getBaseClient(
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::HTTPMETHOD_AVAILABLEPAYMENTMETHODS,
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::FUNCTION_AVAILABLEPAYMENTMETHODS,
            null,
            $bIsInstallmentApi,
            $sRecordedApiKey
        );
        return $client;
    }

    /**
     * @param $checkoutId
     *
     * @param $bIsInstallmentApi
     * @param $sRecordedApiKey
     *
     * @return WebServiceClient
     */
    public function getCreateContractClient($checkoutId, $bIsInstallmentApi = false, $sRecordedApiKey = '')
    {
        $client = $this->getBaseClient(
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::HTTPMETHOD_CREATECONTRACT,
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::FUNCTION_CREATECONTRACT,
            [$checkoutId],
            $bIsInstallmentApi,
            $sRecordedApiKey

        );
        return $client;
    }

    /**
     * @return WebServiceClient
     */
    public function getAvailableInstallmentPlansClient()
    {
        $client = $this->getBaseClient(
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::HTTPMETHOD_AVAILABLEINSTALLMENTPLANS,
            \OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::FUNCTION_AVAILABLEINSTALLMENTPLANS,
            null,
            true
        );
        return $client;
    }

    /**
     * Get the function-agnostic client. Needs to get
     *
     * @param string $httpmethod POST or GET
     * @param string $function
     * @param array $sprintfArgs non-assoc array of arguments to be unpacked for sprintf, e.g. order-id for capture
     * @param bool $bIsInstallmentApi IsInstallmentApi
     * @param string $sRecordedApiKey RecorderdApiKey
     *
     * @return WebServiceClient
     * @throws CurlException
     */
    public function getBaseClient(
        $httpmethod,
        $function,
        $sprintfArgs = null,
        $bIsInstallmentApi = false,
        $sRecordedApiKey = ''
    ) {
        if (!$httpmethod) {
            throw new \OxidProfessionalServices\ArvatoAfterPayModule\Core\Exception\CurlException('httpmethod was empty');
        }
        if (!$function) {
            throw new \OxidProfessionalServices\ArvatoAfterPayModule\Core\Exception\CurlException('function was empty');
        }

        list($url, $key) = $this->getApiCredentials($bIsInstallmentApi, $sRecordedApiKey);

        $client = oxNew(\OxidProfessionalServices\ArvatoAfterPayModule\Core\WebServiceClient::class);
        $client->setBaseUrl($url);
        $client->setHttpmethod($httpmethod);
        $client->setRequestHeaders(array(
            'X-Auth-Key: ' . $key,
            'Content-Type: application/json',
        ));
        $client->setFunction($function, $sprintfArgs);
        return $client;
    }

    /**
     * @param bool $bIsInstallmentApi
     * @param string $sRecordedApiKey
     *
     * @return array
     */
    protected function getApiCredentials(
        $bIsInstallmentApi = false,
        $sRecordedApiKey = ''
    ) {

        $sIsInstallmentApi = $bIsInstallmentApi ? 'Installment' : '';

        $customerCountryCode = $this->getUserCountryCodeIdFromSession();

        if (Registry::getConfig()->getConfigParam('arvatoAfterpayApiSandboxMode')) {
            $url = trim(Registry::getConfig()->getConfigParam('arvatoAfterpayApiSandboxUrl'));
            $key = trim(Registry::getConfig()->getConfigParam('arvatoAfterpayApiSandboxKey' . $customerCountryCode . $sIsInstallmentApi));
        } else {
            $url = trim(Registry::getConfig()->getConfigParam('arvatoAfterpayApiUrl'));
            $key = trim(Registry::getConfig()->getConfigParam('arvatoAfterpayApiKey' . $customerCountryCode . $sIsInstallmentApi));
        }

        if (substr($url, -1) != '/') {
            $url .= '/';
        }

        $sSessionApiKey = Registry::getSession()->getVariable('arvatoAfterpayApiKey');

        if ($sRecordedApiKey) {
            $key = $sRecordedApiKey;
        } elseif ($sSessionApiKey && !isAdmin()) {
            $key = $sSessionApiKey;
        }

        return [$url, $key];
    }

    /**
     * Return user country Code: DE, AT or CH.
     * If none is found, it will default to DE.
     * That way we have a valid API to communicate with and log,
     * while the API will take care of risk management etc.
     *
     * @return string $customerCountryCode DE, AT or CH
     */
    public function getUserCountryCodeIdFromSession()
    {

        $customerCountryId = Registry::getSession()->getUser()->oxuser__oxcountryid->value;

        switch ($customerCountryId) {
            case 'a7c40f6320aeb2ec2.72885259':
                $customerCountryCode = 'AT';
                break;
            case 'a7c40f6321c6f6109.43859248':
                $customerCountryCode = 'CH';
                break;
            case 'a7c40f632cdd63c52.64272623':
                $customerCountryCode = 'NL';
                break;
            case 'a7c40f631fc920687.20179984':
            default:
                $customerCountryCode = 'DE';
                break;
        }

        return $customerCountryCode;

    }

}