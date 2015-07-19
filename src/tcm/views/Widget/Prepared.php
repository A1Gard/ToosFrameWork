<?php

$this->widget_prepared = '<ul class="accordion" id="prepared"> ';
$this->widget_prepared .= '<li class="placeholder">' .
        _lg('prepare your widgets here') . '</li>';
foreach ($this->prepared as $record) {
    $cls = $record['widget_class'];
    if (!class_exists($cls, false)) {
        require './../upload/widget/' . $record['widget_class'] . '.php';
    }

    $class = new $cls(WIDGET_PREPARE_MODE);
    $setting = unserialize($record['widget_setting']);
    $class->LoadSetting($setting);
    $this->widget_prepared .= '<li data-trash="prepared" data-class="' . $cls . '" data-id="'. 
            $record['widget_id']  .'">';
    $this->widget_prepared .= '<h3>' . $class->Title() . '</h3>';
    $this->widget_prepared .= '<div>';
    $this->widget_prepared .= '<form method="post" class="' . $cls . ' from ajax"'
            . ' action="' . UR_MP .'Widget/Update/' . $record['widget_id'] . '">';
    $this->widget_prepared .= $class->Detail();
    $this->widget_prepared .= '</form>';
    $this->widget_prepared .= '</div>';
    $this->widget_prepared .= '</li>';
}
$this->widget_prepared .= '</ul>';
