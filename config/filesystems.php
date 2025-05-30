<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        // 'gcs' => [
        //     'driver' => 'gcs',
        //     'key_file_path' => env('GOOGLE_CLOUD_KEY_FILE'),        // :contentReference[oaicite:1]{index=1}
        //     'project_id'    => env('GOOGLE_CLOUD_PROJECT_ID'),      // :contentReference[oaicite:2]{index=2}
        //     'bucket'        => env('GOOGLE_CLOUD_STORAGE_BUCKET'),  // :contentReference[oaicite:3]{index=3}
        //     'path_prefix'   => env('GOOGLE_CLOUD_STORAGE_PATH_PREFIX', ''), 
        //     'storage_api_uri'    => env('GOOGLE_CLOUD_STORAGE_API_URI', null),
        //     'api_endpoint'       => env('GOOGLE_CLOUD_STORAGE_API_ENDPOINT', null),
        //     'visibility'         => 'public',    // atau 'private'
        //     'visibility_handler' => null,        // untuk uniform bucket-level access
        //     'metadata'           => ['cacheControl' => 'public,max-age=86400'],
        // ],
          'gcs' => [
            'driver' => 'gcs',
            // 'key_file_path' => env('GOOGLE_CLOUD_KEY_FILE', base_path('service-account.json')), // optional: /path/to/service-account.json
            'key_file_path' => env('GOOGLE_CLOUD_KEY_FILE')
                ? base_path(env('GOOGLE_CLOUD_KEY_FILE'))
                : null,
            'key_file' => [], // optional: Array of data that substitutes the .json file (see below)
            'project_id' => env('GOOGLE_CLOUD_PROJECT_ID', 'your-project-id'), // optional: is included in key file
            'bucket' => env('GOOGLE_CLOUD_STORAGE_BUCKET', 'your-bucket'),
            'path_prefix' => env('GOOGLE_CLOUD_STORAGE_PATH_PREFIX', ''), // optional: /default/path/to/apply/in/bucket
            'storage_api_uri' => env('GOOGLE_CLOUD_STORAGE_API_URI', null), // see: Public URLs below
            'apiEndpoint' => env('GOOGLE_CLOUD_STORAGE_API_ENDPOINT', null), // set storageClient apiEndpoint
            'visibility' => 'public', // optional: public|private
            'visibility_handler' => null, // optional: set to \League\Flysystem\GoogleCloudStorage\UniformBucketLevelAccessVisibility::class to enable uniform bucket level access
            'metadata' => ['cacheControl'=> 'public,max-age=86400'], // optional: default metadata
        ],
          



    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

    

];
