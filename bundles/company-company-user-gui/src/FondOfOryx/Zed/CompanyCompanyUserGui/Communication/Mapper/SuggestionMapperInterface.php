<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Mapper;

interface SuggestionMapperInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\CompanyTransfer> $companyTransfers
     *
     * @return array
     */
    public function fromCompanyTransfers(array $companyTransfers): array;
}
