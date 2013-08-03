<?php

/**
 * A simple templating(tpl) system for pico that allows you to include dynamic page / section html templates in your pico theme(s)
 * @package Pico
 * @subpackage Pico Tpl
 * @since BJ 1.0 TODO
 * @author Shawn Sandy <shawnsandy04@gmail.com>
 */

class Pico_Tpl {

    private $tpl_name,
            $theme = 'default',
            $tpl_array = array('header','content','footer','cover','sidebar');

    public function __construct() {

    }

    public function before_load_content(&$file) {

        // var_dump($file);

        $this->tpl_name = basename($file, '.md');

        //$filepath = dirname($file);
    }

    public function config_loaded(&$settings) {

        if(isset($settings['tpl_array']))
            $this->tpl_array = $settings['tpl_array'];

        if(isset($settings['theme']))
            $this->theme =  $settings['theme'];

    }


    public function file_meta(&$meta) {

        $config = $meta;
        if(isset($config['slug']))
            $this->tpl_name = strtolower ($config['tpl']);

    }

    public function before_render(&$twig_vars, &$twig) {

        foreach ($this->tpl_array as $value) {
            $tpl[$value] = 'tpl/'.$value.'.html';
            if(file_exists(THEMES_DIR.$this->theme.'/tpl/'.$this->tpl_name.'-'.$value.'.html'))
            $tpl[$value] = 'tpl/'.$this->tpl_name.'-'.$value.'.html';
        }
       // var_dump($page_tpl);
       $twig_vars['tpl'] = $tpl ;

    }

}

?>
