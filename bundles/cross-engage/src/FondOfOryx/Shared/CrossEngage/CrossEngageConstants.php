<?php

namespace FondOfOryx\Shared\CrossEngage;

interface CrossEngageConstants
{
    /**
     * @var string
     */
    public const CROSSENGAGE = 'CROSSENGAGE';

    /**
     * @var string
     */
    public const TOKEN = 'token';

    /**
     * @var string
     */
    public const QUERY_STRING = 'query-string';

    /**
     * @var string
     */
    public const BASE_URL_YVES = 'BASE_URL_YVES';

    /**
     * @var string
     */
    public const OPT_IN_PATH_PATTERN = 'OPT_IN_PATH_PATTERN';

    /**
     * @var string
     */
    public const OPT_IN_PATH_PATTERN_DEFAULT = '%s/%s/confirm-subscription/%s';

    /**
     * @var string
     */
    public const OPT_OUT_PATH_PATTERN = 'OPT_OUT_PATH_PATTERN';

    /**
     * @var string
     */
    public const OPT_OUT_PATH_PATTERN_DEFAULT = '%s/%s/unsubscribe/%s';

    /**
     * @var string
     */
    public const CROSSENGAGE_REDIRECT_PATTERN = 'CROSSENGAGE_REDIRECT_PATTERN';

    /**
     * @var string
     */
    public const CROSSENGAGE_REDIRECT_PATTERN_DEFAULT = '%s/%s/%s';

    /**
     * @var string
     */
    public const ROUTE_CROSSENGAGE_FOOTER = 'ROUTE_CROSSENGAGE_FOOTER';

    /**
     * @var string
     */
    public const ROUTE_CROSSENGAGE_SUBMIT_FORM = 'ROUTE_CROSSENGAGE_SUBMIT_FORM';

    /**
     * @var string
     */
    public const ROUTE_CROSSENGAGE_CONFIRM_SUBSCRIPTION = 'ROUTE_CROSSENGAGE_CONFIRM_SUBSCRIPTION';

    /**
     * @var string
     */
    public const ROUTE_CROSSENGAGE_UNSUBSCRIBE = 'ROUTE_CROSSENGAGE_UNSUBSCRIBE';

    /**
     * @var string
     */
    public const CROSSENGAGE_LOCALIZED_CONFIGS = 'CROSSENGAGE_LOCALIZED_CONFIGS';

    /**
     * @var string
     */
    public const CROSSENGAGE_CONFIRMATION_PATH = 'CROSSENGAGE_CONFIRMATION_PATH';

    /**
     * @var string
     */
    public const CROSSENGAGE_ALREADY_SUBSCRIBED_PATH = 'CROSSENGAGE_ALREADY_SUBSCRIBED_PATH';

    // ROUTE_CROSSENGAGE_SUBSCRIBE
    /**
     * @var string
     */
    public const ROUTE_REDIRECT_CROSSENGAGE_SUBSCRIBE = 'ROUTE_REDIRECT_CROSSENGAGE_SUBSCRIBE';

    /**
     * @var string
     */
    public const ROUTE_REDIRECT_CROSSENGAGE_SUBSCRIPTION_CONFIRMED = 'ROUTE_REDIRECT_CROSSENGAGE_SUBSCRIPTION_CONFIRMED';

    /**
     * @var string
     */
    public const ROUTE_REDIRECT_CROSSENGAGE_ALREADY_SUBSCRIBED = 'ROUTE_REDIRECT_CROSSENGAGE_ALREADY_SUBSCRIBED';

    /**
     * @var string
     */
    public const ROUTE_REDIRECT_CROSSENGAGE_UNSUBSCRIBED = 'ROUTE_REDIRECT_CROSSENGAGE_UNSUBSCRIBED';

    /**
     * @var string
     */
    public const ROUTE_REDIRECT_CROSSENGAGE_FAILURE = 'ROUTE_REDIRECT_CROSSENGAGE_FAILURE';

    // HashAlgo Constants
    /**
     * @var string
     */
    public const CROSSENGAGE_HASH_ALGO = 'CROSSENGAGE_HASH_ALGO';

    /**
     * @var string
     */
    public const CROSSENGAGE_HASH_ALGO_DEFAULT = 'sha1';

    /**
     * @var string
     */
    public const CROSSENGAGE_MODIFY_IN = 'CROSSENGAGE_MODIFY_IN';

    /**
     * @var bool
     */
    public const CROSSENGAGE_MODIFY_IN_DEFAULT = true;

    /**
     * @var string
     */
    public const CROSSENGAGE_MODIFY_OUT = 'CROSSENGAGE_MODIFY_OUT';

    /**
     * @var bool
     */
    public const CROSSENGAGE_MODIFY_OUT_DEFAULT = false;

    /**
     * @var string
     */
    public const CROSSENGAGE_MODIFIER_IN = 'CROSSENGAGE_MODIFIER_IN';

    /**
     * @var string
     */
    public const CROSSENGAGE_MODIFIER_IN_DEFAULT = 'lower';

    /**
     * @var string
     */
    public const CROSSENGAGE_MODIFIER_OUT = 'CROSSENGAGE_MODIFIER_OUT';

    /**
     * @var string
     */
    public const CROSSENGAGE_MODIFIER_OUT_DEFAULT = 'lower';

    // SprykerUpgradeToDo Check if needed
    /**
     * @var string
     */
    public const EDITORIAL_CROSSENGAGE = 'EDITORIAL_CROSSENGAGE';
}
