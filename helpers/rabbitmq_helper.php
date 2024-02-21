<?php
/**
 * Global function rabbitmq
 * place for all global function
 * Author : zainul23
 * Link : https://github.com/zainul23
 * date : 2024-02-21
 */

/*
List Functions :
	- hello
    - return_hello
*/
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$GLOBALS['CI'] =& get_instance();
if (! function_exists('push'))
{
	function push($queue ,$val) {
		global $CI;
		if (empty($val)){
			// $error = 'value is empty';
            echo "value is empty";
        }

        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
		$channel = $connection->channel();

		$channel->queue_declare($queue, false, false, false, false);

		$msg = new AMQPMessage($val);
		$channel->basic_publish($msg, '', $queue);
		echo ' [x] sent ', $msg->getBody(), "\n";

        $channel->close(); 
        $connection->close();
	}
}

if (! function_exists('pull'))
{
	function pull($queue) {
		global $CI;

        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
		$channel = $connection->channel();

		$channel->queue_declare($queue, false, false, false, false);

		echo " [*] Waiting for messages. To exit press CTRL+C\n";
		$callback = function ($msg) {
			echo ' [x] Received ', $msg->getBody(), "\n";
		};

		$channel->basic_consume($queue, '', false, true, false, false, $callback);

		try {
			$channel->consume();
		} catch (\Throwable $exception) {
			echo $exception->getMessage();
		}

		$channel->close();
		$connection->close();
	}
}