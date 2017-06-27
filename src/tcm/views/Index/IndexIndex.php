<?php
/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   index.php
 * @todo : index - index page view
 */
global $browser_list, $os_list, $ma;

$frm = new TForm(UR_MP . 'Member/Insert', 'post', array('class' => 'form rtl'));


$frm->AddField('startgroup');
$frm->AddField('text', 'نام', null, array('name' => 'member_name'));
$frm->AddField('email', 'ایمیل', null, array('name' => 'member_email'));
$frm->AddField('endgroup');

$frm->AddField('startgroup');
$frm->AddField('password', 'گذرواژه', null, array('name' => 'member_password'));
$frm->AddField('text', 'استاتوس', null, array('name' => 'member_status'));
$frm->AddField('endgroup');
$frm->AddField('startgroup');
$frm->AddField('text', 'زمان تمدید', null, array('name' => 'member_active_time', 'class' => _lg('datepicker')));
$frm->AddField('text', 'زمان تمدید', null, array('name' => 'member_active_time', 'class' => ('datepicker')));
$frm->AddField('text', ' ساعت', null, array('name' => 'member_active_time', 'class' => ('timepicker')));
$frm->AddField('endgroup');

$frm->AddField('startgroup');
$frm->AddField('file', 'آواتار', null, array('name' => 'member_avatar'));
$frm->AddField('text', 'مقطع', null, array('name' => 'member_degree'));
$frm->AddField('endgroup');
$frm->AddField('startgroup');
$frm->AddField('text', 'رشته تحصیلی', null, array('name' => 'member_field'));
$frm->AddField('text', 'شماره تماس', null, array('name' => 'member_number'));
$frm->AddField('text', 'شهر', null, array('name' => 'member_city'));
$frm->AddField('endgroup');
$frm->AddField('select', 'نوع', null, array('name' => 'member_type'), array(0 => array('0', 'تایید نشده'),
    1 => array('1', 'تایید شده'),
    2 => array('2', 'اخراجی')));
$frm->AddField('startgroup');
$frm->AddField('select', 'نوع', null, array('name' => 'member_type', 'class' => 'choosen'), array(0 => array('0', 'تایید نشده'),
    1 => array('1', 'تایید شده'),
    2 => array('2', 'اخراجی')));
$frm->AddField('list', 'نوع', null, array('name' => 'member_type', 'class' => 'choosen'), array(
    0 => array('0', 'تایید نشده'),
    1 => array('1', 'تایید شده'),
    3 => array('3', ' ایران'),
    4 => array('4', ' جهان آرا'),
    5 => array('5', ' زمانی'),
    6 => array('6', ' هلالی'),
    2 => array('2', 'اخراجی')
));
$frm->AddField('text', 'مبلغ', null, array('name' => 'member_city', 'class' => 'currency'));
$frm->AddField('endgroup');
$frm->AddField('checkbox', 'چک باکس', null, array('name' => 'member_degree'));
$frm->AddField('radio', 'نوع', null, array('name' => 'member_type'), array(
    0 => array('0', 'تایید نشده'),
    1 => array('1', 'تایید شده'),
    3 => array('3', ' ایران'),
    4 => array('4', ' جهان آرا'),
    5 => array('5', ' زمانی'),
    6 => array('6', ' هلالی'),
    2 => array('2', 'اخراجی')
));

$frm->AddField('submit', '', 'ارسال', array('class' => 'green'));
?>
<?php
//$frm->Render();
?>
<script type="text/javascript" src="<?php echo UR_MP ?>assets/libs/hichart/highcharts.js"></script>
<script type="text/javascript" src="<?php echo UR_MP ?>assets/libs/hichart/highcharts-more.js"></script>
<script type="text/javascript" src="<?php echo UR_MP ?>assets/libs/hichart/themes/dark-unica.js"></script>
<div class="row qshortcuts autofit" >
    <div class="grd6">
        <a href="#" class="ui button grey">  
            <i class="fa fa-cubes"></i>
            انبار
        </a>
    </div>
    <div class="grd6">
        <a href="#" class="ui button blue">  
            <i class="fa fa-calendar"></i>
            روزشمار
        </a>
    </div>
    <div class="grd6">
        <a href="#" class="ui button orange">  
            <i class="fa fa-child"></i>
            افراد
        </a>
    </div>
    <div class="grd6">
        <a href="#" class="ui button">  
            <i class="fa fa-user"></i>
            مشتریان
        </a>
    </div>
    <div class="grd6">
        <a href="#" class="ui button green">  
            <i class="fa fa-bar-chart"></i>
            گزارش ها
        </a>
    </div>
    <div class="grd6">
        <a href="<?php echo UR_MP ?>Index/Sell" class="ui button pink">  
            <i class="fa fa-shopping-cart"></i>
            فروش
        </a>
    </div>
    <div class="grd6">
        <a href="#" class="ui button red">  
            <i class="fa fa-envelope-o"></i>
            مکاتبه
        </a>
    </div>
    <div class="grd6">
        <a href="#" class="ui button purple">  
            <i class="fa fa-vcard-o"></i>
            دفترچه تلفن
        </a>
    </div>
</div>

<div class="row">
    <div class="grd24">
        &nbsp;
        <br />

    </div>
    <div class="grd12">
        <?php
        $chart1 = new TChart(CHART_MODE_AREA, 'testid');
        $chart1->SetRTL();
        $chart1->SetTitle('Sample نمونه 1');
        $chart1->SetSubtitle('Source: <a href="http://github.com/A1Gard"> mychart subtitle </a>');
        $chart1->SetTooltip(array('text' => array('pointFormat' => '{series.name} ')));
        $chart1->SetyAxis(array('title' => array('text' => ' نوشته text اریب')));
        $chart1->SetxAxis(array('allowDecimals' => false));
        $chart1->SetOption(array('area' => array(
                'pointStart' => 2010,
                'marker' => array(
                    'enabled' => FALSE,
                    'symbol' => 'circle',
                    'radius' => 2
                )
        )));
        $chart1->AddSerie('Iran', array(12, 14, 35, 10, 14, 16, 26, 14, 36, 6));
        $chart1->AddSerie('Russia', array(34, 24, 21, 30, 10, 8, 11, 15, 4, 27));

        echo $chart1->ChartRender('100%', '400px');
        echo $chart1->JsRender();
        ?>
        <br />
        <br />
        <br />

    </div>
    <div class="grd12">
        <?php
        $chart2 = new TChart(CHART_MODE_PIE, 'testid2');
        $chart2->SetRTL();
        $chart2->SetTitle('Sample نمونه 2');
        $chart2->SetSubtitle('Source: <a href="http://github.com/A1Gard"> mychart subtitle </a>');
        $chart2->SetTooltip(array('pointFormat' => '{series.name}: <b>{point.percentage:.1f}%</b>'));
//        $chart1->SetyAxis(array('title' => array('text' => ' نوشته text اریب')));
//        $chart1->SetxAxis(array('allowDecimals' => false));
        $chart2->SetOption(array('pie' => array(
                'allowPointSelect' => true,
                'cursor' => 'pointer',
                'dataLabels' => array(
                    'enabled' => true,
                    'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
                )
        )));
        $chart2->AddSerie('Iran', (55));
        $chart2->AddSerie('USA', (33));
        $chart2->AddSerie('UK', (12));
        $chart2->AddSerie('Russia', (45));

        echo $chart2->ChartRender('100%', '400px');
        echo $chart2->JsRender();
        ?>
    </div>
    <div class="grd12">
        <br />

        <table class="ui celled structured table inverted">
            <thead>
                <tr>
                    <th rowspan="2">شرکت</th>
                    <th rowspan="2">برگه</th>
                    <th rowspan="2">تعداد</th>
                    <th colspan="3">مراحل</th>
                </tr>
                <tr>
                    <th>برش</th>
                    <th>پزدازش</th>
                    <th>بسته بندی</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> شرکت کاله </td>
                    <td>سفارش 1</td>
                    <td class="right aligned">2</td>
                    <td class="center aligned">
                        <i class="large green checkmark icon"></i>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="3"> شرکت آناتا </td>
                    <td>برگه شمارع  1</td>
                    <td class="right aligned">52</td>
                    <td class="center aligned">
                        <i class="large green checkmark icon"></i>
                    </td>
                    <td class="center aligned">
                        <i class="large green checkmark icon"></i>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>برگه شماره 2</td>
                    <td class="right aligned">12</td>
                    <td></td>
                    <td class="center aligned">
                        <i class="large green checkmark icon"></i>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>برگه شماره 3</td>
                    <td class="right aligned">21</td>
                    <td class="center aligned">
                        <i class="large green checkmark icon"></i>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="3"> شرکت آراکس تبریز </td>
                    <td>برگه شمارع  1</td>
                    <td class="right aligned">52</td>
                    <td class="center aligned">
                        <i class="large green checkmark icon"></i>
                    </td>
                    <td></td>
                    <td class="center aligned">
                        <i class="large green checkmark icon"></i>
                    </td>
                </tr>
                <tr>
                    <td>برگه شماره 2</td>
                    <td class="right aligned">12</td>
                    <td></td>
                    <td class="center aligned">
                        <i class="large green checkmark icon"></i>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>برگه شماره 3</td>
                    <td class="right aligned">21</td>
                    <td class="center aligned">
                        <i class="large green checkmark icon"></i>
                    </td>
                    <td class="center aligned">
                        <i class="large green checkmark icon"></i>
                    </td>
                    <td class="center aligned">
                        <i class="large green checkmark icon"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>