<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
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


        if (isset($attr['class'])) {
            $attr['class'] .= ' ui form inverted';
        } else {
            $attr['class'] = 'ui form inverted';
        }
        $this->property = ' action="' . $action . '" method="' . $method . '" '
                . (($method == 'post') ? ' enctype="multipart/form-data" ' : '') .
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
    public function AddField($type, $label = '', $value = '', $attr = array(), $other = null) {

        // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $type, $label, $value, $attr, $other);


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

            case 'hr':
            case 'spliter':
                $this->_addSpliter($label);
                break;
            case 'startgroup':
                $this->_addStartGroup($label);
                break;
            case 'endgroup':
                $this->_addEndGrpup();
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

        if (isset($attr['class'])) {
            $attr['class'] .= ' ui dropdown';
        } else {
            $attr['class'] = 'ui dropdown';
        }


        $select = '<select' . $this->_makeAttr($attr) .
                ($type == 'list' ? 'multiple="multiple" ' : '' ) . '>';

        if (is_array($items)): // is array


            reset($items);
            // check is default format ?
            if (is_array(current($items))) {
                $select .= $this->_makeDefOptions($items, $value);
            } else {
                // or custom format
                $is_string_key = gettype(key($items)) == 'string';
                $select .= $this->_makeCustomOptions($items, $value, $is_string_key);
            }



        endif; // is array
        $select .= '</select>';

        // add label 
        $select = $this->_addLabel($label, $select);

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $select);

        // append to form field
        $this->field .= $select;
    }

    /**
     * make custom options of listbox and combobox 
     * @param mixed $items option items
     * @param var $value value for selcet default
     * @param bool $is_string_key is string key or not
     * @return string
     */
    private function _makeCustomOptions($items, $value, $is_string_key) {
        $select = null;
        if ($is_string_key == true) {
            $items = array_flip($items);
        }
        if ($value == null): // is null
            foreach ($items as $k => $v) {
                $select .= '<option value="' . $k . '" >' . _lg($v) . '</option>' . PHP_EOL;
            }
        else:
            foreach ($items as $k => $v) {

                if ($value == $k) {

                    $select .= '<option selected="" value="' . $k . '" >' . _lg($v) . '</option>' . PHP_EOL;
                    continue;
                }
                $select .= '<option value="' . $k . '" >' . _lg($v) . '</option>' . PHP_EOL;
            }

        endif; // is null

        return $select;
    }

    /**
     * make default options of listbox and combobox
     * @param mixed $items option items
     * @param var $value value for selcet default
     * @return string
     */
    private function _makeDefOptions($items, $value) {

        $select = '';
        // if have not defualt value
        if ($value == null) :

            foreach ($items as $data) {
                $select .= '<option value="' . $data[0] . '" >' .  _lg($data[1]) . '</option>' . PHP_EOL;
            }

        else:  // have default value
            foreach ($items as $data) {

                // if equal default value
                if ($data[0] == $value) {
                    $select .= '<option selected="" value="' . $data[0] . '" >' . _lg($data[1]) . '</option>' . PHP_EOL;
                    continue;
                }
                $select .= '<option value="' . $data[0] . '" >' . _lg($data[1]) . '</option>' . PHP_EOL;
            }
        endif; // if have not defualt value

        return $select;
    }

    /**
     * add textarea to form
     * @param string $label textarea label
     * @param mixed $attr textarea's attributes
     * @param string $value textarea's value
     */
    private function _addTextarea($label, $attr, $value) {

        $textarea = '<textarea placeholder="' . _lg($label) . '" ' .
                $this->_makeAttr($attr) . ' >' . $value . '</textarea>';

        // add label 
        $textarea = $this->_addLabel($label, $textarea);

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $textarea);

        // append to form field
        $this->field .= $textarea;
    }

    /**
     */

    /**
     * add spliter to form
     * @param type $text text
     */
    private function _addSpliter($text) {
        $this->field .= '<h4 class="ui dividing header inverted">' . $text . '</h4> ';
    }

    /**
     * add spliter to form
     * @param type $text text
     */
    private function _addStartGroup() {
        $this->field .= '<div class="two fields">';
    }

    /**
     * add spliter to form
     * @param type $text text
     */
    private function _addEndGrpup() {
        $this->field .= '</div>';
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
        if ($type == "radio" && is_array($other)) {
            foreach ($other as $data) {
                $input .= ' <div class="ui radio checkbox"> <input type="radio" ' .
                        $this->_makeAttr($attr) . " value=" . $data[0] .
                        ($value == $data[0] ? ' checked="" ' : '') . ' /> <label>' .
                        _lg($data[1]). '</label> </div>  &nbsp;&nbsp; &nbsp;';
            }
            // checkbox event   
        } elseif ($type == 'checkbox') {
            // normal input genarate
            $input = '<input type="checkbox" ' . $this->_makeAttr($attr) .
                    ' value="' . $value . '"' .
                    ( (isset($other['checked']) && $other['checked'] == 1 ) ?
                            ' checked="" ' : '') . '/>';
        } elseif ($type == 'submit' || $type == 'button' || $type == 'reset') {
            if (isset($attr['class'])) {
                $attr['class'] .= ' ui button';
            } else {
                $attr['class'] = 'ui button';
            }

            // normal input genarate
            $input = '<input  type="' . $type .
                    '" ' . $this->_makeAttr($attr) . " " .
                            ($value == 'null' ? '' : 'value="' . _lg($value) . '"') . '/>';
        } else { // normal input genarate
            $input = '<input placeholder="' . _lg($label) . '" type="' . $type .
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
                    $result = ' <div class="field"> <label>  ' . _lg($label) . '  </label> ' . $element . ' </div>' . PHP_EOL;
                break;

            case 'checkbox':
                $result = '<div class="inline field"> <div class="ui checkbox"> ' . $element . '<label>' .  _lg($label)  . ' </label> </div></div> ' . PHP_EOL;
                break;
            case 'radio':
                $result = '<div class="inline fields">  <div class="field">' .  _lg($label)  . ' : ' . $element . ' </div></div>' . PHP_EOL;
                break;
            case 'hidden':
                $result = $element . PHP_EOL;
                break;

            default:
                $result = '<div class="field"> <label>  ' .  _lg($label)  . ' </label> ' . $element . ' </div>' . PHP_EOL;
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
        if (is_array($attr)) {

            foreach ($attr as $name => $value) {
                $result .= $name . '="' . $value . '" ';
            }
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
