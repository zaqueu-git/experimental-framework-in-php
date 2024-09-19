# Estrutura Experimental em PHP

Base para o desenvolvimento de projetos PHP, incluindo práticas e ferramentas para teste e validação de funcionalidades.

## Instalação

1. Clone o repositório: git clone https://github.com/usuario/nome-do-projeto.git

2. Navegue até o diretório do projeto: cd nome-do-projeto

3. Instale as dependências: composer install

4. Configure o VirtualHost:
- Edite httpd-vhosts.conf
- Defina DocumentRoot como o caminho do projeto
- Defina ServerName como experimental-framework-in-php

5. Acesse o projeto no navegador: Digite experimental-framework-in-php

### Estrutura

1. composer.json: Gerencia dependências

2. .env: Configura variáveis de ambiente

3. zkFramework: Estrutura principal de desenvolvimento

4. routes: Define rotas do sistema

5. public: Contém arquivos públicos

6. app: Código da aplicação

7. api: Endpoints da API

### zkFramework

1. Facade.php: Fornece uma fachada simplificada para o sistema, integrando e expondo funcionalidades principais.

2. Arquivos de apoio: Auxiliam a fachada na gestão do sistema.

### routes

1. app.php: Define as rotas para a aplicação web, especificando URLs e seus manipuladores.

2. api.php: Define as rotas para a API, configurando endpoints e suas respectivas funções.

### Inicializador

A classe Facade.php é instanciada em public/app/index.php, iniciando a aplicação e gerenciando a integração dos componentes.