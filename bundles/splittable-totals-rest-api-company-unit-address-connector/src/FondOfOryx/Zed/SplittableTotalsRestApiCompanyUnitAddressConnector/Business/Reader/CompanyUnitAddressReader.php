<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Reader;

use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Mapper\AddressMapperInterface;
use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Dependency\Facade\SplittableTotalsRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence\SplittableTotalsRestApiCompanyUnitAddressConnectorRepositoryInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;

class CompanyUnitAddressReader implements CompanyUnitAddressReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Mapper\AddressMapperInterface
     */
    protected $addressMapper;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence\SplittableTotalsRestApiCompanyUnitAddressConnectorRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Dependency\Facade\SplittableTotalsRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Mapper\AddressMapperInterface $addressMapper
     * @param \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence\SplittableTotalsRestApiCompanyUnitAddressConnectorRepositoryInterface $repository
     * @param \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Dependency\Facade\SplittableTotalsRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade
     */
    public function __construct(
        AddressMapperInterface $addressMapper,
        SplittableTotalsRestApiCompanyUnitAddressConnectorRepositoryInterface $repository,
        SplittableTotalsRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade
    ) {
        $this->addressMapper = $addressMapper;
        $this->companyUnitAddressFacade = $companyUnitAddressFacade;
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer|null
     */
    public function getBillingAddressByRestSplittableTotalsRequestTransfer(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
    ): ?AddressTransfer {
        $idCustomer = $restSplittableTotalsRequestTransfer->getIdCustomer();
        $restAddressTransfer = $restSplittableTotalsRequestTransfer->getBillingAddress();

        if ($idCustomer === null || $restAddressTransfer === null || $restAddressTransfer->getId() === null) {
            return null;
        }

        return $this->getAddressTransfer($restAddressTransfer->getId(), $idCustomer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer|null
     */
    public function getShippingAddressByRestSplittableTotalsRequestTransfer(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
    ): ?AddressTransfer {
        $idCustomer = $restSplittableTotalsRequestTransfer->getIdCustomer();
        $restAddressTransfer = $restSplittableTotalsRequestTransfer->getShippingAddress();

        if ($idCustomer === null || $restAddressTransfer === null || $restAddressTransfer->getId() === null) {
            return null;
        }

        return $this->getAddressTransfer($restAddressTransfer->getId(), $idCustomer);
    }

    /**
     * @param string $idCompanyUnitAddress
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer|null
     */
    protected function getAddressTransfer(string $idCompanyUnitAddress, int $idCustomer): ?AddressTransfer
    {
        if (!$this->repository->existsCompanyUnitAddress($idCustomer, $idCompanyUnitAddress)) {
            return null;
        }

        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())
            ->setUuid($idCompanyUnitAddress);

        $companyUnitAddressResponseTransfer = $this->companyUnitAddressFacade->findCompanyBusinessUnitAddressByUuid(
            $companyUnitAddressTransfer
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
