<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use ArrayObject;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Expander\RestCompanySearchResultItemExpanderInterface;
use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompanySearchResultItemTransfer;

class RestCompanySearchResultItemMapper implements RestCompanySearchResultItemMapperInterface
{
    protected RestCompanySearchResultItemExpanderInterface $restCompanySearchResultItemExpander;

    /**
     * @param \FondOfOryx\Glue\CompanySearchRestApi\Processor\Expander\RestCompanySearchResultItemExpanderInterface $restCompanySearchResultItemExpander
     */
    public function __construct(RestCompanySearchResultItemExpanderInterface $restCompanySearchResultItemExpander)
    {
        $this->restCompanySearchResultItemExpander = $restCompanySearchResultItemExpander;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanySearchResultItemTransfer
     */
    public function fromCompany(CompanyTransfer $companyTransfer): RestCompanySearchResultItemTransfer
    {
        $restCompanySearchResultItemTransfer = (new RestCompanySearchResultItemTransfer())->fromArray(
            $companyTransfer->toArray(),
            true,
        )->setId($companyTransfer->getUuid());

        return $this->restCompanySearchResultItemExpander->expand($restCompanySearchResultItemTransfer, $companyTransfer);
    }

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\CompanyTransfer> $companyTransfers
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCompanySearchResultItemTransfer>
     */
    public function fromCompanies(ArrayObject $companyTransfers): ArrayObject
    {
        $restCompaniesAttributesTransfers = new ArrayObject();

        foreach ($companyTransfers as $companyTransfer) {
            $restCompaniesAttributesTransfers->append($this->fromCompany($companyTransfer));
        }

        return $restCompaniesAttributesTransfers;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCompanySearchResultItemTransfer>
     */
    public function fromCompanyList(CompanyListTransfer $companyListTransfer): ArrayObject
    {
        return $this->fromCompanies($companyListTransfer->getCompanies());
    }
}
