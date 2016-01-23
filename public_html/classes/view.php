<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 23.01.2016
 * Time: 15:10
 */

class View {

    // Path to template
    private $path = 'templates';
    // Default tempalte
    private $template = 'default';

    // Master array, contains everything
    private $_ = array();

    /**
     * Ordnet eine Variable einen bestimmten Schlüssel zu
     */
    public function assign($key, $value) {
        $this->_[$key] = $value;
    }

    /**
     * Setzt den Namen des Templates
     */
    public function setTemplate($template = 'default') {
        $this->template = $template;
    }

    /**
     * Laden des Template File und zurückgeben
     */
    public function loadTemplate() {
        $tpl = $this->template;

        // Pfad zum Template erstellen und überprüfen ob es existiert
        $file = $this->path . DIRECTORY_SEPARATOR . $tpl . '.php';
        $exists = file_exists($file);

        if ($exists) {
            // Output wird im Buffer gespeichert, dh nicht gleich ausgegeben
            ob_start();

            // Template wird eingebunden und in $output gespeichert
            include $file;
            $output = ob_get_contents();
            ob_end_clean();

            // Return output
            return $output;
        } else {
            // Error
            return 'Could not find template.';
        }
    }

}