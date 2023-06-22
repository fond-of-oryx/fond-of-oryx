<?php

namespace FondOfOryx\Shared\CompanyUsersBulkRestApi;

interface CompanyUsersBulkRestApiConstants
{
    public const ERROR_MESSAGE_MISSING_PERMISSION = 'Missing permission to create bulk company user!';
    public const ERROR_CODE_PERMISSION_DENIED = 422;

    public const SUCCESS_CODE = 200;
    public const ERROR_CODE = 500;
    public const BULK_ASSIGN = 'BULK_ASSIGN';
    public const BULK_UNASSIGN = 'BULK_UNASSIGN';
}
