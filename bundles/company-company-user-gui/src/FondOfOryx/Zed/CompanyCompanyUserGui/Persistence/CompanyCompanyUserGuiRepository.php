<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\CompanyCompanyUserGuiPersistenceFactory getFactory()
 */
class CompanyCompanyUserGuiRepository extends AbstractRepository implements CompanyCompanyUserGuiRepositoryInterface
{
    /**
     * @param int $idCompany
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function getByIdCompany(int $idCompany): ?CompanyTransfer
    {
        $entity = $this->getFactory()
            ->getCompanyQuery()
            ->clear()
            ->findOneByIdCompany($idCompany);

        if ($entity === null) {
            return null;
        }

        return $this->getFactory()
            ->createCompanyMapper()
            ->mapEntityToTransfer($entity);
    }

    /**
     * @param string $namePattern
     *
     * @return array<\Generated\Shared\Transfer\CompanyTransfer>
     */
    public function findByNamePattern(string $namePattern): array
    {
        $config = $this->getFactory()
            ->getConfig();

        /** @var \Propel\Runtime\Collection\ObjectCollection $spyCompanyQueryCollection */
        $spyCompanyQueryCollection = $this->getFactory()
            ->getCompanyQuery()
            ->clear()
            ->filterByName(sprintf('%%%s%%', $namePattern), Criteria::LIKE)
            ->setIgnoreCase(true)
            ->setLimit($config->getSuggestionLimit())
            ->orderByName()
            ->find();

        return $this->getFactory()
            ->createCompanyMapper()
            ->mapEntityCollectionToTransfers($spyCompanyQueryCollection);
    }
}
