<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Dependency\Facade;

use FondOfSpryker\Zed\Country\Business\CountryFacade;
use Generated\Shared\Transfer\CountryTransfer;

class ErpDeliveryNoteToCountryFacadeBridge implements ErpDeliveryNoteToCountryFacadeInterface
{
    /**
     * @var \FondOfSpryker\Zed\Country\Business\CountryFacade
     */
    protected $facade;

    /**
     * @param \FondOfSpryker\Zed\Country\Business\CountryFacade $facade
     */
    public function __construct(CountryFacade $facade)
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
