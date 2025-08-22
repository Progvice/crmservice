<?php

use Core\App\Response;
use Core\App\Template;

class templateController extends Controller
{
    public function template()
    {

        Plugin::load('response, templateloader');

        $response = new Response;
        $template = new Template;

        $data = json_decode(file_get_contents('php://input'), true);

        $templateName = $this->params[0];

        if (!$template->templateExists($templateName)) {
            $templateNotFound = $template->load(['name' => 'TemplateNotFound', 'data' => $templateName]);
            $response->Html($templateNotFound);
            return;
        }
    }
}
