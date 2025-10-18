# Yii2 REST API - Сума парних чисел

REST API на Yii2 для обчислення суми парних чисел з масиву.

## Інструкція з встановлення

### Windows (PowerShell)

```powershell
.\run.ps1 init
```

### Linux/Mac

```bash
make init
```

### Універсальний спосіб

```bash
docker-compose build
docker-compose up -d
docker-compose exec app composer install
```

API буде доступний за адресою: **http://localhost:8000**

## Приклади використання

### API Endpoint

```
POST /api/sum-even
Content-Type: application/json
```

### Формат запиту

```json
{
  "numbers": [1, 2, 3, 4, 5, 6]
}
```

**Поля:**
- `numbers` (array, обов'язкове) - масив цілих чисел (integer)

### Приклади запитів

#### curl (Linux/Mac/Git Bash)

```bash
curl -X POST http://localhost:8000/api/sum-even \
  -H "Content-Type: application/json" \
  -d '{"numbers": [1, 2, 3, 4, 5, 6]}'
```

**Результат:** `{"sum": 12}` (2 + 4 + 6 = 12)

#### PowerShell (Windows)

```powershell
$body = @{
    numbers = @(1, 2, 3, 4, 5, 6)
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://localhost:8000/api/sum-even" `
  -Method Post `
  -Body $body `
  -ContentType "application/json"
```

## Опис структури проекту

### Структура проекту

```
test/
├── config/                      # Конфігурація Yii2
│   └── web.php                  # Основна конфігурація додатку
│
├── docker/                      # Docker конфігурація
│   ├── nginx/
│   │   └── default.conf         # Налаштування Nginx
│   └── supervisor/
│       └── supervisord.conf     # Налаштування Supervisor
│
├── src/                         # Вихідний код додатку
│   ├── Controllers/
│   │   └── ApiController.php    # REST API контролер
│   ├── Dtos/
│   │   ├── Request/
│   │   │   └── NumbersRequestDto.php   # Request DTO
│   │   └── Response/
│   │       └── SumResponseDto.php      # Response DTO
│   ├── Interfaces/
│   │   └── CalculatorInterface.php     # Інтерфейс калькулятора
│   ├── Models/
│   │   └── NumbersForm.php      # Модель валідації
│   ├── Resources/
│   │   ├── JsonResource.php     # Базовий клас для ресурсів
│   │   ├── SumResource.php      # Ресурс для відповіді
│   │   └── ErrorResource.php    # Ресурс для помилок
│   ├── Services/
│   │   └── EvenNumbersCalculator.php   # Бізнес-логіка
│   └── UseCases/
│       └── CalculateSumOfEvenNumbersUseCase.php   # Use Case
│
├── tests/                       # Тести
│   ├── Unit/                   # Unit тести
│   │   ├── Dtos/               # Тести для DTO
│   │   ├── Models/             # Тести для моделей
│   │   └── Services/           # Тести для сервісів
│   ├── Integration/            # Інтеграційні тести
│   │   └── ApiTest.php         # API тести (HTTP запити)
│   └── bootstrap.php
│
├── web/                         # Публічна директорія
│   ├── assets/                  # Згенеровані ассети
│   └── index.php                # Точка входу
│
├── docker-compose.yml           # Docker Compose конфігурація
├── Dockerfile                   # Docker образ
├── Makefile                     # Make команди (Linux/Mac)
├── run.ps1                      # PowerShell скрипт (Windows)
├── phpunit.xml                  # PHPUnit конфігурація
└── composer.json                # PHP залежності
```
