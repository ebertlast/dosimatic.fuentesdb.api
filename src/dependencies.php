<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['view'] = '';

// mailer
use PHPMailer\PHPMailer\PHPMailer;
$container['mailer'] = function ($container) {
	$mailer = new PHPMailer;
    $conf = $container->get('settings');

    // var_dump($container);
    //Server settings
    $mailer->SMTPDebug = 0;                                   // Enable verbose debug output
    $mailer->isSMTP();                                        // Set mailer to use SMTP
    $mailer->SMTPAuth = $conf['mailer']['SMTPAuth'];          // Enable SMTP authentication
    $mailer->Host = $conf['mailer']['Host'];                  // Specify main and backup SMTP servers
    $mailer->Username = $conf['mailer']['Username'];          // SMTP username
    $mailer->Password = $conf['mailer']['Password'];          // SMTP password
    $mailer->SMTPSecure = $conf['mailer']['SMTPSecure'];      // Enable TLS encryption, `ssl` also accepted
    $mailer->Port = $conf['mailer']['Port'];                  // TCP port to connect to
    $mailer->setFrom($conf['mailer']['MailerMail'], $conf['mailer']['MailerName']);
    $mailer->addReplyTo($conf['mailer']['ReplyToMail'], $conf['mailer']['ReplyToName']);

    //Content
    $mailer->isHTML(true);                                  // Set email format to HTML
    $mailer->CharSet = "UTF-8"; 

	return new \App\Lib\Emailer($container->view, $mailer);
	// return new \App\Lib\Emailer($mailer);
};
