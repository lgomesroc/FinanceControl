# FinanceControl

FinanceControl é um sistema de controle financeiro pessoal desenvolvido para ajudar usuários a gerenciar suas receitas, despesas e metas financeiras de maneira eficiente e organizada. Este projeto utiliza tecnologias modernas como Laravel, Node.js e Angular, com suporte a Docker para facilitar o ambiente de desenvolvimento e implantação.

## Funcionalidades

- **Gerenciamento de receitas e despesas**: Controle detalhado de entradas e saídas financeiras.
- **Metas financeiras**: Estabeleça e acompanhe objetivos financeiros.
- **Gráficos dinâmicos**: Visualização interativa de dados financeiros.
- **Alertas de orçamento**: Notificações quando os limites definidos forem atingidos.
- **Relatórios**: Exportação de relatórios em formatos PDF e Excel.
- **Suporte a múltiplos usuários**: Gerenciamento de contas de forma independente.

## Tecnologias Utilizadas

- **Backend**: Laravel 11, PHP 8.3
- **Frontend**: Angular CLI
- **Banco de Dados**: MySQL
- **Containerização**: Docker

## Requisitos

- Docker e Docker Compose instalados
- Node.js 18.19 ou superior
- Composer 2.7.9 ou superior

## Configuração do Ambiente

1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/FinanceControl.git
   cd FinanceControl
   ```

2. Construa e inicie os contêineres:
   ```bash
   docker-compose up --build
   ```

3. Instale as dependências do Laravel dentro do contêiner:
   ```bash
   docker exec -it laravel-app bash
   composer install
   ```

4. Configure o arquivo `.env`:
    - Copie o arquivo de exemplo:
      ```bash
      cp backend/.env.example backend/.env
      ```
    - Atualize as variáveis de ambiente, como as credenciais do banco de dados.

5. Gere a chave da aplicação Laravel:
   ```bash
   php artisan key:generate
   ```

6. Execute as migrações para criar as tabelas no banco de dados:
   ```bash
   php artisan migrate
   ```

## Uso

Após configurar o ambiente, o sistema estará disponível em `http://localhost:8080`.

- **Frontend**: Interaja com a interface do usuário.
- **Backend**: APIs disponíveis para integração.

## Estrutura do Projeto

```plaintext
FinanceControl/
├── backend/         # Código do servidor Laravel
├── frontend/        # Aplicação Angular
├── docker-compose.yml
├── Dockerfile
├── nginx/           # Configurações do servidor Nginx
└── default.conf
```

## Contribuição

Contribuições são bem-vindas! Para contribuir:

1. Faça um fork do repositório.
2. Crie um branch para sua feature ou correção:
   ```bash
   git checkout -b minha-feature
   ```
3. Commit suas mudanças:
   ```bash
   git commit -m "Descrição da minha feature"
   ```
4. Envie para o repositório remoto:
   ```bash
   git push origin minha-feature
   ```
5. Abra um Pull Request.

## Licença

Este projeto está licenciado sob a licença MIT. Consulte o arquivo LICENSE para mais detalhes.
