<?php

namespace FondOfOryx\Shared\CompanyUserMailConnector;

interface CompanyUserMailConnectorConstants
{
    /**
     * @var string
     */
    public const ROLES_TO_INFORM_ABOUT_LIST = 'FOO:COMPANY_USER_MAIL_CONNECTOR:ROLES_TO_INFORM_ABOUT_LIST';

    /**
     * @var array
     */
    public const ROLES_TO_INFORM_ABOUT_LIST_DEFAULT = ['administration', 'marketing', 'purchase'];

    /**
     * @var string
     */
    public const ROLES_TO_NOTIFY = 'FOO:COMPANY_USER_MAIL_CONNECTOR:ROLES_TO_NOTIFY';

    /**
     * @var array
     */
    public const ROLES_TO_NOTIFY_DEFAULT = ['administration'];
}
