<?php
// Routes
$app->get('/', App\Action\HomeAction::class . ':getData')
->setName('homepage');

$app->get('/about-us', App\Action\AboutAction::class . ':getData')
->setName('about');

$app->get('/kickboxing', App\Action\KickboxingAction::class . ':getData')
->setName('kickboxing');

$app->get('/taekwondo', App\Action\TaekwondoAction::class . ':getData')
->setName('taekwondo');

$app->get('/associations', App\Action\AssociationAction::class . ':getData')
->setName('associations');

$app->get('/photos', App\Action\PhotoAction::class . ':getData')
->setName('photos');

$app->get('/sitemap', App\Action\SiteMapAction::class . ':get')
->setName('sitemap');

$app->get('/blog', App\Action\PostsAction::class)
->setName('blog');

$app->get('/post{id}', App\Action\PostAction::class)
->setName('post');
