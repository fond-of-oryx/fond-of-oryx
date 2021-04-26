<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Reader;

use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Mapper\AddressMapperInterface;
use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Dependency\Facade\SplittableTotalsRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence\SplittableTotalsRestApiCompanyUnitAddressConnectorRepositoryInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\SplittableTotalsRequestTransfer;

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
     * @param \Generated\Shared\Transfer\SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer|null
     */
    public function getBillingAddressBySplittableTotalsRequestTransfer(
        SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
    ): ?AddressTransfer {
        $idCustomer = $splittableTotalsRequestTransfer->getIdCustomer();
        $idBillingAddress = $splittableTotalsRequestTransfer->getIdBillingAddress();

        if ($idCustomer === null || $idBillingAddress === null) {
            return null;
        }

        return $this->getAddressTransfer($idBillingAddress, $idCustomer);
    }

    /**
     * @param \Generated\Shared\Transfer\SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer|null
     */
    public function getShippingAddressBySplittableTotalsRequestTransfer(
        SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
    ): ?AddressTransfer {
        $idCustomer = $splittableTotalsRequestTransfer->getIdCustomer();
        $idShippingAddress = $splittableTotalsRequestTransfer->getIdShippingAddress();

        if ($idCustomer === null || $idShippingAddress === null) {
            return null;
        }

        return $this->getAddressTransfer($idShippingAddress, $idCustomer);
    }

    /**
     * @param int $idCompanyUnitAddress
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer|null
     */
    protected function getAddressTransfer(int $idCompanyUnitAddress, int $idCustomer): ?AddressTransfer
    {
        if (!$this->repository->existsCompanyUnitAddress($idCustomer, $idCompanyUnitAddress)) {
            return null;
        }

        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())
            ->setIdCompanyUnitAddress($idCompanyUnitAddress);

        $companyUnitAddressTransfer = $this->companyUnitAddressFacade->getCompanyUnitAddressById(
            $companyUnitAddressTransfer
        );

        return $this->addressMapper->fromCompanyUnitAddressTransfer($companyUnitAddressTransfer);
    }
}
