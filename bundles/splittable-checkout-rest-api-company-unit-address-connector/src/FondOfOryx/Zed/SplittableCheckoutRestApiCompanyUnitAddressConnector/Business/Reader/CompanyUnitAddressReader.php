<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\Reader;

use FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\Mapper\AddressMapperInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Dependency\Facade\SplittableCheckoutRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Persistence\SplittableCheckoutRestApiCompanyUnitAddressConnectorRepositoryInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class CompanyUnitAddressReader implements CompanyUnitAddressReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\Mapper\AddressMapperInterface
     */
    protected $addressMapper;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Persistence\SplittableCheckoutRestApiCompanyUnitAddressConnectorRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Dependency\Facade\SplittableCheckoutRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\Mapper\AddressMapperInterface $addressMapper
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Persistence\SplittableCheckoutRestApiCompanyUnitAddressConnectorRepositoryInterface $repository
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Dependency\Facade\SplittableCheckoutRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade
     */
    public function __construct(
        AddressMapperInterface $addressMapper,
        SplittableCheckoutRestApiCompanyUnitAddressConnectorRepositoryInterface $repository,
        SplittableCheckoutRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade
    ) {
        $this->addressMapper = $addressMapper;
        $this->companyUnitAddressFacade = $companyUnitAddressFacade;
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer|null
     */
    public function getBillingAddressByRestSplittableCheckoutRequestAndQuote(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): ?AddressTransfer {
        $companyUserReference = $quoteTransfer->getCompanyUserReference();
        $customerReference = $restSplittableCheckoutRequestTransfer->getCustomerReference();
        $restAddressTransfer = $restSplittableCheckoutRequestTransfer->getBillingAddress();

        if (
            $customerReference === null
            || $companyUserReference === null
            || $restAddressTransfer === null
            || $restAddressTransfer->getId() === null
        ) {
            return null;
        }

        return $this->getAddressTransfer($restAddressTransfer->getId(), $customerReference, $companyUserReference);
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer|null
     */
    public function getShippingAddressByRestSplittableCheckoutRequestAndQuote(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): ?AddressTransfer {
        $companyUserReference = $quoteTransfer->getCompanyUserReference();
        $customerReference = $restSplittableCheckoutRequestTransfer->getCustomerReference();
        $restAddressTransfer = $restSplittableCheckoutRequestTransfer->getShippingAddress();

        if (
            $companyUserReference === null
            || $customerReference === null
            || $restAddressTransfer === null
            || $restAddressTransfer->getId() === null
        ) {
            return null;
        }

        return $this->getAddressTransfer($restAddressTransfer->getId(), $customerReference, $companyUserReference);
    }

    /**
     * @param string $idCompanyUnitAddress
     * @param string $customerReference
     * @param string $companyUserReference
     *
     * @return \Generated\Shared\Transfer\AddressTransfer|null
     */
    protected function getAddressTransfer(
        string $idCompanyUnitAddress,
        string $customerReference,
        string $companyUserReference
    ): ?AddressTransfer {
        if (!$this->repository->existsCompanyUnitAddress($customerReference, $companyUserReference, $idCompanyUnitAddress)) {
            return null;
        }

        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())
            ->setUuid($idCompanyUnitAddress);

        $companyUnitAddressResponseTransfer = $this->companyUnitAddressFacade->findCompanyBusinessUnitAddressByUuid(
            $companyUnitAddressTransfer,
        );

        $companyUnitAddressTransfer = $companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer();

        if ($companyUnitAddressTransfer === null || !$companyUnitAddressResponseTransfer->getIsSuccessful()) {
            // @codeCoverageIgnoreStart
            return null;

            // @codeCoverageIgnoreEnd
        }

        return $this->addressMapper->fromCompanyUnitAddressTransfer($companyUnitAddressTransfer);
    }
}
