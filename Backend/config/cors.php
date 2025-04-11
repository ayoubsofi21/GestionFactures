<?php 
    return [

        'paths' => ['api/*'], // Allow only API routes (or add more paths)
    
        'allowed_methods' => ['*'], // Allow all HTTP methods
    
        'allowed_origins' => ['http://localhost:3000'], // React app
    
        'allowed_origins_patterns' => [],
    
        'allowed_headers' => ['*'],
    
        'exposed_headers' => [],
    
        'max_age' => 0,
    
        'supports_credentials' => false, // Set true if you're using cookies or auth headers
    
    ];
    
?>