<?php
/**
 * Created by PhpStorm.
 * User: Nakroma
 * Date: 26.02.2016
 * Time: 21:51
 */

class ControllerGames {

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
        $prefix = ModelGames::getTemplateFolder();

        // Load template settings
        switch($this->template) {
            /**
             * PAGES
             */

            // Page: Games Lobby
            case 'games_lobby':
                $view->setTemplate($prefix . 'games_lobby');
                $view->assign('templateSidebar', ModelGames::getTemplateSidebar());
                $view->assign('skey', Model::getSessionKey());
                $view->assign('game', $this->request['game']);
                break;

            // Page: Games List
            case 'games_list':
            default:
                $view->setTemplate($prefix . 'games_list');
                $view->assign('templateSidebar', ModelGames::getTemplateSidebar());
                break;
        }

        // Load global variables
        $view->assign('path', Model::getPaths());

        // Load Template
        return $view->loadTemplate();
    }

}