<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;
use Propel\Runtime\Collection\ObjectCollection;

class CompanyUserMapper implements CompanyUserMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CustomerMapperInterface
     */
    protected $customerMapper;

    /**
     * @var \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CompanyRoleMapperInterface
     */
    protected $companyRoleMapper;

    /**
     * @param \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CustomerMapperInterface $customerMapper
     * @param \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CompanyRoleMapperInterface $companyRoleMapper
     */
    public function __construct(
        CustomerMapperInterface $customerMapper,
        CompanyRoleMapperInterface $companyRoleMapper
    ) {
        $this->customerMapper = $customerMapper;
        $this->companyRoleMapper = $companyRoleMapper;
    }

    /**
     * @param \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser $entity
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function mapEntityToTransfer(SpyCompanyUser $entity): CompanyUserTransfer
    {
        $customerTransfer = $this->customerMapper->mapCompanyUserEntityToTransfer($entity);
        $companyRoleTransfers = $this->companyRoleMapper->mapCompanyUserEntityToTransfer($entity);
        $companyRoleCollectionTransfer = (new CompanyRoleCollectionTransfer())->setRoles(
            new ArrayObject($companyRoleTransfers),
        );

        return (new CompanyUserTransfer())
            ->fromArray($entity->toArray(), true)
            ->setCustomerReference($customerTransfer->getCustomerReference())
            ->setCompanyUuid($entity->getCompany()->getUuid())
            ->setCustomer($customerTransfer)
            ->setCompanyRoleCollection($companyRoleCollectionTransfer);
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\CompanyUser\Persistence\SpyCompanyUser[] $entityCollection
     *
     * @return array<\Generated\Shared\Transfer\CompanyUserTransfer>
     */
    public function mapEntityCollectionToTransfers(ObjectCollection $entityCollection): array
    {
        $transfers = [];

        foreach ($entityCollection as $entity) {
            $transfers[] = $this->mapEntityToTransfer($entity);
        }

        return $transfers;
    }
}
