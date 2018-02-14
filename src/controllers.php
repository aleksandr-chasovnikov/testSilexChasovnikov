<?php

use Models\Tag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//Request::setTrustedProxies(array('127.0.0.1'));

// На главную страницу
$app->get('/', function() use ($app) {

    return $app['twig']->render('index.php.twig', [
            'tags' => Tag::all(),
        ]
    );
})->bind('homepage');

// Маршрут из формы
$app->post('/feedback', function(Request $request) use ($app) {

    $search = $request->get('search');
    $productsSearch = []; // Должны входить в искомый набор

    if (is_array($search)) {
        foreach ($search as $tagId) {
            $tag = Tag::find($tagId);

            foreach ($tag->items as $item) {
                $item->show_count += 1;
                $item->save();

                $productsSearch[$item->id] = $item->name;
            }
        }
    }

    $nosearch = $request->get('nosearch');
    $productsNoSearch = []; // Не должны входить в искомый набор

    if (is_array($nosearch)) {
        foreach ($nosearch as $tagId) {
            $tag = Tag::find($tagId);

            foreach ($tag->items as $item) {
                $item->show_count += 1;
                $item->save();

                $productsNoSearch[$item->id] = ($item->name);
            }
        }
    }

    $result = null;

    if ($productsSearch != $productsNoSearch) {
        $result = array_diff($productsSearch, $productsNoSearch);
    }

    if (!is_array($result)) {
        return new Response('Не правильно введены данные.', 400);
    }

    // Форматирование данных для CSV-файла
    array_walk($result, function (&$item, $key) {
        $item = "$key;$item";
    });

    $fp = fopen('file.csv', 'w');
    fputcsv($fp, $result, ';');
    fclose($fp);

    return $app->sendFile('file.csv');

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
