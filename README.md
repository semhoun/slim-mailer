# Slim4 Mailer

Email support for the Slim 4 Framework using Twig and 
[Swift Mailer](https://github.com/swiftmailer/swiftmailer). Mailable classes will
massively  tidy up your controller methods or routes, and will make sending email 
a breeze.

## License

Licensed under MIT. Totally free for private or commercial projects.

Derivated from https://github.com/andrewdyer/slim3-mailer

## Installation

```bash
composer require semhoun/slim-mailer
```

## Usage

Attach a new instance of `Semhoun\Mailer\Mailer` to your applications container so 
it can be accessed anywhere you need. `Mailer` takes two arguments; an instance of 
`Slim\Views\Twig` and an optional array of SMTP settings.

```php
$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
	'mailer' => function (ContainerInterface $container) {
            $settings = $container->get('settings');
            $view = $container->get('view');
			$mailer = new \Semhoun\Mailer\Mailer($view, [
                'host'      => '',  // SMTP Host
                'port'      => '',  // SMTP Port
                'username'  => '',  // SMTP Username
                'password'  => '',  // SMTP Password
                'protocol'  => ''   // SSL or TLS
            ]);
        
    		// Set the details of the default sender
    		$mailer->setDefaultFrom('no-reply@mail.com', 'Webmaster');
    
    		return $mailer;
    }
};
   
$app->run();
```

### Supported Options

| Option | Type | Description |
| --- | --- | --- |
| host | string | The host to connect to. |
| port | integer | The port to connect to. |
| username | string | The username to authenticate with. |
| password | string | The password to authenticate with. |
| protocol | string | The encryption method, either SSL or TLS. |

### Sending the Email (Basic Example)

```php
$app->get('/email', function (Request $request, Response $response, $args)  use($app) {
	$user = new stdClass;
    $user->name = 'Paul Muaddib';
    $user->email = 'paul.muaddib@mail.com';
    
    $container = $app->getContainer();
    $container->get('mailer')->sendMessage('emails/welcome.html.twig', ['user' => $user], function($message) use($user) {
        $message->setTo($user->email, $user->name);
        $message->setSubject('Welcome to the Team!');
    });
    
    $response->getBody()->write('Mail sent!');
    
    return $response;
});
```
**welcome.html.twig**

```html
<h1>Hello {{ user.name }}</h1>
    
<p>Welcome to the Team!</p>
    
<p>Love, Admin</p>
```

### Sending with a Mailable

Using mailable classes are a lot more elegant than the basic usage example above. Building 
up the mail in a mailable class cleans up controllers and routes, making things look 
a more tidy and less cluttered as well as making things so much more manageable.

Mailable classes are required to extend the base Semhoun\Mailer\Mailable` class;

```php
use Semhoun\Mailer\Mailable;

class WelcomeMailable extends Mailable
{
    
    protected $user;
    
    public function __construct($user)
    {
        $this->user = $user;
    }
    
    public function build()
    {
        $this->setSubject('Welcome to the Team!');
        $this->setView('emails/welcome.html.twig', [
            'user' => $this->user
        ]);
        
        return $this;
    }
    
}
```

Now in your controller or route, you set the recipients address and name, passing 
just a single argument into the `sendMessage` method - a new instance of the mailable 
class;

```php
$app->get('/email', function (Request $request, Response $response, $args)  use($app) {
	$user = new stdClass;
    $user->name = 'Paul Muaddib';
    $user->email = 'paul.muaddib@mail.com';
    
    $container = $app->getContainer();
    $container->get('mailer')->->setTo($user->email, $user->name)->sendMessage(new WelcomeMailable($user));
    
    $response->getBody()->write('Mail sent!');
    
    return $response;
});
```

### Methods

| Method | Description |
| --- | --- |
| `attachDynamic(string $data, string $filename, string $mime)` | Attach in memory data. |
| `attachFile(string $path)` | Path to a file to set as an attachment. |
| `detachFile(string $path)` | Path to a file to remove as an attachment. |
| `setBcc(string $address, string $name = '')` | Set the Bcc of the message. |
| `setBody($body)` | Set the body of the message. |
| `setCc(string $address, string $name = '')` | Set the Cc of the message |
| `setDate(DateTimeInterface $dateTime)` | Set the date at which this message was created. |
| `setFrom(string $address, string $name = '')` | Set the sender of the message. |
| `setReplyTo(string $address, string $name = '')` | Set the ReplyTo of the message. |
| `setPriority(int $priority)` | Set the priority of the message. |
| `setSubject(string $subject)` | Set the subject of the message. |
| `setTo(string $address, string $name = '')` | Set the recipent of the message. |

## Useful Links

* [Slim Framework](https://www.slimframework.com)
* [Slim Framework Twig View](https://github.com/slimphp/Twig-View)
* [Swift Mailer](https://github.com/swiftmailer/swiftmailer)
