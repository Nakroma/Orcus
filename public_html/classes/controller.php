<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 23.01.2016
 * Time: 15:06
 * Desc: Class to control View/Model
 */

class Controller {

    private $request = null;
    private $template = '';

    /**
     * Constructor
     *
     * @param Array $request Array from $_GET and $_POST
     */
    public function __construct($request) {
        $this->request = $request;
        $this->template = !empty($request['view']) ? $request['view'] : 'default';
    }

    /**
     * Displays content
     *
     * @return String Content to display
     */
    public function display() {
        // Create new View
        $view = new View();

        // Load template settings
        switch($this->template) {
            /**
             * SCRIPTS
             */

            // Script: Registration
            case 'scr_registration':
                $view->setTemplate('scripts/registration');
                $data = array(
                    "email" => $this->request['email'],
                    "password" => Model::hashValue($this->request['password'])
                );
                $view->assign('data', $data);
                $view->assign('db', Model::getDatabase());
                break;

            // Script: Login
            case 'scr_login':
                $view->setTemplate('scripts/login');
                $data = array(
                    "email" => $this->request['email'],
                    "password" => $this->request['password']
                );
                $view->assign('data', $data);
                $view->assign('db', Model::getDatabase());
                $view->assign('skey', Model::getSessionKey());
                break;


            /**
             * PAGES
             */

            // Page: Control Panel
            case 'controlpanel':
                $view->setTemplate('controlpanel');
                $view->assign('skey', Model::getSessionKey());
                break;

            // Page: Games List
            case 'games_list':
                $view->setTemplate('games_list');
                break;

            // Page: Error Page
            case 'error':
                $view->setTemplate('error');
                $view->assign('type', $this->request['type']);
                $view->assign('detail', urldecode($this->request['detail']));
                break;

            // Page: Landing Page
            case 'default':
            default:
                $view->setTemplate('default');
                break;
        }

        // Load global variables
        $view->assign('path', Model::getPaths());

        // Load Template
        return $view->loadTemplate();
    }

} 