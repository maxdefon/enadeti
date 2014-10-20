# Estacio TI - ENADE

Projeto para a Estácio Integra TI, sobre o ENADE.

Time:

- Girlaine Neves
- Maxwell Lima
- Diogo Silva

## Descrição

## Desenvolvimento

Clone o repositório:

    $ git clone git@github.com:maxdefon/enadeti

### Vagrant

A forma mais fácil de começar é usando [Vagrant](http://vagrantup.com) e [VirtualBox](http://virtualbox.org).

Com eles instalados, basta entrar na pasta do projeto e criar a maquina virtual do mesmo:

    $ cd enadeti
    $ vagrant up 
    $ vagrant ssh

### Manual

Instale o Apache+PHP+MySql de acordo com sua configuração, crie um banco de dados e carregue o "schema.sql" e edite a entrada "dev" do arquivo "config.yml" de acordo.

Em seguida, dentro da pasta do projeto, instale o [Composer][http://composer.org] e as dependencias do projeto:

    $ cd enadeti
    $ curl -sS https://getcomposer.org/installer | php
    $ php composer.phar install

### Tarefas

    $ ./vendor/bin/phake -T 

## Licença

MIT

