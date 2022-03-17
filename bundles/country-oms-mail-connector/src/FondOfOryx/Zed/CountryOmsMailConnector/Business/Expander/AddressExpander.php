<?php

namespace FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander;

use FondOfOryx\Zed\CountryOmsMailConnector\Persistence\CountryOmsMailConnectorRepositoryInterface;
use Generated\Shared\Transfer\AddressTransfer;

class AddressExpander implements AddressExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\CountryOmsMailConnector\Persistence\CountryOmsMailConnectorRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CountryOmsMailConnector\Persistence\CountryOmsMailConnectorRepositoryInterface $repository
     */
    public function __construct(CountryOmsMailConnectorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer
     */
    public function expand(AddressTransfer $addressTransfer): AddressTransfer
    {
        if (!$this->canExpand($addressTransfer)) {
            return $addressTransfer;
        }

        $countryTransfer = $this->repository->getCountryByIdCountry($addressTransfer->getFkCountry());

        if ($countryTransfer === null) {
            return $addressTransfer;
        }

        return $addressTransfer->setCountry($countryTransfer)
            ->setIso2Code($countryTransfer->getIso2Code());
    }

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return bool
     */
    protected function canExpand(AddressTransfer $addressTransfer): bool
    {
        return $addressTransfer->getFkCountry() !== null
            && $addressTransfer->getCountry() === null
            && $addressTransfer->getIso2Code() === null;
    }
}
