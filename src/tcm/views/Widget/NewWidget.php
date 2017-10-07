<?php



    $cls =  $this->class ;
    if (!class_exists($cls, false)) {
        require './../upload/widget/' . $this->class . '.php';
    }

    $class = new $cls(WIDGET_PREPARE_MODE);

    $this->new_widget = '<li data-class="' . $cls . '" data-id="%id%">';
    $this->new_widget .= '<h3>' . $class->Title() . '</h3>';
    $this->new_widget .= '<div>';
    $this->new_widget .= '<form method="post"  class="' . $cls . ' from ajax"'
            . ' action="Widget/Update/%id%">';
    $this->new_widget .= $class->Form();
    $this->new_widget .= '</form>';
    $this->new_widget .= '</div>';
    $this->new_widget .= '</li>';
