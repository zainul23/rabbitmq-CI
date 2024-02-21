# Library rabbitmq codeigniter 3
    library rabbitmq with codeigniter 3.1.10, to use this library read this README first

### Requirements
1. you need a `RabbitMQ :` [windows installer](https://www.rabbitmq.com/install-windows.html)
2. you need `PHP >7.2` and `php-amqlib`.
3. install composer [composer](https://getcomposer.org/download/)
4. install ``codeigniter 3.1.10``
5. then you can install `php-amqlib`, using [composer](https://getcomposer.org/download/) to get the dependencies, or you can require it to the exixsting project using a command :

    ```
    php composer require php-amqplib/php-amqplib
    ```

### setup Codeigniter

1. update `config.php`
    ```
    $config['composer_autoload'] = FCPATH.'vendor/autoload.php';
    ```
2. copy file `rabbitmq_helper.php` and paste to `helpers` folder 

3. after copy rabbitmq_helper.php setting autoload.php
    ```
    $autoload['helper'] = array('rabbitmq');
    ```
4. example send queue message 
    ```
    public function push($queue, $msg) {
        push($queue, $msg);
    }
    ```
5. example pull message
    ```
    public function pull($msg) {
        pull($msg);
    }
    ```
### example usage in CLI
1. send queue to rabbitmq
    ```
    php index.php controllerName/queueName/msg
    ```
   result CLI

   ![sent](http://localhost/github/rabbitmq-library-codeigniter-3/images/sent.png)
2. pull queue message 
    ```
    php index.php controllerName/queue
    ```
    result CLI :
    
    ![pull](http://localhost/github/rabbitmq-library-codeigniter-3/images/pull.png)
    
### update php-amqlib to ^3.2 use this command
Note: when php-amqlib cannot use version `^3.2` following step bellow : 

1. remove composer.lock

2. run this command :
    ```
    composer install --ignore-platform-req=ext-sockets
    ```