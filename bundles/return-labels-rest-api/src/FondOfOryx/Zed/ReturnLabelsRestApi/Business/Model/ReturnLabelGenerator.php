<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model;

use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Mapper\ReturnLabelRequestMapperInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;

class ReturnLabelGenerator implements ReturnLabelGeneratorInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressReaderInterface
     */
    protected $companyUnitAddressReader;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface
     */
    protected $returnLabelFacade;

    /**
     * @var ReturnLabelRequestMapperInterface
     */
    protected $returnLabelRequestMapper;

    /**
     * @param CompanyUnitAddressReaderInterface $companyUnitAddressReader
     * @param ReturnLabelsRestApiToReturnLabelFacadeInterface $returnLabelFacade
     * @param ReturnLabelRequestMapperInterface $returnLabelRequestMapper
     */
    public function __construct(
        CompanyUnitAddressReaderInterface $companyUnitAddressReader,
        ReturnLabelsRestApiToReturnLabelFacadeInterface $returnLabelFacade,
        ReturnLabelRequestMapperInterface $returnLabelRequestMapper
    ) {
        $this->companyUnitAddressReader = $companyUnitAddressReader;
        $this->returnLabelFacade = $returnLabelFacade;
        $this->returnLabelRequestMapper = $returnLabelRequestMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelTransfer $restReturnLabelTransfer
     *
     * @return void
     */
    public function generate(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): RestReturnLabelResponseTransfer {
        $idCompanyUnitAddress = $this->companyUnitAddressReader->getIdCompanyUnitAddressByRestReturnLabel(
            $restReturnLabelRequestTransfer
        );

        if ($idCompanyUnitAddress === null) {
            return (new RestReturnLabelResponseTransfer)
                ->setIsSuccessful(false);
        }

        $returnLabelRequestTransfer = $this->returnLabelRequestMapper
            ->mapRestReturnLabelRequestToReturnLabelRequest($restReturnLabelRequestTransfer);

        $returnLabelResponseTransfer = $this->returnLabelFacade
            ->generateReturnLabel($returnLabelRequestTransfer);

        return (new RestReturnLabelResponseTransfer)
            ->setIsSuccessful(true)
            ->setReturnLabelResponse($returnLabelResponseTransfer);
    }
}
