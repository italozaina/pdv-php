# PDV PHP

Este projeto contempla uma estrutura simples de framework PHP sob o conceito MVC e tem como objetivo iniciar novos projetos com uma base simples porem solida para projetos estudantis e comerciais.

# Entendendo a estrutura

É composto por:

* App
    * Controller
    * Model
    * View
    - Config.php
* Core
    - Controller.php
    - Error.php
    - Model.php
    - Router.php
    - View.php
* public
    - index.php
- build
- composer.json

# Iniciando o projeto

Assumindo que o composer esta instalado execute o seguinte comando:

```
composer update
```

Abra o arquivo de configurações **App/Config.php** e insira as informações do seu banco de dados

Coloque seu servidor para rodar diretamente na pasta public com sendo a raiz do site. Ou caso esteja em local rode via PHP por terminal com o seguinte comando.

```
php -S localhost:4000 -t public
```

Crie rotas, adicione controllers, views e models.