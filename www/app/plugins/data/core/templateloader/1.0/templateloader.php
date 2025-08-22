<?php

namespace Core\App;

class Template
{
    /*
     *  @method LoadData
     * 
     *  @param1 $uri    string
     *  @param2 $template_name  string
     * 
     *  Purpose of this function is to load data for URI. Data is stored 
     *  in its own JSON file. This data gets processed through this function
     *  so that we can inject it to template
     * 
     * 
     */

    public $blocks;
    public static $styles = '';
    public static $scripts = <<<EOS
    
    EOS;

    public static $collectedScripts = [];
    public static $collectedStyles = [];

    /*
     *  @method Load
     *
     *  @param  $template   array   -   Template data
     *          
     *          @Array keys
     *              
     *              *** = Required
     *              
     *              name    -   Template name - String ***
     *              data    -   Store data in to this variable from database or from controller and send it to template. - Mixed (array||string)
     *          
     *              
     *  
     */
    public function load($template)
    {

        $name = $template['name'];

        if (!$this->templateExists($name)) {
            echo 'Template does not exist!';
            return;
        }

        if (!class_exists($name)) {
            require VIEW_PATH . '/../templates/' . $name . '/' . 'index.php';
        }
        $class = new $name;
        $final_template = $class->load(isset($template['data']) ? $template['data'] : []);
        return $final_template;
    }

    public function templateExists($templateName)
    {
        return file_exists(VIEW_PATH . '/../templates/' . $templateName . '/' . 'index.php');
    }

    public function getBlock($blockName)
    {
        if (isset($this->blocks[$blockName])) return $this->blocks[$blockName];
        return $blockName . ' is not defined';
    }

    public function collectStyle($dir)
    {
        if (in_array($dir, self::$collectedStyles)) return;
        if (!file_exists($dir . '/style.css')) return;
        $styles = file_get_contents($dir . '/style.css');
        self::$styles = self::$styles . "\n\n" . $styles;
        array_push(self::$collectedStyles, $dir);
    }

    public function collectScript($dir)
    {
        if (in_array($dir, self::$collectedScripts)) return;
        if (!file_exists($dir . '/script.js')) return;
        $scripts = file_get_contents($dir . '/script.js');
        self::$scripts = self::$scripts . "\n\n" . $scripts;
        array_push(self::$collectedScripts, $dir);
    }
}
