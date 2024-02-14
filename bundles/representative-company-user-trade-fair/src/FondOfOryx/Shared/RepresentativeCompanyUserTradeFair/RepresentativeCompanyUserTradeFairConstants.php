<?php

namespace FondOfOryx\Shared\RepresentativeCompanyUserTradeFair;

interface RepresentativeCompanyUserTradeFairConstants
{
    /**
     * @var string
     */
    public const CONFIG_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_ROLES_TO_REPRESENT = 'FOO:REPRESENTATIVE_COMPANY_USER_TRADE_FAIR:ROLES_TO_REPRESENT';

    /**
     * @var array
     */
    public const CONFIG_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_ROLES_TO_REPRESENT_DEFAULT = [
        'distribution',
        'super_distribution',
    ];
}
