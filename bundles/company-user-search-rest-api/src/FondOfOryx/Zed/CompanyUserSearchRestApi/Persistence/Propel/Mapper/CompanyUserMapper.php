<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper;

use ArrayObject;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Expander\CompanyUserTransferPostMapExpanderInterface;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;
use Propel\Runtime\Collection\ObjectCollection;

/**
 * @codeCoverageIgnore
 */
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

    protected CompanyUserTransferPostMapExpanderInterface $postMapExpander;

    /**
     * @param \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CustomerMapperInterface $customerMapper
     * @param \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CompanyRoleMapperInterface $companyRoleMapper
     * @param \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Expander\CompanyUserTransferPostMapExpanderInterface $postMapExpander
     */
    public function __construct(
        CustomerMapperInterface $customerMapper,
        CompanyRoleMapperInterface $companyRoleMapper,
        CompanyUserTransferPostMapExpanderInterface $postMapExpander
    ) {
        $this->customerMapper = $customerMapper;
        $this->companyRoleMapper = $companyRoleMapper;
        $this->postMapExpander = $postMapExpander;
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

        $companyUserTransfer = (new CompanyUserTransfer())
            ->fromArray($entity->toArray(), true)
            ->setCustomerReference($customerTransfer->getCustomerReference())
            ->setCompanyUuid($entity->getCompany()->getUuid())
            ->setCustomer($customerTransfer)
            ->setCompanyRoleCollection($companyRoleCollectionTransfer);

        return $this->postMapExpander->expand($companyUserTransfer, $entity);
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\CompanyUser\Persistence\SpyCompanyUser> $entityCollection
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
