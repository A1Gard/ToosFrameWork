<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 23-Jun-2017 (01-04-1396) 
 * @time : 16:32 
 * @subpackage   TChart
 * @version 0.5
 * @todo : a class for create hichart
 */
define('CHART_MODE_AREA', 'area');
define('CHART_MODE_PIE', 'pie');

class TChart {

    private $mode = '';
    private $id = '';
    private $title = '';
    private $subtitle = '';
    private $rtl = '';
    private $tooltip = array();
    private $series = array();
    private $option = array();
    private $xaxis = array();
    private $yaxis = array();

    public function __construct($mode, $id) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $mode, $id);
        $this->mode = $mode;
        $this->id = $id;
    }

    public function SetTitle($title) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $title);
        $this->title = $title;
    }

    public function SetRTL($rtl = true) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $rtl);
        if ($rtl) {
            $this->rtl = ',useHTML: Highcharts.hasBidiBug';
        } else {
            $this->rtl = '';
        }
    }

    public function SetOption($option) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $option);
        $this->option = $option;
    }

    public function SetTooltip($tooltip) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $tooltip);
        if ($this->rtl !== '') {
            $tooltip['useHTML'] = 'Highcharts.hasBidiBug';
        }
        $this->tooltip = $tooltip;
    }

    public function SetxAxis($axis) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $axis);
        if ($this->rtl !== '') {
            $axis['reversed'] = true;
        }
        $this->xaxis = $axis;
    }

    public function SetyAxis($axis) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $axis);
        $this->yaxis = $axis;
    }

    public function SetSubtitle($subtitle) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $subtitle);
        $this->subtitle = $subtitle;
    }

    public function AddSerie($name, $data, $option = null) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $name, $data, $option);

        if ($this->mode == 'pie') {
            if ($option == null) {
                $this->series[] = array('name' => $name, 'y' => $data);
            } else {
                $this->series[] = array('name' => $name, 'y' => $data, 'option' => $option);
            }
        } else {
            if ($option == null) {
                $this->series[] = array('name' => $name, 'data' => $data);
            } else {
                $this->series[] = array('name' => $name, 'data' => $data, 'option' => $option);
            }
        }
    }

    public function JsRender($has_block = true) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $has_block);
        $js_code = '';
        if ($has_block) {
            $js_code .= '<script type="text/javascript">';
        }


        $fnc = '_' . $this->mode . 'JS';

        $js_code .= $this->{$fnc}();

        if ($has_block) {
            $js_code .= '</script>';
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $js_code);
        return $result;
        return $js_code;
    }

    public function ChartRender($width, $height, $css = '') {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $width, $height, $css);
        $result = '<div id="' . $this->id . '" style="min-width: ' . $width . '; height: ' . $height . '; ' . $css . '"></div>';
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        return $result;
    }

    private function _areaJS() {

        $block = "Highcharts.chart('" . $this->id . "', {" . PHP_EOL;
        $block .= "chart: {type: 'area'}," . PHP_EOL;
        $block .= "title: {text: '{$this->title}'{$this->rtl}}," . PHP_EOL;
        if ($this->subtitle != '') {
            $block .= "subtitle: {text: '{$this->subtitle}'{$this->rtl}}," . PHP_EOL;
        }
        if ($this->xaxis != array()) {
            $block .= "xAxis: " . json_encode($this->xaxis) . ',' . PHP_EOL;
        }
        if ($this->yaxis != array()) {
            $block .= "yAxis: " . json_encode($this->yaxis) . ',' . PHP_EOL;
        }
        $block .= "tooltip:" . json_encode($this->tooltip) . "," . PHP_EOL;
        $block .= "series: " . json_encode($this->series) . ',' . PHP_EOL;
        if ($this->option != array()) {
            $block .= "plotOptions: " . json_encode($this->option) . ',' . PHP_EOL;
        }
        $block .= "});" . PHP_EOL;
        return $block;
    }

    private function _pieJS() {

        $block = "Highcharts.chart('" . $this->id . "', {" . PHP_EOL;
        $block .= "chart: {type: 'pie'}," . PHP_EOL;
        $block .= "title: {text: '{$this->title}'{$this->rtl}}," . PHP_EOL;
        if ($this->subtitle != '') {
            $block .= "subtitle: {text: '{$this->subtitle}'{$this->rtl}}," . PHP_EOL;
        }

        $block .= "tooltip:" . json_encode($this->tooltip) . "," . PHP_EOL;
        $block .= "series: [{name: 'Brands',colorByPoint: true,data:" . json_encode($this->series) . '}],' . PHP_EOL;
        if ($this->option != array()) {
            $block .= "plotOptions: " . json_encode($this->option) . ',' . PHP_EOL;
        }
        $block .= "});" . PHP_EOL;
        return $block;
    }

}
