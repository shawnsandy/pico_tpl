<?php

/**
 * A simple templating system for pico that allows you to include html templates in your pico theme(s)
 * @package Pico
 * @subpackage Pico Tpl
 * @since BJ 1.0 TODO
 * @author Shawn Sandy <shawnsandy04@gmail.com>
 */

class Pico_Tpl {

    private $tpl_name,
            $theme = 'default',
            $tpl_array = array('header','footer','cover','sidebar');

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

    public function before_render(&$twig_vars, &$twig) {

        foreach ($this->tpl_array as $value) {
            $tpl[$value] = 'tpl/tpl-'.$value.'.html';
            if(file_exists(THEMES_DIR.$this->theme.'/tpl/tpl-'.$this->tpl_name.'-'.$value.'.html'))
            $tpl[$value] = 'tpl/tpl-'.$this->tpl_name.'-'.$value.'.html';
        }
       // var_dump($page_tpl);
       $twig_vars['tpl'] = $tpl ;
    }

}

?>
