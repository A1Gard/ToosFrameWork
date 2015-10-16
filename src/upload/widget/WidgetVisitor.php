<?php

class WidgetVisitor extends TWidget {

    protected $setting = array('title' => null);
 

    public function Title() {
        if ($this->setting['title'] == null) {
            $result = _lg('visitor widget title');
        } else {
            $result = $this->setting['title'];
        }
        return $result;
    }

    public function Content() {

        echo TVisitor::DetectBrowser();
        echo '<br />';
        echo TVisitor::DetectOS();
        return $result;
    }

    public function Form() {
        $form = new TForm();
        if ($this->setting['title'] == null) {
            $title = _lg('Simple Text widget title');
        } else {
            $title = $this->setting['title'];
        }
        $form->AddField('text', _lg('title'), $title, array('name' => 'title'));
        $form->AddField('submit', '', _lg('send'));

        $result = $form->FormBody();
        return $result;
    }

}
