<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use Orm\Zed\RepresentativeCompanyUserTradeFair\Persistence\FooRepresentativeCompanyUserTradeFair;

class TransferToEntityMapper implements TransferToEntityMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Orm\Zed\RepresentativeCompanyUserTradeFair\Persistence\FooRepresentativeCompanyUserTradeFair
     */
    public function fromRepresentativeCompanyUserTradeFairTransfer(
        RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
    ): FooRepresentativeCompanyUserTradeFair {
        return (new FooRepresentativeCompanyUserTradeFair())->fromArray($representativeCompanyUserTradeFairTransfer->modifiedToArray());
    }
}
