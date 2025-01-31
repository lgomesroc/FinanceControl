#!/bin/bash

# Nome do arquivo: project-init.sh
# Coloque na raiz do seu projeto

# Função para mostrar uso
usage() {
    echo "Uso: ./project-init.sh [comando]"
    echo ""
    echo "Comandos:"
    echo "  setup      - Configuração inicial do projeto"
    echo "  start      - Inicia os serviços do Docker"
    echo "  stop       - Para os serviços do Docker"
    echo "  composer   - Roda comandos do Composer"
    echo "  artisan    - Roda comandos do Artisan"
    echo "  migrate    - Roda migrations"
    echo "  fresh      - Reseta o banco e roda migrations"
    echo "  seed       - Roda seeders"
    echo "  test       - Roda testes"
    echo "  bash       - Abre terminal no container"
}

# Verifica se o Docker Sail está disponível
if [ -f "./vendor/bin/sail" ]; then
    DOCKER_COMMAND="./vendor/bin/sail"
else
    DOCKER_COMMAND="docker-compose"
fi

# Comando principal
case "$1" in
    setup)
        $DOCKER_COMMAND up -d
        $DOCKER_COMMAND exec app composer install
        $DOCKER_COMMAND exec app cp .env.example .env
        $DOCKER_COMMAND exec app php artisan key:generate
        $DOCKER_COMMAND exec app php artisan migrate
        ;;
    start)
        $DOCKER_COMMAND up -d
        ;;
    stop)
        $DOCKER_COMMAND down
        ;;
    composer)
        shift
        $DOCKER_COMMAND exec app composer "$@"
        ;;
    artisan)
        shift
        $DOCKER_COMMAND exec app php artisan "$@"
        ;;
    migrate)
        $DOCKER_COMMAND exec app php artisan migrate
        ;;
    fresh)
        $DOCKER_COMMAND exec app php artisan migrate:fresh
        ;;
    seed)
        $DOCKER_COMMAND exec app php artisan db:seed
        ;;
    test)
        $DOCKER_COMMAND exec app ./vendor/bin/phpunit
        ;;
    bash)
        $DOCKER_COMMAND exec app bash
        ;;
    *)
        usage
        exit 1
        ;;
esac
