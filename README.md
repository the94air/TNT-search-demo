## TNT-search-demo

A simple demo for TNTSearch full text search engine.

* * *

###usage

1.  update the `composer.phar` file to install TNTSearch dependence
    `composer update`
2.  Import database structure to you database in `search.sql` file
3.  add your database Configuration `start.php` file
```php
$tnt->loadConfig([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'search',
    'username'  => 'username',
    'password'  => 'password',
    'storage'   => 'C:/xampp/htdocs/tntsearch', // Folder to save indexes into.
	'charset' => 'utf8',
	'collation' => 'utf8_general_ci'
]);
```
4.  To create new index add this code after the `$tnt->loadConfig` in the `start.php` file. And then reload the page in your browser.
```php
$indexer = $tnt->createIndex('articles.index');
$indexer->query('SELECT id, title, article, slug FROM articles;');
//$indexer->setLanguage('german'); // Select language OR No  language $indexer->setLanguage('no');
$indexer->run();
exit();
//you should use this code only once for creating the index file. After that you should delete the code
```
###you will find the rest of documentation in [TNTSearch Readme.md](https://github.com/teamtnt/tntsearch#installation)
