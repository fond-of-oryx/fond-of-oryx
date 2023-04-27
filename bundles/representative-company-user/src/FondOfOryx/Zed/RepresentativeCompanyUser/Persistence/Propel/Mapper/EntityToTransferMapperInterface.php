<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUser;

interface EntityToTransferMapperInterface
{
    /**
     * @param \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUser $entity
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function fromRepresentativeCompanyUserEntity(FooRepresentativeCompanyUser $entity): RepresentativeCompanyUserTransfer;
}
