<?php

return [

    /*
     * R4nkt will sign webhooks using a secret. You can find the secret used for individual
     * games at the game configuration settings: https://r4nkt.com/settings/games
     */
    'signing_secret' => env('R4NKT_SIGNING_SECRET'),

    /*
     * Here you can define the job that should be run when a certain webhook hits your
     * application.
     *
     * You can find a list of R4nkt webhook types here:
     * https://r4nkt.com/docs/webhooks/events
     */
    'jobs' => [
        // 'badgeEarned' => \App\Jobs\R4nktWebhooks\HandleBadgeEarned::class,
        // ...
    ],
];
