<?php

declare(strict_types=1);

return [
    /*
     * Keep versions, you can redefine in target model.
     * Default: 0 - Keep all versions.
     */
    'keep_versions' => 0,

    /*
     * User foreign key name of versions table.
     */
    'user_foreign_key' => 'user_id',

    /*
     * The model class for store versions.
     */
    'version_model' => \Overtrue\LaravelVersionable\Version::class,

    /**
     * The model class for user.
     */
    'user_model' => RectitudeOpen\FilaPressCore\Models\Admin::class,

    /**
     * Use uuid for version id.
     */
    'uuid' => false,
];
