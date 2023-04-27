<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUser;

interface TransferToEntityMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUser
     */
    public function fromRepresentativeCompanyUserTransfer(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): FooRepresentativeCompanyUser;
}
