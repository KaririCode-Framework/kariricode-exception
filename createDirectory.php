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

$baseDir = __DIR__ . '/tests';

// Directories and their respective files
$structure = [
    'AbstractExceptionTest.php',
    'AbstractErrorMessageTest.php',
    'Contract/ErrorMessageTest.php',
    'Contract/ThrowableTest.php',
    'CommonErrorMessagesTest.php',
    'Auth/AuthenticationExceptionTest.php',
    'Auth/AuthorizationExceptionTest.php',
    'Validation/ValidationExceptionTest.php',
    'Validation/RuleViolationExceptionTest.php',
    'File/FileExceptionTest.php',
    'Input/InputExceptionTest.php',
    'Runtime/RuntimeExceptionTest.php',
    'System/SystemExceptionTest.php',
    'Security/SecurityExceptionTest.php',
    'Security/EncryptionExceptionTest.php',
    'Config/ConfigurationExceptionTest.php',
    'Network/NetworkExceptionTest.php',
    'Network/HttpExceptionTest.php',
    'Database/DatabaseExceptionTest.php',
    'Cache/CacheExceptionTest.php',
    'ExternalService/ExternalServiceExceptionTest.php',
    'Localization/LocalizationExceptionTest.php',
    'Event/EventExceptionTest.php',
    'Middleware/MiddlewareExceptionTest.php',
    'Queue/QueueExceptionTest.php',
    'Routing/RoutingExceptionTest.php',
    'Template/TemplateExceptionTest.php',
    'Session/SessionExceptionTest.php',
    'Container/ContainerExceptionTest.php',
];

// Create directories and files for tests
foreach ($structure as $filePath) {
    $fullPath = $baseDir . '/' . $filePath;
    $directory = dirname($fullPath);

    // Create the directory if it doesn't exist
    createDirectory($directory);

    // Create the file with the appropriate content
    createFile($fullPath);
}

echo "Test directories and files created successfully!\n";
