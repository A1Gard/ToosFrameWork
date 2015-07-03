<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 21-April-2014 (1-2-1393) 
 * @time : 11:46 
 * @subpackage   TForm
 * @version 1.0
 * @todo : Create and form input
 */
class TForm {

    // private vars
    private $field = null; // for add fields
    private $property = null; // form property

    // create form

    function __construct($action = '', $method = 'post', $attr = array()) {
        
        // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $action, $method, $attr);
        
        
        $this->property = ' action="' . $action . '" method="' . $method . '" '
                . (($method == 'post')?' enctype="multipart/form-data" ':'') .
                $this->_makeAttr($attr);
    }

    /**
     * Add Field
     * @param string $type type of field
     * @param string $label filed label
     * @param string $value  value if set
     * @param mixed $attr array of field attribs 
     * @param mixed $other other passed value same as select option
     * @todo add field to form 
     */
    public function AddField($type, $label, $value = '', $attr = array(), $other = null) {

        // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $type, $label, $value ,$attr ,$other );
        

        // add to field by field type
        switch ($type) {

            // adding textrea only
            case 'textarea':
                $this->_addTextarea($label, $attr, $value);
                break;

            // adding select or lisbox
            case 'select':
            case 'list':
                $this->_addSelect($type, $label, $attr, $other, $value);
                break;

            // add all input type same as :
            //"Text", "Password", "Email", "URL", "Radio", "Checkbox", "Button",
            //"Range", "File", "Color", "Hidden", "Submit", "Reset", "Image" or etc
            default:
                $this->_addInput($type, $label, $attr, $value, $other);
                break;
        }
    }

    /**
     * add select to field
     * @param string $type select's type
     * @param string $label select's label
     * @param string $attr selcet's attributes
     * @param mixed $items array of options value
     * @param string $value default value
     */
    private function _addSelect($type, $label, $attr, $items, $value = null) {

        $select = '<select' . $this->_makeAttr($attr) .
                ($type == 'list' ? 'multiple="multiple" ' : '' ) . '>';


        // if have not defualt value
        if ($value == null) {

            foreach ($items as $data) {
                $select .= '<option value="' . $data[0] . '" >' . $data[1] . '</option>' . PHP_EOL;
            }
        } else {  // have default value
            foreach ($items as $data) {

                // if equal default value
                if ($data[0] == $value) {
                    $select .= '<option selected="" value="' . $data[0] . '" >' . $data[1] . '</option>' . PHP_EOL;
                } else {
                    $select .= '<option value="' . $data[0] . '" >' . $data[1] . '</option>' . PHP_EOL;
                }
            }
        }

        $select .= '</select>';
        
        // add label 
        $select = $this->_addLabel($label, $select);

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $select);
        
        // append to form field
        $this->field .= $select;
    }

    /**
     * add textarea to form
     * @param string $label textarea label
     * @param mixed $attr textarea's attributes
     * @param string $value textarea's value
     */
    private function _addTextarea($label, $attr, $value) {

        $textarea = '<textarea placeholder="' . $label . '" ' .
                $this->_makeAttr($attr) . ' >' . $value . '</textarea>';

        // add label 
        $textarea = $this->_addLabel($label, $textarea);

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $textarea);
        
        // append to form field
        $this->field .= $textarea;
    }

    /**
     * add input filed to form
     * @param string $type type of input
     * @param string $label input's label
     * @param mixed $attr input's attribute's
     * @param string $value input's value 
     * @param mixed $other for radio items 
     */
    private function _addInput($type, $label, $attr, $value, $other = null) {

        $input = '';
        if ($type == "radio") {
            foreach ($other as $data) {
                $input .= '<label><input type="radio" ' .
                        $this->_makeAttr($attr) . " value=" . $data[0] .
                        ($value == $data[0] ? ' checked="" ' : '') . ' />' .
                        $data[1] . '</label>';
            }
            // checkbox event   
        } elseif ($type == 'checkbox') {
            // normal input genarate
            $input = '<input type="checkbox" ' . $this->_makeAttr($attr) .
                    ' value="' . $value . '"' .
                    ( (isset($other['checked']) && $other['checked'] == 1 ) ?
                            ' checked="" ' : '') . '/>';
        } else { // normal input genarate
            $input = '<input placeholder="' . $label . '" type="' . $type .
                    '" ' . $this->_makeAttr($attr) . " " .
                    ($value == 'null' ? '' : 'value="' . $value . '"') . '/>';
        }

        // add label with type
        $input = $this->_addLabel($label, $input, $type);

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $input);
        
        // append to form field
        $this->field .= $input;
    }

    /**
     * add label to element
     * @param string $label label text
     * @param string $element element body
     * @param string $type is radio for input 
     * @return string lalbled element
     */
    private function _addLabel($label, $element, $type = 'other') {

        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $label, $element, $type);
        
        // check if radio or checkbox or others
        switch ($type) {
            
            case 'other':
                $result = '<label>  <span>' . $label . ' : </span> ' . $element . ' </label>' . PHP_EOL;
                break;

            case 'checkbox':
                $result = '<label> ' . $label . $element . ' </label>' . PHP_EOL;
                break;
            case 'radio':
                $result = '<span class="label"> ' . $label . ' : ' . $element . ' </span>' . PHP_EOL;
                break;
            case 'hidden':
                $result = $element . PHP_EOL;
                break;

            default:
                $result = '<label>  <span>' . $label . ' : </span> ' . $element . ' </label>' . PHP_EOL;
                break;
        }
        
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result, $element);
        

        return $result;
    }

    /**
     * make attrib for add
     * @param mixed $attr
     * @return string  
     */
    private function _makeAttr($attr = array()) {

        $result = ' ';
        // make all attributes
        foreach ($attr as $name => $value) {
            $result .= $name . '="' . $value . '" ';
        }

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
    }

    /**
     * render form on page
     */
    public function Render() {

        $result = '<form ' . $this->property . '>' . PHP_EOL;
        $result .= $this->field;
        $result .= '</form>' . PHP_EOL;

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        
        echo $result;
    }
    
    public function FormHeader() {
        $result = '<form ' . $this->property . '>' . PHP_EOL;
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
    }
    
    public function FormBody() {
        $result = $this->field;
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
    }
    
    public function FormFooter() {
        $result = '</form>' . PHP_EOL;
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
    }
    
    

}
