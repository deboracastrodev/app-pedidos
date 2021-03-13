# Sistema para gerenciamento de pedidos 

Sua finalidade gerenciar pedidos de restaurantes, onde o cliente acessa um cardápio online, monta seu pedido e envia ao estabelecimento.

Usuários
  - Cliente:
    - Ver cardápio
    - Montar um pedido
    - Fazer um pedido
    - Cancelar um pedido
    - Repetir um pedido
    - Ver tempo de espera do pedido atual
    - Consultar histórico de pedidos

  - Restaurante
    - Montar um cardápio
    - Receber um pedido
    - Aceitar ou recusar um pedido
    - Informar prazo de produção
    - Atualizar status pedido

## Arquitetura
![alt text](https://github.com/deboracastrodev/app-pedidos/blob/master/analise/proposta_arquitetura_app_pedidos.jpeg?raw=true)


A abordagem escolhida para o desenvolvimento é Domain-Driven Design (DDD). Para o desenvolvimento e manutenção do sistema serão utilizados padrões de design seguindo boas práticas, seguindo os princípios do SOLID.

Sistema Admin (UI)
  - Interface para utilização dos clientes e restaurantes.

  Tecnologias:
    - Laravel 
    - Docker
    - PhpUnit

Gateway
  - Proxy para acesso aos microserviços. Responsável pela comunicação com RabbitMQ.

  Tecnologias:
    - Node

Microserviços
  - Apis construídas no padrão Rest. A documentação será apresentada com Swagger. Para comunicação deverá considerado o CIRCUIT BREAKER

  Tecnologias:
    - Lumen
    - Mysql
    - Docker

## Palavras Chave

- Microserviços
- Domain-Driven Design (DDD)
- Testes Unitários
- Testes Automatizados
- Api Gateway
- Design Patterns
- SOLID
- Api RESTfull
- Swagger
- Docker
- Circuit Breaker
- RabbitMQ
- Laravel
- Lumen
- Mysql
- NodeJS