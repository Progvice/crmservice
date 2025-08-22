<?php

use Core\App\Template;

class TemplateNotFound extends Template
{
    public function load($values)
    {
        $this->collectStyle(__DIR__);
        $this->collectScript(__DIR__);

        $templateName = $values;

        return <<<EOT
            <h1>Template {$templateName} not found</h1>
        EOT;
    }
}
