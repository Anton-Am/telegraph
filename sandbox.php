<?php

use AntonAm\Telegraph\Manager;
use AntonAm\Telegraph\Exceptions\NodeException;
use AntonAm\Telegraph\Exceptions\PageException;
use AntonAm\Telegraph\Exceptions\TelegraphRequestException;

require_once("vendor/autoload.php");

echo '<pre>';
try {
    //Create account
    //$telegraph = new Manager();
    //$newAccount = $telegraph->account()->create('MyToken', 'MyLongName', 'https://telegra.ph/');
    //var_dump($newAccount);

    //Account actions
    //$telegraph = new Manager('YourToken');
    //var_dump($telegraph->account()->get());
    //var_dump($telegraph->account()->edit('Fusce', 'Aliquam', 'https://www.user.url/'));
    //var_dump($telegraph->account()->revoke());
    //var_dump($telegraph->account()->pages());

    //Create new account and page
    /*$telegraph = new Manager();
    $page = $telegraph->page()->setTitle('Sed')
        ->addLink('Telegraph', 'https://telegra.ph')
        ->create();
    var_dump($page);*/

    /*$telegraph = new Manager('b7316e15f67fe9a397ea8b151d5e15a75a9702e2472775fc3ab0e418467d');
    $page = $telegraph->page('Test-08-26-233')
        ->setAuthor('User Name', 'https://www.google.com/')
        ->setTitle('Nunc egestas augue')
        ->addText('Nunc sed turpis. Praesent blandit laoreet nibh. Sed aliquam ultrices mauris. Vivamus euismod mauris.
    
    Nam at tortor in tellus interdum sagittis. Quisque id odio. Suspendisse non nisl sit amet velit hendrerit rutrum. Curabitur ullamcorper ultricies nisi.
    
    Quisque rutrum. Praesent nonummy mi in odio. Maecenas malesuada. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi.
    
    Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Fusce convallis metus id felis luctus adipiscing.
    
    Proin magna. Aliquam lobortis. Pellentesque libero tortor, tincidunt et, tincidunt eget, semper nec, quam. Pellentesque dapibus hendrerit tortor.')
        ->addLink('Telegraph', 'https://telegra.ph')
        ->addImage('http://telegra.ph/file/6a5b15e7eb4d7329ca7af.jpg')
        ->addHtml('b', 'Bold text')
        ->edit();
    var_dump($page);*/

    //Other methods
    //$telegraph = new Manager('b7316e15f67fe9a397ea8b151d5e15a75a9702e2472775fc3ab0e418467d');
    //var_dump($telegraph->page('Test-08-26-233')->statistic());
    //var_dump($telegraph->page('Test-08-26-233')->get());
} catch (NodeException $e) {
    //Custom tag problem
    echo '<h1>Node problem:</h1><br>';
    echo '<hr>';
    echo $e->getMessage();
    print_r($e->getTrace());
} catch (PageException $e) {
    //Page command problem
    echo '<h1>Page problem:</h1>';
    echo '<hr>';
    echo $e->getMessage();
    print_r($e->getTrace());
} catch (TelegraphRequestException $e) {
    //Telegraph exception problem
    echo '<h1>Telegraph request problem:</h1>';
    echo '<hr>';
    echo $e->getMessage();
    print_r($e->getTrace());
} catch (Exception $e) {
    //Common problem catcher: guzzle, json decode or something else
    echo '<h1>Common problem:</h1>';
    echo '<hr>';
    echo $e->getMessage();
    print_r($e->getTrace());
}
echo '</pre>';
