<?php

# Define the routes of your application

return [
    # Ex: The path `/` will trigger the `index` method within the `AppController`
    '/' => ['AppController', 'index'],
    '/process' => ['AppController', 'process'],
    '/resetGame' => ['AppController', 'reset'],
    '/history' => ['AppController', 'history'],
    '/round' => ['AppController', 'round'],
];
