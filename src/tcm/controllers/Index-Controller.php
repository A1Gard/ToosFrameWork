<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   index-controller.php | dashboard controller
 * @todo : index page | dashboard 
 */
class Index extends TController {

    function __construct() {

        parent::__construct();
    }
    
    
    /**
     * @todo Show index without any thing
     */
    public function Index() {
        $this->view->msg = "We are in index...";
        $this->view->PageRender('Index/Index', _lg('Desktop'));
    }

    public function Sentence() {
        $this->view->sen = $this->model->Sentence();
        $this->view->PageRender('Index/Sen', 'جملات انگیزشی');
    }

    public function Sentence1() {
        $this->view->sen = $this->model->Sentence1();
//        var_dump($this->view->sen);
        $this->view->senx = $this->view->sen['txt'];
        unset($this->view->sen['txt']);
        $this->view->PageRender('Index/Sen1', 'notification');
    }

    public function SaveSentence() {
        $this->model->SaveSentence();
        GoBack();
    }

    public function SaveSentence1() {

        $this->model->SaveSentence1();
        GoBack();
    }

    public function SaveSetting() {
        $this->model->SaveSetting();
        GoBack();
    }

    public function Setting() {
        $this->view->Setting = $this->model->Setting();
        $this->view->PageRender('Index/Setting', 'تنظیمات سایت ');
    }
    public function Time() {
        $this->view->Time = $this->model->Time();
        $this->view->PageRender('Index/Time', ' وقت ها ');
    }

    public function Statistic() {
        $sys = new TSystem();
        $st = new TStatistic();
        $dt = new TDate();
        $this->view->m = $sys->GetRcordCount('member');
        $this->view->ma = $sys->GetRcordCount('member', 'member_type = 1');
        $this->view->com = $sys->GetRcordCount('comment');
        $this->view->acom = $sys->GetRcordCount('member', 'member_status = 1');
        $this->view->top = $sys->GetRcordCount('topic');
        $this->view->topa = $sys->GetRcordCount('topic', 'topic_status = 1');
        $this->view->tops = $sys->GetRcordCount('topic', 'topic_status = 2');
        $viss['visitcount'] = $st->VisitCount($dt->Today(), time());
        $viss['visitorcount'] = $st->VisitorCount($dt->Today(), time());
        $viss['y'] = $st->VisitCount($dt->Yesterday(), $dt->Today());
        $viss['ys'] = $st->VisitorCount($dt->Yesterday(), $dt->Today());
        $viss['m'] = $st->VisitCount($dt->ThisMonthStart(), time());
        $viss['lm'] = $st->VisitCount($dt->LastMonthStart(), $dt->LastMonthEnd());
        $viss['total'] = $st->VisitCount(0, time());
        $viss['online'] = $st->OnlineCount();

        $t = time();
        $s = $dt->Yesterday();
        $e = $dt->Today() - 1;
        $dayz = array();
        $viz = array();
        $vit = array();
        $viz[0] = $viss['visitcount'];
        $vit[0] = $viss['visitorcount'];
        for ($index = 0; $index < 30; $index++) {

            $mod = ($index * DAY);
            $dayz[$index] = $dt->SDate('d', $t - $mod);
            $viz[$index + 1] = $st->VisitCount($s - $mod, $e - $mod);
            $vit[$index + 1] = $st->VisitorCount($s - $mod, $e - $mod);
        }

        unset($viz[$index + 1]);
        unset($vit[$index + 1]);

        $this->view->dayz = array_reverse($dayz);
        $this->view->viz = array_reverse($viz);
        $this->view->vit = array_reverse($vit);

        global $browser_list, $os_list;

        $this->view->bw = array();
        $this->view->os = array();

        for ($i = 0; $i < count($browser_list); $i++) {
            $this->view->bw[$i] = $sys->GetRcordCount('statistic', 'statistic_browser = ' . $i);
        }
        for ($i = 0; $i < count($os_list); $i++) {
            $this->view->os[$i] = $sys->GetRcordCount('statistic', 'statistic_os = ' . $i);
        }
        while (($key = array_search('0', $this->view->os)) !== false) {
            unset($this->view->os[$key]);
        }
        while (($key = array_search('0', $this->view->bw)) !== false) {
            unset($this->view->bw[$key]);
        }

        $this->view->cl1 = $sys->GetRedToGreen(count($this->view->bw));
        $this->view->cl2 = $sys->GetRedToGreen(count($this->view->os));



        $this->view->topvisits = $sys->GetRecordByOrd('topic', 'topic_counter', '1', 'DESC');
        $this->view->lastsch = $sys->GetRecordByOrd('statistic', 'statistic_id', ' CHAR_LENGTH(statistic_keyword) > 2 ', 'DESC');
        $this->view->vis = $viss;
        $this->view->PageRender('Index/Statistic', 'آمار سایت ');
    }

    public function Slider() {
        $this->view->Val = $this->model->All("slider");
        $this->view->PageRender('Index/Slider', ' اسلایدر ');
    }

    public function Save($setting) {
        $this->model->Save($setting);
    }
    
     public function Titles() {
        $this->view->Val = $this->model->All("titles");
        $this->view->PageRender('Index/titles', ' عنوانین ');
    }
    
      public function Pricing() {
        $this->view->Val = $this->model->All("prcing");
        $this->view->PageRender('Index/prcing', ' عنوانین ');
    }

    
    public function e404() {
        $this->view->PageRender('Index/404', _lg('Not found...'));
    }

}
