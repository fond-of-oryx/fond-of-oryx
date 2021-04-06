<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model;

use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface;
use Generated\Shared\Transfer\RestReturnLabelTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

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
     * @param \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\CompanyUnitAddressReaderInterface $companyUnitAddressReader
     * @param \FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface $returnLabelFacade
     */
    public function __construct(
        CompanyUnitAddressReaderInterface $companyUnitAddressReader,
        ReturnLabelsRestApiToReturnLabelFacadeInterface $returnLabelFacade
    ) {
        $this->companyUnitAddressReader = $companyUnitAddressReader;
        $this->returnLabelFacade = $returnLabelFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelTransfer $restReturnLabelTransfer
     * @return void
     */
    public function generate(RestReturnLabelTransfer $restReturnLabelTransfer): void
    {
        $idCompanyUnitAddress = $this->companyUnitAddressReader->getIdCompanyUnitAddressByRestReturnLabel(
            $restReturnLabelTransfer
        );

        if ($idCompanyUnitAddress === null) {
            return;
        }

        $returnLabelRequestTransfer = (new ReturnLabelRequestTransfer())
            ->setIdCustomer($restReturnLabelTransfer->getIdCustomer())
            ->setIdCompanyUnitAddress($idCompanyUnitAddress);

        $this->returnLabelFacade->generateReturnLabel($returnLabelRequestTransfer);
    }
}
