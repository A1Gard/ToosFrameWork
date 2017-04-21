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
$frm->AddField('text', 'زمان تمدید', null, array('name' => 'member_active_time', 'class' => _lg('datepicker')));
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
$frm->AddField('startgroup');
$frm->AddField('select', 'نوع', null, array('name' => 'member_type'), array(0 => array('0', 'تایید نشده'),
    1 => array('1', 'تایید شده'),
    2 => array('2', 'اخراجی')));
$frm->AddField('text', 'مبلغ', null, array('name' => 'member_city','class' => 'currency'));
$frm->AddField('endgroup');
$frm->AddField('checkbox', 'چک باکس', null, array('name' => 'member_degree'));
$frm->AddField('radio', 'نوع', null, array('name' => 'member_type'), array(0 => array('0', 'تایید نشده'),
    1 => array('1', 'تایید شده'),
    2 => array('2', 'اخراجی')));

$frm->AddField('submit', '', 'ارسال');
?>
<div class="">
    <?php $frm->Render(); ?>
</div>
<div class="row autofit rtl">
    <div class="grd24">
        <div class="white-bg" >
            <br />
            <h3>
                <?php _lp("The lastest 30 days statics") ?>
            </h3>
            <br />
            <div style="margin:5%;">
                <canvas id="canvas" height="60" ></canvas>
            </div>
        </div>

    </div>
    <div class="grd12">
        <div class="white-bg" >
            <br />
            <h3>
                <?php _lp("Information") ?>

            </h3>
            <br />
            <ul class="state">
                <li>
                    <?php _lp("Your browser") ?>
                    :
                    <?php echo TVisitor::GetBrowerIcon('fa-1x') ?>
                    <span>
                        <?php echo TVisitor::DetectBrowser() ?>
                    </span>
                </li>
                <li>
                    <?php _lp("Your browser version") ?>
                    :
                    <span>
                        <?php echo TVisitor::BrowserVersion() ?>
                    </span>
                </li>
                <li>
                    <?php _lp("Your OS") ?>
                    :
                    <?php echo TVisitor::GetOSIcon('fa-1x') ?>
                    <span>
                        <?php echo TVisitor::DetectOS() ?>
                    </span>
                </li>
                <li>
                    <?php _lp("Your IP") ?>
                    :
                    <span>
                        <?php echo _ip() ?>
                    </span>
                </li>
                <li>
                    <?php _lp("WebServer") ?>
                    :
                    <span>
                        <?php echo TSystem::GetWebServer() ?>
                    </span>
                </li>
                <li>
                    <?php _lp("Server OS") ?>
                    :
                    <span>
                        <?php echo TSystem::GetServerOS() ?>
                    </span>
                </li>
                <li>
                    <?php _lp("Server IP") ?>
                    :
                    <span>
                        <?php echo TSystem::GetServerIP() ?>
                    </span>
                </li>
                <li>
                    <?php _lp("PHP version") ?>
                    :
                    <span>
                        <?php echo TSystem::GetPHPVersion() ?>
                    </span>
                </li>
                <li>
                    <?php _lp("Server CPU usage") ?>
                    :
                    <span>
                        <progress max="100" title="<?php echo TSystem::GetServerCPUUsage() ?>%" value="<?php echo TSystem::GetServerCPUUsage() ?>">
                    </span>
                </li>
                <li>
                    <?php _lp("Server Memory usage") ?>
                    :
                    <span>
                        <progress max="100" title="<?php echo TSystem::GetServerMemUsage() ?>%" value="<?php echo TSystem::GetServerMemUsage() ?>">
                    </span>
                </li>

            </ul>

        </div>

    </div>
    <div class="grd12">
        <div class="white-bg" >
            <br />
            <h3>
                <?php _lp("Browsers") ?>
                :
            </h3>
            <br />
            <div id="canvas-holder" class="text-center">
                <canvas id="chart-area" width="300" height="300"/>
            </div>
        </div>

    </div>
    <div class="grd12">
        <div class="white-bg" >
            <br />
            <h3>
                <?php _lp("OSes") ?>
                :

            </h3>
            <br />
            <div id="canvas-holder1" class="text-center">
                <canvas id="chart-area1" width="300" height="300"/>
            </div>
        </div>

    </div>

    <div class="grd12">
        <div class="white-bg" >
            <br />
            <h3>
                <?php _lp("The lastest searched words") ?>

            </h3>
            <br />
            <ul class="state">
                <?php foreach ($this->lastsch as $topic): ?>
                    <li>   <?php echo $topic['statistic_keyword'] ?>  </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</div>
<!--<script type="text/javascript">
    var randomScalingFactor = function () {
    return Math.round(Math.random() * 100)
    };
    var lineChartData = {
    labels: ["<?php echo implode($this->dayz, '","') ?>"],
            datasets: [
            {
            label: "<?php _lp("Visitors") ?>",
                    fillColor: "rgba(200,40,40,0.2)",
                    strokeColor: "rgba(200,0,0,.6)",
                    pointColor: "rgba(255,100,100,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: ["<?php echo implode($this->vit, '","') ?>"]
            },
            {
            label: "<?php _lp("Vistis") ?> ",
                    fillColor: "rgba(220,220,220,0.4)",
                    strokeColor: "rgba(20,20,20,1)",
                    pointColor: "rgba(0,0,0,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: ["<?php echo implode($this->viz, '","') ?>"]
            }
            ]

    }


    var pieData = [
<?php
$i = -1;
foreach ($this->bw as $key => $bw):
    $i++;
    ?>
            {
            value: <?php echo $bw ?>,
                    color: "<?php echo $this->cl1[$i]; ?>",
                    highlight: "#777777",
                    label: "<?php echo $browser_list[$key] ?>"
            },
<?php endforeach; ?>


    ];
    var pieData1 = [
<?php
$i = -1;
foreach ($this->os as $key => $bw):
    $i++;
    ?>
            {
            value: <?php echo $bw ?>,
                    color: "<?php echo $this->cl2[$i]; ?>",
                    highlight: "#777777",
                    label: "<?php echo $os_list[$key] ?>"
            },
<?php endforeach; ?>


    ];
    window.onload = function () {
    var ctx1 = document.getElementById("chart-area1").getContext("2d");
    window.myPie1 = new Chart(ctx1).Pie(pieData1);
    var ctx = document.getElementById("chart-area").getContext("2d");
    window.myPie = new Chart(ctx).Pie(pieData);
    var ctx2 = document.getElementById("canvas").getContext("2d");
    window.myLine = new Chart(ctx2).Line(lineChartData, {
    responsive: true
    });
    };




</script>-->