<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model;

use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Mapper\ReturnLabelRequestMapperInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;

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
     * @param \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\CompanyUnitAddressReaderInterface $companyUnitAddressReader
     * @param \FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface $returnLabelFacade
     * @param \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Mapper\ReturnLabelRequestMapperInterface $returnLabelRequestMapper
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
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestReturnLabelResponseTransfer
     */
    public function generate(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): RestReturnLabelResponseTransfer {
        $idCompanyUnitAddress = $this->companyUnitAddressReader->getIdCompanyUnitAddressByRestReturnLabel(
            $restReturnLabelRequestTransfer
        );

        if ($idCompanyUnitAddress === null) {
            return (new RestReturnLabelResponseTransfer())
                ->setIsSuccessful(false);
        }

        $returnLabelRequestTransfer = $this->returnLabelRequestMapper
            ->mapRestReturnLabelRequestToReturnLabelRequest($restReturnLabelRequestTransfer);

        $returnLabelRequestTransfer->setIdCompanyUnitAddress($idCompanyUnitAddress);

        $returnLabelResponseTransfer = $this->returnLabelFacade
            ->generateReturnLabel($returnLabelRequestTransfer);

        return (new RestReturnLabelResponseTransfer())
            ->setIsSuccessful(true)
            ->setReturnLabelResponse($returnLabelResponseTransfer);
    }
}
