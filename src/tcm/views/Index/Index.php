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
        <a href="#" class="ui button pink">  
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
    <div class="grd24">

        <div id="container" style="min-width: 230px; height: 400px; margin: 0 auto;direction: ltr"></div>



        <script type="text/javascript">


            var ranges = [
                [1246406400000, 14.3, 27.7],
                [1246492800000, 14.5, 27.8],
                [1246579200000, 15.5, 29.6],
                [1246665600000, 16.7, 30.7],
                [1246752000000, 16.5, 25.0],
                [1246838400000, 17.8, 25.7],
                [1246924800000, 13.5, 24.8],
                [1247011200000, 10.5, 21.4],
                [1247097600000, 9.2, 23.8],
                [1247184000000, 11.6, 21.8],
                [1247270400000, 10.7, 23.7],
                [1247356800000, 11.0, 23.3],
                [1247443200000, 11.6, 23.7],
                [1247529600000, 11.8, 20.7],
                [1247616000000, 12.6, 22.4],
                [1247702400000, 13.6, 19.6],
                [1247788800000, 11.4, 22.6],
                [1247875200000, 13.2, 25.0],
                [1247961600000, 14.2, 21.6],
                [1248048000000, 13.1, 17.1],
                [1248134400000, 12.2, 15.5],
                [1248220800000, 12.0, 20.8],
                [1248307200000, 12.0, 17.1],
                [1248393600000, 12.7, 18.3],
                [1248480000000, 12.4, 19.4],
                [1248566400000, 12.6, 19.9],
                [1248652800000, 11.9, 20.2],
                [1248739200000, 11.0, 19.3],
                [1248825600000, 10.8, 17.8],
                [1248912000000, 11.8, 18.5],
                [1248998400000, 10.8, 16.1]
            ],
                    averages = [
                        [1246406400000, 21.5],
                        [1246492800000, 22.1],
                        [1246579200000, 23],
                        [1246665600000, 23.8],
                        [1246752000000, 21.4],
                        [1246838400000, 21.3],
                        [1246924800000, 18.3],
                        [1247011200000, 15.4],
                        [1247097600000, 16.4],
                        [1247184000000, 17.7],
                        [1247270400000, 17.5],
                        [1247356800000, 17.6],
                        [1247443200000, 17.7],
                        [1247529600000, 16.8],
                        [1247616000000, 17.7],
                        [1247702400000, 16.3],
                        [1247788800000, 17.8],
                        [1247875200000, 18.1],
                        [1247961600000, 17.2],
                        [1248048000000, 14.4],
                        [1248134400000, 13.7],
                        [1248220800000, 15.7],
                        [1248307200000, 14.6],
                        [1248393600000, 15.3],
                        [1248480000000, 15.3],
                        [1248566400000, 15.8],
                        [1248652800000, 15.2],
                        [1248739200000, 14.8],
                        [1248825600000, 14.4],
                        [1248912000000, 15],
                        [1248998400000, 13.6]
                    ];


            Highcharts.chart('container', {
                title: {
                    text: ' میزان فروش یک ماه اخیر '
                },
                xAxis: {
                    type: 'datetime'
                },
                yAxis: {
                    title: {
                        text: null
                    }
                },
                tooltip: {
                    crosshairs: true,
                    shared: true,
                    valueSuffix: '°C'
                },
                legend: {
                },
                series: [{
                        name: 'Temperature',
                        data: averages,
                        zIndex: 1,
                        marker: {
                            fillColor: 'white',
                            lineWidth: 2,
                            lineColor: Highcharts.getOptions().colors[0]
                        }
                    }, {
                        name: 'Range',
                        data: ranges,
                        type: 'arearange',
                        lineWidth: 0,
                        linkedTo: ':previous',
                        color: Highcharts.getOptions().colors[0],
                        fillOpacity: 0.3,
                        zIndex: 0
                    }]
            });
        </script>
    </div>


    <div class="grd12">
        <br />
        <br />

        <div id="container2" style="min-width: 200px; height: 400px; max-width: 600px; margin: 0 auto;;direction: ltr;margin-left: .5em;"></div>


        <script type="text/javascript">


// Radialize the colors
            Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
                return {
                    radialGradient: {
                        cx: 0.5,
                        cy: 0.3,
                        r: 0.7
                    },
                    stops: [
                        [0, color],
                        [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                    ]
                };
            });

// Build the chart
            Highcharts.chart('container2', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'نمودار فروش',
                    useHTML: Highcharts.hasBidiBug
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme),
                                textShadow: false,
                                textOutline: false,
                                useHTML: Highcharts.hasBidiBug
                            },
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                        name: 'نوع جنس',
                        data: [
                            {name: ' تسمه های نقاله  ', y: 56.33},
                            {
                                name: 'انتقال نیرو',
                                y: 24.03,
                                sliced: true,
                                selected: true
                            },
                            {name: 'توری تلفلنی', y: 10.38},
                            {name: 'چسب', y: 4.77}, {name: 'Other', y: 0.91},
                            {name: ' سایر ', y: 0.2}
                        ],
                    }]
            });
        </script>
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