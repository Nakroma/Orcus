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
    private $view = null;

    /**
     * Konstruktor
     */
    public function __construct($request) {
        $this->view = new View();
        $this->request = $request;
        $this->template = !empty($request['view']) ? $request['view'] : 'default';
    }

    /**
     * Zum anzeigen des Contents
     */
    public function display() {
        $innerView = new View();
        switch($this->template) {
            case 'entry':
                $innerView->setTemplate('entry');
                $entryid = $this->request['id'];
                $entry = Model::getEntry($entryid);
                $innerView->assign('title', $entry['title']);
                $innerView->assign('content', $entry['content']);
                break;

            case 'default':
            default:
                $entries = Model::getEntries();
                $innerView->setTemplate('default');
                $innerView->assign('entries', $entries);
        }
        $this->view->setTemplate('theblog');
        $this->view->assign('blog_title', 'Der Titel des Blogs');
        $this->view->assign('blog_footer', 'Ein Blog von und mit MVC');
        $this->view->assign('blog_content', $innerView->loadTemplate());
        return $this->view->loadTemplate();
    }

} 