<?php
/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   index.php
 * @todo : index - index page view
 */
global $browser_list, $os_list;
?>

<div class="row autofit rtl">
    <div class="grd24">
        <div class="temp" >
            <br />
            <h3>
                بازدید و بازدید کننده 30 روز اخیر

            </h3>
            <br />
            <div style="margin:5%;">
                <canvas id="canvas" height="60" ></canvas>
            </div>
        </div>

    </div>
    <div class="grd12">
        <div class="temp " >
            <div class="margin">
                <br />
                <h3> آمار فعایت

                </h3>
                <br />
                <ul class="state">
                    <li>
                        تعداد اعضا:
                        <span>
                            <?= $this->m; ?>
                        </span>
                    </li>
                    <li>
                        تعداد اعضا فعال: 

                        <span>
                            <?= $this->ma; ?>
                        </span>
                    </li>
                    <li>
                        تعداد  دیدگاه ها: 

                        <span>
                            <?= $this->com; ?>
                        </span>
                    </li>
                    <li>
                        تعداد  دیدگاه ها تایید شده: 

                        <span>
                            <?= $this->acom; ?>
                        </span>

                    </li>
                    <li>
                        تعداد  یادداشت  ها: 

                        <span>
                            <?= $this->top; ?>
                        </span>
                    </li>
                    <li>
                        تعداد  یادداشت های منشتر شده:

                        <span>
                            <?= $this->topa; ?>
                        </span>

                    </li>
                    <li>
                        تعداد  یادداشت های  ویژه:

                        <span>
                            <?= $this->tops; ?>
                        </span>

                    </li>

                </ul>

                <br />
            </div>


        </div>
    </div>
    <div class="grd12">
        <div class="temp" >
            <br />
            <h3> 
                آمار بازدید
            </h3>
            <br />
            <ul class="state">
                <li>
                    بازدید امروز:
                    <span>
                        <?= $this->vis['visitcount']; ?>
                    </span>
                </li>
                <li>
                    بازدیدکننده امروز: 

                    <span>
                        <?= $this->vis['visitorcount']; ?>
                    </span>
                </li>
                <li>
                    بازدید دیروز: 

                    <span>
                        <?= $this->vis['y']; ?>
                    </span>
                </li>
                <li>
                    بازدید کننده امروز: 

                    <span>
                        <?= $this->vis['ys']; ?>
                    </span>

                </li>
                <li>
                    بازدید این ماه: 

                    <span>
                        <?= $this->vis['m']; ?>
                    </span>
                </li>
                <li>
                    بازدیدهای ماه گذشته:

                    <span>
                        <?= $this->vis['lm']; ?>
                    </span>

                </li>
                <li>
                    افراد آنلاین:

                    <span>
                        <?= $this->vis['online']; ?>
                    </span>

                </li>
                <li>
                    بازدید کل:

                    <span>
                        <?= $this->vis['total']; ?>
                    </span>

                </li>

            </ul>

        </div>  
    </div>
    <div class="grd12">
        <div class="temp" >
            <br />
            <h3>
                مرورگر ها

            </h3>
            <br />
            <div id="canvas-holder" class="text-center">
                <canvas id="chart-area" width="300" height="300"/>
            </div>
        </div>

    </div>
    <div class="grd12">
        <div class="temp" >
            <br />
            <h3>
                سیستم عامل ها

            </h3>
            <br />
            <div id="canvas-holder1" class="text-center">
                <canvas id="chart-area1" width="300" height="300"/>
            </div>
        </div>

    </div>
    <div class="grd12">
        <div class="temp" >
            <br />
            <h3>
                پر بازدید ترین ها

            </h3>
            <br />
            <ul class="state">
                <?php foreach ($this->topvisits as $topic): ?>
                    <li> <?= $topic['topic_title'] ?> <span> (<?= $topic['topic_counter'] ?>) </span>  </li>
                <?php endforeach; ?>
            </ul>

        </div>

    </div>
    <div class="grd12">
        <div class="temp" >
            <br />
            <h3>
                آخرین کلمات جستجو شده

            </h3>
            <br />
            <ul class="state">
                <?php foreach ($this->lastsch as $topic): ?>
                    <li>   <?= $topic['state_keyword'] ?>  </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>



    <div class="grd6"><div class="temp" ></div></div>
    <div class="grd6"><div class="temp" ></div></div>
    <div class="grd6"><div class="temp" ></div></div>
    <div class="grd6"><div class="temp" ></div></div>
</div>
<script type="text/javascript">
    var randomScalingFactor = function () {
    return Math.round(Math.random() * 100)
    };
            var lineChartData = {
            labels: ["<?= implode($this->dayz, '","') ?>"],
                    datasets: [
                    {
                    label: "بازدید کننده",
                            fillColor: "rgba(200,40,40,0.2)",
                            strokeColor: "rgba(200,0,0,.6)",
                            pointColor: "rgba(255,100,100,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: ["<?= implode($this->vit, '","') ?>"]
                    },
                    {
                    label: "بازدید ",
                            fillColor: "rgba(220,220,220,0.4)",
                            strokeColor: "rgba(20,20,20,1)",
                            pointColor: "rgba(0,0,0,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(151,187,205,1)",
                            data: ["<?= implode($this->viz, '","') ?>"]
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
        value: <?= $bw ?>,
                color: "<?= $this->cl1[$i]; ?>",
                highlight: "#777777",
                label: "<?= $browser_list[$key] ?>"
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
                value: <?= $bw ?>,
                        color: "<?= $this->cl2[$i]; ?>",
                        highlight: "#777777",
                        label: "<?= $os_list[$key] ?>"
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




</script>