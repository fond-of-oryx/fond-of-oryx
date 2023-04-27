<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentation;

interface EntityToTransferMapperInterface
{
    /**
     * @param \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentation $entity
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function fromRepresentationEntity(FooRepresentation $entity): RepresentativeCompanyUserTransfer;
}
