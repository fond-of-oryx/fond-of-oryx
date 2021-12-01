<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Mapper;

class SuggestionMapper implements SuggestionMapperInterface
{
    /**
     * @var string
     */
    protected const KEY_ID = 'id';

    /**
     * @var string
     */
    protected const KEY_TEXT = 'text';

    /**
     * @param array<\Generated\Shared\Transfer\CompanyTransfer> $companyTransfers
     *
     * @return array
     */
    public function fromCompanyTransfers(array $companyTransfers): array
    {
        $suggestions = [];

        foreach ($companyTransfers as $companyTransfer) {
            $suggestions[] = [
                static::KEY_ID => $companyTransfer->getIdCompany(),
                static::KEY_TEXT => sprintf(
                    '%s (ID: %d)',
                    $companyTransfer->getName(),
                    $companyTransfer->getIdCompany(),
                ),
            ];
        }

        return $suggestions;
    }
}
