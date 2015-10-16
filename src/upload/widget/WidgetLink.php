<?php

class WidgetLink extends TWidget {

    protected $setting = array('title' => null, 'type' => null, 'id' => null);

    public function Title() {
        if ($this->setting['title'] == null) {
            $result = _lg('link generator');
        } else {
            $result = $this->setting['title'];
        }
        return $result;
    }

    public function Content() {

        if ($this->setting['type'] == 0) {
            $prefix = 'سرفصل' ;
        } elseif ($this->setting['type'] == 1) {
            $prefix = 'برچسب' ;
        }else{
           $prefix = 'یادداشت' ; 
        }
        
        $link = UR_BASE . $prefix . '/' . $this->setting['id'] . '/' . $this->setting['title'] ;

        return '<a href="' . ($link) . '">' . $this->setting['title'] ."</a>" ;
    }
    
    public function Description() {
        return _lg('Link genarator');
    }

    public function Form() {

        if ($this->setting['title'] == null) {
            $title = _lg('Link generator');
        } else {
            $title = $this->setting['title'];
        }
        if ($this->setting['type'] == null) {
            $type  = null;
        } else {
            $type = $this->setting['type'];
        }
        if ($this->setting['id'] == null) {
            $id  = null;
        } else {
            $id = $this->setting['id'];
        }
        

//        $result = 'title:<input type="text" name="title"  value="' . $title . '" />';
//        $result .= 'type:<select>'
//                . '<option value="0" > category </option‌>'
//                . '<option value="1" > tag </option‌>'
//                . '<option value="2" > topic </option‌>'
//                . '</select>';
//        $result .= 'id:<input type="text" id="autocomp"  />';
//        $result .= '<input type="hidden" name="id"  value="' . $id . '"  />';
//        $result .= 'id:<input type="submit" value="save"  />';
        
        $form = new TForm();

        $form->AddField('select', 'title', $type, array('name' => 'type'),array(0 => array('0', 'category'), 1 => array('1', 'tag'), 2 => array('2','topic')));
        $form->AddField('text', 'title', $title, array('class' => 'autocomplete','name' => 'title'));
        $form->AddField('hidden', '', $id, array('name' => 'id','class' => 'hidden'));
        $form->AddField('submit', '', _lg('save'));
        
        return $form->FormBody();
    }


}
