<?php

declare(strict_types=1);

function createDirectory(string $path): void
{
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }
}

function createFile(string $filePath): void
{
    $content = "<?php\n\ndeclare(strict_types=1);\n";
    if (!file_exists($filePath)) {
        file_put_contents($filePath, $content);
    }
}

$baseDir = __DIR__ . '/src';

// Directories and their respective files
$structure = [
    'AbstractException.php',
    'AbstractErrorMessage.php',
    'Contract/ErrorMessage.php',
    'Contract/Throwable.php',
    'CommonErrorMessages.php',
    'Auth/AuthenticationException.php',
    'Auth/AuthorizationException.php',
    'Validation/ValidationException.php',
    'Validation/RuleViolationException.php',
    'File/FileException.php',
    'Input/InputException.php',
    'Runtime/RuntimeException.php',
    'System/SystemException.php',
    'Security/SecurityException.php',
    'Security/EncryptionException.php',
    'Config/ConfigurationException.php',
    'Network/NetworkException.php',
    'Network/HttpException.php',
    'Database/DatabaseException.php',
    'Cache/CacheException.php',
    'ExternalService/ExternalServiceException.php',
    'Localization/LocalizationException.php',
    'Event/EventException.php',
    'Middleware/MiddlewareException.php',
    'Queue/QueueException.php',
    'Routing/RoutingException.php',
    'Template/TemplateException.php',
    'Session/SessionException.php',
    'Container/ContainerException.php',
];

// Create directories and files
foreach ($structure as $filePath) {
    $fullPath = $baseDir . '/' . $filePath;
    $directory = dirname($fullPath);

    // Create the directory if it doesn't exist
    createDirectory($directory);

    // Create the file with the appropriate content
    createFile($fullPath);
}

echo "Directories and files created successfully!\n";
