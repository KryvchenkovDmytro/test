# PowerShell script for managing the project (alternative to Makefile)

param(
    [Parameter(Position=0)]
    [string]$Command = "help"
)

function Show-Help {
    Write-Host "Available commands:" -ForegroundColor Cyan
    Write-Host "  init            - Initialize project (build, start, install)" -ForegroundColor Green
    Write-Host "  build           - Build Docker containers" -ForegroundColor Green
    Write-Host "  up              - Start Docker containers" -ForegroundColor Green
    Write-Host "  down            - Stop Docker containers" -ForegroundColor Green
    Write-Host "  restart         - Restart Docker containers" -ForegroundColor Green
    Write-Host "  install         - Install dependencies" -ForegroundColor Green
    Write-Host "  update          - Update dependencies" -ForegroundColor Green
    Write-Host "  test            - Run PHPUnit tests" -ForegroundColor Green
    Write-Host "  test-coverage   - Run tests with coverage" -ForegroundColor Green
    Write-Host "  logs            - Show Docker logs" -ForegroundColor Green
    Write-Host "  shell           - Access container shell" -ForegroundColor Green
    Write-Host "  clean           - Clean up containers and volumes" -ForegroundColor Green
    Write-Host "  check           - Check code quality" -ForegroundColor Green
}

function Build {
    Write-Host "Building Docker containers..." -ForegroundColor Yellow
    docker-compose build
}

function Up {
    Write-Host "Starting Docker containers..." -ForegroundColor Yellow
    docker-compose up -d
}

function Down {
    Write-Host "Stopping Docker containers..." -ForegroundColor Yellow
    docker-compose down
}

function Restart {
    Down
    Up
}

function Install {
    Write-Host "Installing dependencies..." -ForegroundColor Yellow
    docker-compose exec app composer install
}

function Update {
    Write-Host "Updating dependencies..." -ForegroundColor Yellow
    docker-compose exec app composer update
}

function Test {
    Write-Host "Running tests..." -ForegroundColor Yellow
    docker-compose exec app ./vendor/bin/phpunit
}

function Test-Coverage {
    Write-Host "Running tests with coverage..." -ForegroundColor Yellow
    docker-compose exec app ./vendor/bin/phpunit --coverage-html coverage
}

function Show-Logs {
    docker-compose logs -f
}

function Shell {
    docker-compose exec app bash
}

function Clean {
    Write-Host "Cleaning up..." -ForegroundColor Yellow
    docker-compose down -v
    if (Test-Path "vendor") { Remove-Item -Recurse -Force vendor }
    if (Test-Path "runtime") { Get-ChildItem -Path runtime -Exclude .gitkeep | Remove-Item -Recurse -Force }
    if (Test-Path "web/assets") { Get-ChildItem -Path web/assets -Exclude .gitkeep | Remove-Item -Recurse -Force }
}

function Init {
    Build
    Up
    Start-Sleep -Seconds 3
    Install
    Write-Host "`nProject initialized successfully!" -ForegroundColor Green
    Write-Host "API is available at http://localhost:8000" -ForegroundColor Cyan
}

function Check {
    Write-Host "Checking code quality..." -ForegroundColor Yellow
    docker-compose exec app ./vendor/bin/phpunit --testdox
}

switch ($Command.ToLower()) {
    "help" { Show-Help }
    "build" { Build }
    "up" { Up }
    "down" { Down }
    "restart" { Restart }
    "install" { Install }
    "update" { Update }
    "test" { Test }
    "test-coverage" { Test-Coverage }
    "logs" { Show-Logs }
    "shell" { Shell }
    "clean" { Clean }
    "init" { Init }
    "check" { Check }
    default {
        Write-Host "Unknown command: $Command" -ForegroundColor Red
        Show-Help
    }
}
