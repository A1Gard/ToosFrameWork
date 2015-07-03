<?php

$all_file = scandir('./../upload/widget');

$this->widget_template = '<ul class="accordion" id="template"> ';
foreach ($all_file as $file) {
    if (preg_match('/.php$/', $file)) {
        require './../upload/widget/' . $file;
        $cls = substr($file, 0, -4);
        $class = new $cls(WIDGET_TEMPLATE_MODE);
        $this->widget_template .= '<li data-class="' . $cls . '">';
        $this->widget_template .= '<h3>' . $class->Title() . '</h3>';
        $this->widget_template .= '<div>';
        $this->widget_template .= $class->Detail();
        $this->widget_template .= '</div>';
        $this->widget_template .= '</li>';
    }
}
$this->widget_template .= '</ul>';

