<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model;

use FondOfOryx\Shared\ReturnLabelsRestApi\ReturnLabelsRestApiConstants;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Mapper\ReturnLabelRequestMapperInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\ReturnLabelsRestApiConfig;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;
use Symfony\Component\HttpFoundation\Response;

class ReturnLabelGenerator implements ReturnLabelGeneratorInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\CompanyUnitAddressReaderInterface
     */
    protected $companyUnitAddressReader;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface
     */
    protected $returnLabelFacade;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Mapper\ReturnLabelRequestMapperInterface
     */
    protected $returnLabelRequestMapper;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\ReturnLabelsRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\CompanyUnitAddressReaderInterface $companyUnitAddressReader
     * @param \FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface $returnLabelFacade
     * @param \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Mapper\ReturnLabelRequestMapperInterface $returnLabelRequestMapper
     * @param \FondOfOryx\Zed\ReturnLabelsRestApi\ReturnLabelsRestApiConfig $config
     */
    public function __construct(
        CompanyUnitAddressReaderInterface $companyUnitAddressReader,
        ReturnLabelsRestApiToReturnLabelFacadeInterface $returnLabelFacade,
        ReturnLabelRequestMapperInterface $returnLabelRequestMapper,
        ReturnLabelsRestApiConfig $config
    ) {
        $this->companyUnitAddressReader = $companyUnitAddressReader;
        $this->returnLabelFacade = $returnLabelFacade;
        $this->returnLabelRequestMapper = $returnLabelRequestMapper;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestReturnLabelResponseTransfer
     */
    public function generate(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): RestReturnLabelResponseTransfer {
        $companyUnitAddressTransfer = $this->companyUnitAddressReader->getCompanyUnitAddressByRestReturnLabel(
            $restReturnLabelRequestTransfer
        );

        if ($companyUnitAddressTransfer === null) {
            return $this->addCompanyUnitAddressNotFoundError($restReturnLabelRequestTransfer);
        }

        if (!in_array($companyUnitAddressTransfer->getIso3Code(), $this->config->getAllowedCountryIso3())) {
            return $this->addCompanyUnitAddressCountryNotAllowed(
                $restReturnLabelRequestTransfer,
                $companyUnitAddressTransfer
            );
        }

        $returnLabelRequestTransfer = $this->returnLabelRequestMapper
            ->mapRestReturnLabelRequestToReturnLabelRequest($restReturnLabelRequestTransfer);

        $returnLabelRequestTransfer->setIdCompanyUnitAddress($companyUnitAddressTransfer->getIdCompanyUnitAddress());

        $returnLabelResponseTransfer = $this->returnLabelFacade
            ->generateReturnLabel($returnLabelRequestTransfer);

        return (new RestReturnLabelResponseTransfer())
            ->setIsSuccessful(true)
            ->setReturnLabelResponse($returnLabelResponseTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestReturnLabelResponseTransfer
     */
    protected function addCompanyUnitAddressNotFoundError(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): RestReturnLabelResponseTransfer {
        return $this->addError(
            ReturnLabelsRestApiConstants::ERROR_MESSAGE_ADDRESS_NOT_FOUND,
            ReturnLabelsRestApiConstants::ERROR_MESSAGE_ADDRESS_NOT_FOUND_CODE,
            Response::HTTP_NOT_FOUND,
            $restReturnLabelRequestTransfer->getCompanyUnitAddressUuid(),
            $restReturnLabelRequestTransfer->getIdCustomer(),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\RestReturnLabelResponseTransfer
     */
    protected function addCompanyUnitAddressCountryNotAllowed(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer,
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): RestReturnLabelResponseTransfer {
        return $this->addError(
            ReturnLabelsRestApiConstants::ERROR_MESSAGE_COUNTRY_NOT_ALLOWED,
            ReturnLabelsRestApiConstants::ERROR_MESSAGE_COUNTRY_NOT_ALLOWED_CODE,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            $restReturnLabelRequestTransfer->getCompanyUnitAddressUuid(),
            $companyUnitAddressTransfer->getIso3Code()
        );
    }

    /**
     * @param string $message
     * @param string $value
     * @param int $httpType
     * @param mixed ...$list
     *
     * @return \Generated\Shared\Transfer\RestReturnLabelResponseTransfer
     */
    protected function addError(string $message, string $value, int $httpType, ...$list): RestReturnLabelResponseTransfer
    {
        return (new RestReturnLabelResponseTransfer())
            ->setIsSuccessful(false)
            ->addError((new MessageTransfer())
                ->setType((string)$httpType)
                ->setValue($value)
                ->setMessage(vsprintf($message, $list)));
    }
}
