<?php

use Models\Item;
use Models\Tag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function() use ($app) {

    $tags = Tag::all();
//    var_dump($items);die('hello');

    return $app['twig']->render('index.php.twig', [
            'tags' => $tags,
        ]
    );

})->bind('homepage');


$app->post('/feedback', function (Request $request) use ($app)  {

//    var_dump($request->get('search'));die;
    $products = [];
    foreach ($request->get('search') as $tagId) {
        $tag = Tag::find($tagId);

        foreach ($tag->items as $item) {
            $item->show_count += 1;

            $item->save();

            $products[]['id'] = $item->id;
            $products[]['name'] = $item->name;
        }
    }

    var_dump($products);die;

//    return $app['twig']->render('index.php.twig', [
//            'items' => $items,
//        ]
//    );

})->bind('feedback');


$app->error(function(\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/' . $code . '.html.twig',
        'errors/' . substr($code, 0, 2) . 'x.html.twig',
        'errors/' . substr($code, 0, 1) . 'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)
        ->render(array('code' => $code)), $code);
});
