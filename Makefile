.PHONY: help build up down restart install update test logs shell clean

help: ## Show this help message
	@echo "Available commands:"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-15s\033[0m %s\n", $$1, $$2}'

build: ## Build Docker containers
	docker-compose build

up: ## Start Docker containers
	docker-compose up -d

down: ## Stop Docker containers
	docker-compose down

restart: down up ## Restart Docker containers

install: ## Install dependencies
	docker-compose exec app composer install

update: ## Update dependencies
	docker-compose exec app composer update

test: ## Run PHPUnit tests
	docker-compose exec app ./vendor/bin/phpunit

test-coverage: ## Run tests with coverage
	docker-compose exec app ./vendor/bin/phpunit --coverage-html coverage

logs: ## Show Docker logs
	docker-compose logs -f

shell: ## Access container shell
	docker-compose exec app bash

clean: ## Clean up containers and volumes
	docker-compose down -v
	rm -rf vendor/
	rm -rf runtime/*
	rm -rf web/assets/*

init: build up install ## Initialize project (build, start, install)
	@echo "Project initialized successfully!"
	@echo "API is available at http://localhost:8000"

check: ## Check code quality
	docker-compose exec app ./vendor/bin/phpunit --testdox
