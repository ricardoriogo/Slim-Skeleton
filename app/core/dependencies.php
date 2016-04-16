<?php
require(__DIR__ . '/TwigExtensions.php');

// DIC configuration
$container = $app->getContainer();

// View renderer
$container['view'] = function ($c) {
    $config = $c->get('config')['views'];
    $view = new \Slim\Views\Twig($config['path'], [
        'cache' => $config['cache']
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $c['router'],
        $c['request']->getUri()
    ));

    $view->addExtension(new TwigExtension(
        $c['router'],
        $c['request']->getUri()
    ));

    return $view;
};

// Monolog
$container['logger'] = function ($c) {
    $config = $c->get('config')['logger'];
    $logger = new Monolog\Logger($config['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($config['path'], Monolog\Logger::DEBUG));
    return $logger;
};

// PHPMailer
$container['mail'] = function ($c) {
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->setFrom('mail@mail.com.br', 'Name');
    $mail->addAddress('to@mail.com.br');

    $mail->Subject = 'Subject';
    return $mail;
};
