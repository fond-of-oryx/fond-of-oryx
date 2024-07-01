<?php

namespace FondOfOryx\Shared\EasyApi;

interface EasyApiConstants
{
    /**
     * @var string
     */
    public const EASY_API_CLIENT_URI = 'FOO:EasyApi:URI';

    /**
     * @var string
     */
    public const EASY_API_CLIENT_USER = 'FOO:EasyApi:USER';

    /**
     * @var string
     */
    public const EASY_API_CLIENT_PASSWORD = 'FOO:EasyApi:PASSWORD';

    /**
     * @var string
     */
    public const EASY_API_CLIENT_HEADER = 'FOO:EasyApi:HEADER';

    /**
     * @var string
     */
    public const EASY_API_CLIENT_ALLOWED_BODY_FIELDS = 'FOO:EasyApi:EASY_API_CLIENT_ALLOWED_BODY_FIELDS';

    /**
     * @var array
     */
    public const EASY_API_CLIENT_ALLOWED_BODY_FIELDS_DEFAULT = ['stores', 'conditions'];

    /**
     * @var string
     */
    public const FIELD_NAME_DOCUMENT_NUMBER = 'DocumentNumber';
}
