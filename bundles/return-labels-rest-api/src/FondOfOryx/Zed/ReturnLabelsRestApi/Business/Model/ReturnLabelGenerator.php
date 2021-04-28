<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model;

use FondOfOryx\Shared\ReturnLabelsRestApi\ReturnLabelsRestApiConstants;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Mapper\ReturnLabelRequestMapperInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;
use Generated\Shared\Transfer\MessageTransfer;

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
            return (new RestReturnLabelResponseTransfer())
                ->setIsSuccessful(false);
        }

        if (!in_array($companyUnitAddressTransfer->getFkCountry(), $this->config->getAllowedCountryIds())) {
            return (new RestReturnLabelResponseTransfer())
                ->setIsSuccessful(false)
                ->addError((new MessageTransfer)
                    ->setMessage(ReturnLabelsRestApiConstants::ERROR_MESSAGE_COUNTRY_NOT_ALLOWED);
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
}
