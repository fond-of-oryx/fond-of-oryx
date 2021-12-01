<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Reader;

interface SuggestionReaderInterface
{
    /**
     * @param string $term
     *
     * @return array
     */
    public function getByTerm(string $term): array;
}
