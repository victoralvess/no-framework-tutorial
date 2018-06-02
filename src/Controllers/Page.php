<?php

declare(strict_types = 1);

namespace Example\Controllers;

use Http\Response;
use Example\Template\FrontendRenderer;
use Example\Page\PageReader;
use Example\Page\InvalidPageException;

class Page
{
    private $response;
    private $renderer;
    private $pageReader;

    public function __construct(
        Response $response,
        FrontendRenderer $renderer,
        PageReader $pageReader
    ) {
        $this->response = $response;
        $this->renderer = $renderer;
        $this->pageReader = $pageReader;
    } 

    public function show($params): void
    {
      $slug = $params['slug'];
      try {
          $data['content'] = $this->pageReader->readBySlug($slug);
      } catch (InvalidPageException $e) {
          $this->response->setStatusCode(404);
          $this->response->setContent('404 - Page not found');

          return;
      }

        $html = $this->renderer->render('Page', $data);
        $this->response->setContent($html);
    }
}

