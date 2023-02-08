# PHP Telegraph Library

A simple php library for integration with [telegra.ph](https://telegra.ph/)

[![Latest Stable Version](https://poser.pugx.org/anton-am/telegraph/v/stable)](https://packagist.org/packages/anton-am/telegraph)
[![Total Downloads](https://poser.pugx.org/anton-am/telegraph/downloads)](https://packagist.org/packages/anton-am/telegraph)

## Contents

- [Installation](#installation)
- [Usage](#usage)
- [Credits](#credits)
- [License](#license)

## Installation

### Raw composer install

```bash
composer require anton-am/telegraph
```
### composer.json
```bash
"anton-am/telegraph": "^1"
```


### Connecting
```php
//COMPOSER:
require_once("vendor/autoload.php");
```

## Usage

### Creating new account with random login
```php
$telegraph = new \AntonAm\Telegraph\Manager();
$newAccount = $telegraph->account()->create();

/** 
 AntonAm\Telegraph\Entities\Account Object
(
    [short_name] => u6127bedb238ee
    [author_name] => 
    [author_url] => 
    [access_token] => 6dce6d496dbdd6770c28e44b25539d48df0cc08d191f7b499b88ef0872ed
    [auth_url] => https://edit.telegra.ph/auth/5ckd5ECGzB0KpCpu9I8H0fyJ4f1SrZyw9RJetjT1UR
    [page_count] => 
) 
 */

```
All available options:
###### create(YOUR_USER_TOKEN, YOUR_USER_NAME, YOUR_USER_PUBLIC_URL);

&nbsp;

### Other account methods
```php
$telegraph = new \AntonAm\Telegraph\Manager('ACCESS_TOKEN_FROM_CREATE');

//Get user information
$account = $telegraph->account()->get();

//Edit user information
$account = $telegraph->account()->edit('NewShortName', 'NewPublicName', 'https://new.url');

//Revoke/reload user access token
$account = $telegraph->account()->revoke();

//List of user pages
$account = $telegraph->account()->pages();

```

&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;


### Creating new page without author
```php
//Create new account and page
$telegraph = new \AntonAm\Telegraph\Manager();
$page = $telegraph->page()->setTitle('Sed')
    ->addText('Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.')
    ->create();
```

### Edit page
```php
$telegraph = new \AntonAm\Telegraph\Manager('b7316e15f67fe9a397ea8b151d5e15a75a9702e2472775fc3ab0e418467d');
$page = $telegraph->page('Test-08-26-233')
    ->setAuthor('User Name', 'https://www.google.com/')
    ->setTitle('Nunc egestas augue')
    ->addText('Nunc sed turpis. Praesent blandit laoreet nibh.

Nam at tortor in tellus interdum sagittis. Quisque id odio.

Aliquam lobortis. Pellentesque libero tortor, tincidunt et, tincidunt eget, semper nec, quam.')
    ->addLink('Telegraph', 'https://telegra.ph')
    ->addImage('http://telegra.ph/file/6a5b15e7eb4d7329ca7af.jpg')
    ->addHtml('hr')
    ->addHtml('h3', 'Header')
    ->edit();
```
All available methods:
###### setAuthor(); //Autofill of name and url from account (if exist)
###### setAuthor(USER_NAME, USER_URL);
###### addText(YOUR_TEXT);
###### addImage(IMAGE_URL);
###### addLink(URL_NAME, URL_HREF);
###### addHtml(TAG, TEXT, ATTRIBUTES)


### Other account methods
```php
$telegraph = new \AntonAm\Telegraph\Manager('b7316e15f67fe9a397ea8b151d5e15a75a9702e2472775fc3ab0e418467d');

//Page views statistic
$page = $telegraph->page('Test-08-26-233')->statistic();

//Page data
$page = $telegraph->page('Test-08-26-233')->get();
```
All available methods:
###### statistic(?YEAR, ?MONTH, ?DAY, ?HOUR);

&nbsp;
&nbsp;

### Handling Errors

```php
try {
    $telegraph = new \AntonAm\Telegraph\Manager();
    $newAccount = $telegraph->page()->setTitle('New page')->create('/new');
} catch (\AntonAm\Telegraph\Exceptions\NodeException $e) {
    //Custom tag problem
} catch (\AntonAm\Telegraph\Exceptions\PageException $e) {
    //Page command problem
} catch (\AntonAm\Telegraph\Exceptions\TelegraphRequestException $e){
    //Telegraph exception problem
} catch (\Exception $e) {
    //Common problem catcher: guzzle, json decode or something else
}
```

## Credits

- [Anton Am](https://github.com/Anton-Am)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.