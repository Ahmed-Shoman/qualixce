<?php

return [
    /*
     * If a translation has not been set for a given locale, use this locale instead.
     */
    'fallback_locale' => 'en',

    /*
     * The locales used if not asking for a specific locale.
     */
    'locales' => [
        'en',
        'ar',
    ],

    /*
     * If you want to use country based locales (e.g. en_US, en_GB, etc.)
     * you can set this to true. The country based locales will be
     * generated automatically from the locales array.
     */
    'use_property_fallback' => true,

    /*
     * If you want to use a different locale for the fallback,
     * you can set it here. Otherwise, the fallback_locale will be used.
     */
    'fallback_any_locale' => true,
];
