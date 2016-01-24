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
    // Default template
    private $template = 'default';

    // Master array, contains everything
    private $_ = array();

    /**
     * Assigns a variable to a key
     *
     * @param String $key Key
     * @param String $value Variable
     */
    public function assign($key, $value) {
        $this->_[$key] = $value;
    }

    /**
     * Sets the name of the template
     *
     * @param String $template Name of the template
     */
    public function setTemplate($template = 'default') {
        $this->template = $template;
    }

    /**
     * Loads the template and puts it out
     *
     * @return String Output of the template
     */
    public function loadTemplate() {
        $tpl = $this->template;

        // Creates template path and checks if it exists
        $file = $this->path . DIRECTORY_SEPARATOR . $tpl . '.php';
        $exists = file_exists($file);

        if ($exists) {
            // Output gets saved in a buffer
            ob_start();

            // Template file gets put into buffer and saved in $output
            include $file;
            $output = ob_get_contents();
            ob_end_clean();

            // Return output
            return $output;
        } else {
            // Template file doesn't exist
            return 'Could not find template.';
        }
    }

}