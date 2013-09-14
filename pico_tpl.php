<?php

/**
 * A simple dynamic content system for pico template that allows you to include html /.md files specfically created for use in theme in your pico theme(s)
 * @package Pico TPL content
 * @subpackage Pico Tpl
 * @since BJ 1.0 TODO
 * @author Shawn Sandy <shawnsandy04@gmail.com>
 */

class Pico_Tpl {

    private $tpl_name,
            $theme = 'default',
            $tpl_array = array('header', 'content', 'footer', 'cover', 'sidebar');

    public function __construct() {

    }

    public function before_load_content(&$file) {

        // var_dump($file);
        $this->tpl_name = basename($file, '.md');
    }

    public function config_loaded(&$settings) {

        if (isset($settings['tpl_array']))
            $this->tpl_array = $settings['tpl_array'];

        if (isset($settings['theme']))
            $this->theme = THEMES_DIR . $settings['theme'];
    }

    public function file_meta(&$meta) {

        $config = $meta;
        if (isset($config['slug'])):
            $this->tpl_name = strtolower($config['slug']);
        endif;

        //var_dump($this->tpl_name);
    }

    public function before_render(&$twig_vars, &$twig) {



        // theme/tpl/file
        $twig_vars['tpl'] = $this->get_tpl();

        // theme/tpl/views/file
        $views = $this->get_views();
        $twig_vars['views'] = $views;

        // theme/content/file
        $theme = $this->get_theme_content();
        $twig_vars['theme'] = $theme;
        //var_dump($twig_vars['theme']);


    }

    private function get_tpl() {

        foreach ($this->tpl_array as $value) {
            $tpl[$value] = 'tpl/' . $value . '.html';
            $page_tpl = $this->theme . '/tpl/' . $this->tpl_name . '-' . $value . '.html';
            if (file_exists($page_tpl))
                $tpl[$value] = '/tpl/' . $this->tpl_name . '-' . $value . '.html';
            //var_dump($page_tpl);
        }

        //var_dump($tpl);
        return $tpl;
    }

    private  function get_theme_content(){
        $content = $this->get_files($this->theme.'/content', '.md');
        $content_data = array();
        if(empty($content))
            return;
        foreach ($content as $key) {
            $file = $this->theme.'/content/'.$key.'.md';
            $pattern = array('/ /','/-/');
            $title = preg_replace($pattern, '_', strtolower($key));
            $data = file_get_contents($file);
            $content_data[$title] = \Michelf\MarkdownExtra::defaultTransform($data);

        }
         return $content_data;
    }

    private function get_views() {

        $view_dir = $this->theme . '/tpl/views';
        $views = $this->get_files($view_dir);
        if (empty($views))
            return;
        foreach ($views as $key) {
            $view[$key] = 'tpl/views/' . $key . '.html';
            if (file_exists($this->theme . '/tpl/' . $this->tpl_name . '-' . $key . '.html'))
                $view['key'] = 'tpl/views/' . $this->tpl_name . '-' . $key . '.html';
        }
        //var_dump($views);
        if (!isset($view))
            return array(0);

        return $view;
    }

    // pico.php lib
    private function get_files($directory, $ext = '.html') {
        if (!is_dir($directory))
            return false;

        $array_items = array();
        if ($handle = opendir($directory)) {
            while (false !== ($file = readdir($handle))) {

                $file = $directory . "/" . $file;
                if (!$ext || strstr($file, $ext))
                //$array_items[] = preg_replace("/\/\//si", "/", $file);
                    $array_items[] = basename($file, $ext);
            }
            closedir($handle);
        }
        return $array_items;
    }

}

?>
