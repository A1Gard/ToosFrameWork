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
define('CHART_MODE_COLUMN', 'column');

class TChart {

    private $mode = ''; // chart mode
    private $id = ''; // id element
    private $title = ''; // chart title
    private $name = ''; // chart name
    private $subtitle = ''; // sub title of chart
    private $rtl = ''; // rtl mode text
    private $tooltip = array(); // chart tooltip
    private $series = array(); // series
    private $option = array(); // options
    private $xaxis = array(); // x axsis for 2d s
    private $yaxis = array(); // y axis for 2ds
    private $font = array(); // defualt font

    /**
     * 
     * @param string $mode contacnt of chart mode start with CHART_MODE_
     * @param string $id chart element id most be uniqe
     */

    public function __construct($mode, $id) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $mode, $id);
        $this->mode = $mode;
        $this->id = $id;
    }

    /**
     *  set chart title 
     * @param string $title
     */
    public function SetTitle($title) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $title);
        $this->title = $title;
    }

    /**
     *  set chart name 
     * @param string $name
     */
    public function SetName($name) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $name);
        $this->name = $name;
    }

    
    /**
     *  set rtl or ltr mode for chart
     * @param bool $rtl
     */
    public function SetRTL($rtl = true) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $rtl);
        if ($rtl) {
            $this->rtl = ',useHTML: Highcharts.hasBidiBug';
        } else {
            $this->rtl = '';
        }
    }

    /**
     * set global chart options [plotOptions]
     * @param array $option
     */
    public function SetOption($option) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $option);
        $this->option = $option;
    }

    /**
     *  tooltip set for chart tooltip view
     * @param array $tooltip
     */
    public function SetTooltip($tooltip) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $tooltip);
        if ($this->rtl !== '') {
            $tooltip['useHTML'] = 'Highcharts.hasBidiBug';
        }
        if (count($this->font) > 0) {
            $tooltip['style'] = array('fontFamily'=>$this->font['name'],'fontSize' => $this->font['size']) ;
        }
        $this->tooltip = $tooltip;
    }

    /**
     * set X Axsis for 2d charts info
     * @param array $axis
     */
    public function SetxAxis($axis) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $axis);
        if ($this->rtl !== '') {
            $axis['reversed'] = true;
        }
        $this->xaxis = $axis;
    }

    /**
     * set Y Axsis for 2d charts info
     * @param array $axis
     */
    public function SetyAxis($axis) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $axis);
        if ($this->rtl !== '') {
            $axis['opposite'] = true;
        }
        $this->yaxis = $axis;
    }

    /**
     * set chart subtitle
     * @param string $subtitle
     */
    public function SetSubtitle($subtitle) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $subtitle);
        $this->subtitle = $subtitle;
    }

    /**
     * add chart value series 
     * @param string $name
     * @param array|int $data
     * @param array $option
     */
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

    /**
     * render the js of chart must be run after ChartRender
     * @param bool $has_block hast <sccript> block or not
     * @return string
     */
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
        return $js_code;
    }

    /**
     *  render the chart 
     * @param string $width example 100% [css mode]
     * @param string $height example 400px [css mode]
     * @param string $css alternative css for chart view convas
     * @return string
     */
    public function ChartRender($width, $height, $css = '') {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $width, $height, $css);
        $result = '<div id="' . $this->id . '" style="min-width: ' . $width . '; height: ' . $height . '; ' . $css . '"></div>';
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        return $result;
    }

    
    
    /**
     * render area chart mode js
     * @return string
     */
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
        if ($this->rtl != '') {
            $block .= "legend:{ symbolPadding: -20 ,rtl:true,reversed:true} " . ',' . PHP_EOL;
        }
        if ($this->option != array()) {
            $block .= "plotOptions: " . json_encode($this->option) . ',' . PHP_EOL;
        }
        $block .= "});" . PHP_EOL;
        return $block;
    }

    /**
     * render pie chart mode js
     * @return string
     */
    private function _pieJS() {
        $block = "Highcharts.chart('" . $this->id . "', {" . PHP_EOL;
        $block .= "chart: {type: 'pie',}," . PHP_EOL;
        $block .= "title: {text: '{$this->title}'{$this->rtl}}," . PHP_EOL;
        if ($this->subtitle != '') {
            $block .= "subtitle: {text: '{$this->subtitle}'{$this->rtl}}," . PHP_EOL;
        }

        $block .= "tooltip:" . json_encode($this->tooltip) . "," . PHP_EOL;
        $block .= "series: [{name: '{$this->name}',colorByPoint: true,data:" . json_encode($this->series) . '}],' . PHP_EOL;
        if ($this->rtl != '') {
            $this->option['pie']['dataLabels']['enabled'] = true;
            $this->option['pie']['dataLabels']['y'] = -1;
//            $this->option['pie']['dataLabels']['format'] ='\u202B' + '{point.name}';
            $this->option['pie']['dataLabels']['style']['textShadow'] = false;
            $this->option['pie']['dataLabels']['style']['fontSize'] = '12pt';
            $this->option['pie']['dataLabels']['useHTML'] = true;
        }
        if ($this->option != array()) {
            $block .= "plotOptions: " . json_encode($this->option) . ',' . PHP_EOL;
        }
//        $block .= "pie:{dataLabels:{enabled: true, format: '\u202B' + '{point.name}',style:{fontSize: '25px',textShadow:false} ,useHTML:true }}" . PHP_EOL;
        $block .= " });" . PHP_EOL;
        return $block;
    }

}
