<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Dependency\Facade;

use Generated\Shared\Transfer\CountryTransfer;
use Spryker\Zed\Country\Business\CountryFacadeInterface;

class ErpDeliveryNoteToCountryFacadeBridge implements ErpDeliveryNoteToCountryFacadeInterface
{
    /**
     * @var \FondOfSpryker\Zed\Country\Business\CountryFacade
     */
    protected $facade;

    /**
     * @param \FondOfSpryker\Zed\Country\Business\CountryFacade $facade
     */
    public function __construct(CountryFacadeInterface $facade)
    {
        $this->facade = $facade;
    }

    /**
     * @param int $idCountry
     *
     * @return \Generated\Shared\Transfer\CountryTransfer
     */
    public function getCountryByIdCountry(int $idCountry): CountryTransfer
    {
        return $this->facade->getCountryByIdCountry($idCountry);
    }
}
