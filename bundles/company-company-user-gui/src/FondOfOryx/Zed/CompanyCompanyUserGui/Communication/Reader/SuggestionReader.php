<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Reader;

use FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Mapper\SuggestionMapperInterface;
use FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\CompanyCompanyUserGuiRepositoryInterface;

class SuggestionReader implements SuggestionReaderInterface
{
    /**
     * @var string
     */
    protected const KEY_RESULTS = 'results';

    /**
     * @var \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Mapper\SuggestionMapperInterface
     */
    protected $suggestionMapper;

    /**
     * @var \FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\CompanyCompanyUserGuiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Mapper\SuggestionMapperInterface $suggestionMapper
     * @param \FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\CompanyCompanyUserGuiRepositoryInterface $repository
     */
    public function __construct(
        SuggestionMapperInterface $suggestionMapper,
        CompanyCompanyUserGuiRepositoryInterface $repository
    ) {
        $this->suggestionMapper = $suggestionMapper;
        $this->repository = $repository;
    }

    /**
     * @param string $term
     *
     * @return array
     */
    public function getByTerm(string $term): array
    {
        $companyTransfers = $this->repository->findByNamePattern($term);

        return [
            static::KEY_RESULTS => $this->suggestionMapper->fromCompanyTransfers($companyTransfers),
        ];
    }
}
