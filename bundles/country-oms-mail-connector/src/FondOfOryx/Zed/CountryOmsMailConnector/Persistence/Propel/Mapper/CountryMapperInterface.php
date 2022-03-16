<?php

namespace FondOfOryx\Zed\CountryOmsMailConnector\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CountryTransfer;
use Orm\Zed\Country\Persistence\Base\SpyCountry;

interface CountryMapperInterface
{
    /**
     * @param \Orm\Zed\Country\Persistence\Base\SpyCountry $entity
     *
     * @return \Generated\Shared\Transfer\CountryTransfer
     */
    public function mapEntityToTransfer(SpyCountry $entity): CountryTransfer;
}
