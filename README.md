# KaririCode Framework: Exception Component

[![en](https://img.shields.io/badge/lang-en-red.svg)](README.md) [![pt-br](https://img.shields.io/badge/lang-pt--br-green.svg)](README.pt-br.md)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white) ![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white) ![PHPUnit](https://img.shields.io/badge/PHPUnit-3776AB?style=for-the-badge&logo=php&logoColor=white)

A comprehensive and flexible exception handling component for PHP, part of the KaririCode Framework. It provides a structured approach to error management, enhancing the robustness and maintainability of your applications.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
  - [Basic Usage](#basic-usage)
  - [Advanced Usage](#advanced-usage)
- [Error Code Range Table](#error-code-range-table)
- [Available Exception Types](#available-exception-types)
- [Integration with Other KaririCode Components](#integration-with-other-kariricode-components)
- [Development and Testing](#development-and-testing)
- [License](#license)
- [Support and Community](#support-and-community)

## Features

- Hierarchical exception structure for better error categorization
- Context-aware exceptions for richer error information
- Static factory methods for easy exception creation
- Integration with KaririCode's error handling and logging systems
- Extensible architecture allowing custom exception types
- Comprehensive set of pre-defined exception types for common scenarios

## Installation

You can install the Exception component via Composer:

```bash
composer require kariricode/exception
```

### Requirements

- PHP 8.1 or higher
- Composer

## Usage

### Basic Usage

#### Using Pre-defined Exceptions in Your Code

The KaririCode Exception component provides a variety of pre-defined exceptions that you can use to handle common error scenarios in a professional and structured manner. Below is an example of how to use these exceptions in an object-oriented context.

```php
<?php

declare(strict_types=1);

namespace YourApp\Controller;

use YourApp\Service\UserService;
use KaririCode\Contract\Http\Response;
use KaririCode\Contract\Http\ServerRequest;
use KaririCode\Router\Attributes\Route;

final class UserController extends BaseController
{
    public function __construct(private UserService $userService)
    {
    }

    #[Route('/user/{userId}', methods: ['GET'])]
    public function getUserData(ServerRequest $request, Response $response): Response
    {
        $userId = (int)$request->getAttribute('userId');

        try {
            $userData = $this->userService->getUserData($userId);
            return $this->responseBuilder($response)
                ->setData($userData)
                ->setHeader('Content-Type', 'application/json')
                ->setStatus(200)
                ->build();
        } catch (\Exception $e) {
            // Handle exceptions and return appropriate error response
            return $this->errorResponse($response, $e);
        }
    }
}

// UserService.php
namespace YourApp\Service;

use YourApp\Repository\UserRepository;
use KaririCode\Contract\Log\Logger;
use KaririCode\Exception\Database\DatabaseException;

class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private Logger $logger
    ) {
    }

    /**
     * @throws DatabaseException
     */
    public function getUserData(int $userId): array
    {
        try {
            return $this->userRepository->findUserById($userId);
        } catch (DatabaseException $e) {
            $this->logger->error('Failed to retrieve user data', [
                'userId' => $userId,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}

// UserRepository.php
namespace YourApp\Repository;

use KaririCode\Contract\Database\EntityManager;
use KaririCode\Exception\Database\DatabaseException;

class UserRepository
{
    public function __construct(private EntityManager $entityManager)
    {
    }

    /**
     * @throws DatabaseException
     */
    public function findUserById(int $userId): array
    {
        $sql = 'SELECT * FROM users WHERE id = ?';
        try {
            $userData = $this->entityManager->query($sql, [$userId]);

            if (empty($userData)) {
                throw DatabaseException::recordNotFound('User', $userId);
            }

            return $userData;
        } catch (\Exception $e) {
            throw DatabaseException::queryError($sql, $e->getMessage());
        }
    }
}
```

### Advanced Usage

Create custom exceptions by extending the base classes:

```php
<?php

declare(strict_types=1);

namespace YourApp\Exception;

use KaririCode\Exception\AbstractException;

final class OrderException extends AbstractException
{
    private const CODE_ORDER_LIMIT_EXCEEDED = 4001;

    public static function orderLimitExceeded(float $totalAmount, float $userOrderLimit): self
    {
        return self::createException(
            self::CODE_ORDER_LIMIT_EXCEEDED,
            'ORDER_LIMIT_EXCEEDED',
            "Order amount (${totalAmount}) exceeds user limit (${userOrderLimit})"
        );
    }
}
```

Using custom exceptions in your application:

```php
<?php

declare(strict_types=1);

namespace YourApp\Service;

use YourApp\Exception\OrderException;
use YourApp\Repository\OrderRepository;
use KaririCode\Contract\Log\Logger;
use KaririCode\Exception\Database\DatabaseException;

final class OrderService
{
    public function __construct(
        private OrderRepository $orderRepository,
        private Logger $logger
    ) {
    }

    /**
     * @throws OrderException
     * @throws DatabaseException
     */
    public function placeOrder(int $userId, array $items, float $totalAmount): void
    {
        try {
            $userOrderLimit = $this->orderRepository->getUserOrderLimit($userId);

            if ($totalAmount > $userOrderLimit) {
                $this->logger->warning('Order exceeds user limit', [
                    'userId' => $userId,
                    'orderAmount' => $totalAmount,
                    'userLimit' => $userOrderLimit,
                ]);

                throw OrderException::orderLimitExceeded($totalAmount, $userOrderLimit);
            }

            $this->orderRepository->createOrder($userId, $items, $totalAmount);
        } catch (DatabaseException $e) {
            $this->logger->error('Database error while placing order', [
                'userId' => $userId,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}
```

## Error Code Range Table

Here is a proposed table for the **error code ranges**. Each range is assigned to a group of related errors, allowing better organization and identification of errors in the system.

### Error Code Range Table

| Range           | Error Group                 | Description                                           |
| --------------- | --------------------------- | ----------------------------------------------------- |
| **1000 - 1099** | **Authentication Errors**   | Errors related to authentication and login            |
| **1100 - 1199** | **Authorization Errors**    | Errors related to permissions and roles               |
| **1200 - 1299** | **Cache Errors**            | Errors related to cache operations                    |
| **1300 - 1399** | **Configuration Errors**    | Errors related to configuration settings              |
| **1400 - 1499** | **Container Errors**        | Errors related to dependency injection and services   |
| **1500 - 1599** | **Database Errors**         | Errors related to database connections, queries, etc. |
| **1600 - 1699** | **Event Errors**            | Errors related to event handling and dispatching      |
| **1700 - 1799** | **External Service Errors** | Errors related to external API calls and services     |
| **1800 - 1899** | **File System Errors**      | Errors related to file operations (reading, writing)  |
| **1900 - 1999** | **Input/Validation Errors** | Errors related to invalid input or validation         |
| **2000 - 2099** | **Localization Errors**     | Errors related to localization and translations       |
| **2100 - 2199** | **Middleware Errors**       | Errors related to middleware processing               |
| **2200 - 2299** | **Network Errors**          | Errors related to network operations                  |
| **2300 - 2399** | **Queue Errors**            | Errors related to queuing systems                     |
| **2400 - 2499** | **Routing Errors**          | Errors related to routing and HTTP methods            |
| **2500 - 2599** | **Runtime Errors**          | General runtime errors                                |
| **2600 - 2699** | **Encryption Errors**       | Errors related to encryption and decryption           |
| **2700 - 2799** | **Security Errors**         | Errors related to security, access control, etc.      |
| **2800 - 2899** | **Session Errors**          | Errors related to session handling                    |
| **2900 - 2999** | **System Errors**           | Errors related to system resources and environment    |
| **3000 - 3099** | **Template Errors**         | Errors related to template rendering and loading      |
| **3100 - 3199** | **Validation Errors**       | Errors related to data validation                     |
| **4000 - 4099** | **Business Logic Errors**   | Custom errors for business logic violations           |

### Explanation of Each Range:

1. **1000 - 1099: Authentication Errors**

   - Errors related to user authentication, such as invalid credentials, locked accounts, or missing two-factor authentication.

2. **1100 - 1199: Authorization Errors**

   - Errors related to insufficient permissions or missing roles during authorization processes.

3. **... (Same as previous ranges)**

4. **3100 - 3199: Validation Errors**

   - Errors related to data validation.

5. **4000 - 4099: Business Logic Errors**
   - Custom error codes for business logic violations specific to your application.

This structure allows you to easily categorize and expand error codes in the future, keeping the error-handling system organized.

## Available Exception Types

Each exception type is designed to handle specific error scenarios. For detailed information on each exception type, please refer to the [documentation](https://kariricode.org/docs/exception).

## Integration with Other KaririCode Components

The Exception component is designed to work seamlessly with other KaririCode components:

- **KaririCode\Logger**: For advanced error logging and reporting.
- **KaririCode\Http**: For handling HTTP-related exceptions.
- **KaririCode\Database**: For database-specific exceptions.

## Development and Testing

For development and testing purposes, this package uses Docker and Docker Compose to ensure consistency across different environments. A Makefile is provided for convenience.

### Prerequisites

- Docker
- Docker Compose
- Make (optional, but recommended for easier command execution)

### Development Setup

1. Clone the repository:

   ```bash
   git clone https://github.com/KaririCode-Framework/kariricode-exception.git
   cd kariricode-exception
   ```

2. Set up the environment:

   ```bash
   make setup-env
   ```

3. Start the Docker containers:

   ```bash
   make up
   ```

4. Install dependencies:

   ```bash
   make composer-install
   ```

### Available Make Commands

- `make up`: Start all services in the background
- `make down`: Stop and remove all containers
- `make build`: Build Docker images
- `make shell`: Access the PHP container shell
- `make test`: Run tests
- `make coverage`: Run test coverage with visual formatting
- `make cs-fix`: Run PHP CS Fixer to fix code style
- `make quality`: Run all quality commands (cs-check, test, security-check)

For a full list of available commands, run:

```bash
make help
```

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support and Community

- **Documentation**: [https://kariricode.org/docs/exception](https://kariricode.org/docs/exception)
- **Issue Tracker**: [GitHub Issues](https://github.com/KaririCode-Framework/kariricode-exception/issues)
- **Community**: [KaririCode Club Community](https://kariricode.club)

---

Built with ❤️ by the KaririCode team. Empowering developers to handle errors effectively and build more resilient PHP applications.
