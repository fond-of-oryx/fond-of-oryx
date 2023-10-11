<?php

namespace FondOfOryx\Shared\CompanyUserMailConnector;

interface CompanyUserMailConnectorConstants
{
    public const ROLES_TO_INFORM_ABOUT_LIST = 'FOO:COMPANY_USER_MAIL_CONNECTOR:ROLES_TO_INFORM_ABOUT_LIST';
    public const ROLES_TO_INFORM_ABOUT_LIST_DEFAULT = ['administration', 'marketing', 'purchase'];
    public const ROLES_TO_NOTIFY = 'FOO:COMPANY_USER_MAIL_CONNECTOR:ROLES_TO_NOTIFY';
    public const ROLES_TO_NOTIFY_DEFAULT = ['administration'];
}
