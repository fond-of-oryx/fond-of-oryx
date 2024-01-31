<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence;

interface RepresentativeCompanyUserRestApiRepositoryInterface
{
    /**
     * @param string $customerReference
     *
     * @throws \Exception
     *
     * @return int
     */
    public function getIdCustomerByReference(string $customerReference): int;

    /**
     * @param string $mail
     *
     * @throws \Exception
     *
     * @return string
     */
    public function getCustomerReferenceByMail(string $mail): string;
}
