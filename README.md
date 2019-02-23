## Modelo básico de projeto sobre `MVC`

Modelo simples baseado no padrão de projetos MVC.

## Instalação ##


````bash
$ composer install
````

 Após instalar os pacotes através do gerenciador de dependências (Composer), crie um banco e insira suas configurações de conexões no arquivo __phinx.yml__ na raiz do projeto, como mostra o exemplo abaixo.

 ````yml
 environments:
    default_migration_table: migrationlog
    default_database: production
    production:
        adapter: mysql
        host: localhost
        name: bd_name
        user: user_db
        pass: 'pass_db'
        port: 3306
        charset: utf8
 ````
> Obs: _Este projeto foi adaptado para banco de dados MySql. Caso exista a necessidade de inclusão de um novo banco, vá até o arquivo `src/Core/Model.php` e realize as inclusões das configurações necessárias no método `config()`._

`Migrations`

O próximo passo é criar as migratios do seu sistema. O diretório das *Migratios* e das *Seeds* encontra-se no caminho `src/database`.

> Qualquer dúvida sobre a criação de Migrations, Seeds e suas funcionalidades, confira a [documentação](https://book.cakephp.org/3.0/en/phinx.html).

Para rodar as migrations vá para a raiz do projeto e execute o comando abaixo para criar as tabelas no banco de dados.

````bash
$ vendor\bin\phinx migrate -e production
````
Após isso, caso exista Seeds configuradas, execute o comando descrito abaixo para popular as tabelas:

````bash
$ vendor\bin\phinx seed:run
````

> Qualquer dúvida sobre este processo, recomendo a leitura deste [post](https://medium.com/@lira92/trabalhando-com-migrations-com-phinx-df0461e6182e).


`Constantes do sistema`

No arquivo _config.php_ a constante __BASE_URL__ define a url padrão do servidor. 
````php
<?php

define("BASE_URL", "http://localhost");

````
### Atenção!


O _.htaccess_ deve ser alterado juntamente com a constante __BASE_URL__ caso a url padrão do servidor aponte para alguma pasta.


