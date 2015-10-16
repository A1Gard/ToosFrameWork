<?php

class WidgetText extends TWidget {

    protected $setting = array('title' => null, 'content' => null);


    public function Title() {
        if ($this->setting['title'] == null) {
            $result = _lg('Simple Text widget title');
        } else {
            $result = $this->setting['title'];
        }
        return $result;
    }

    public function Content() {

        if ($this->setting['content'] == null) {
            $result = _lg('Simple Text widget content');
        } else {
            $result = $this->setting['content'];
        }
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
        if ($this->setting['content'] == null) {
            $content = _lg('Simple Text widget content');
        } else {
            $content = $this->setting['content'];
        }
        $form->AddField('textarea', _lg('content'), $content, array('name' => 'content'));
        $form->AddField('submit', '', _lg('send'));

        $result = $form->FormBody();
        return $result;
    }

}
