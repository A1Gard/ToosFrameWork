<aside>
    <div id="sidebar" class="nav-collapse animate-fast" tabindex="5000" style="outline: none;">
        <!-- sidebar menu start-->


        <?php
        $side_menu = new TMenu();
        $side_menu->AddItem('میزکار', UR_CMT, 0, 'fa-dashboard');

        $index = $side_menu->AddItem('یادداشت ها', '#', 0, 'fa-bullhorn');
        $side_menu->AddItem('فهرست یادداشت ها', UR_CMT .
                'Topic/Index', $index);
        $side_menu->AddItem('یادداشت جدید', UR_CMT .
                'Topic/NewTopic', $index);


        $index = $side_menu->AddItem('دسته ها', '#', 0, 'fa-book');
        $side_menu->AddItem('فهرست کلاسیک دسته ها', UR_CMT .
                'Category/Index', $index);
        $side_menu->AddItem(' فهرست حرفه ای دسته ها', UR_CMT .
                'Category/Pro', $index);
        $side_menu->AddItem('منوی سایت', UR_CMT .
                'DropDownMenu/Index', 0, 'fa-ellipsis-h');
        $side_menu->AddItem(' تنظیمات سایت', UR_CMT .
                'Index/Setting', 0, 'fa-cogs');
        $side_menu->AddItem(' جملات انگیزشی', UR_CMT .
                'Index/Sentence', 0, 'fa-star');
        $side_menu->AddItem(' دیدگاه', UR_CMT .
                'Comment/Index', 0, 'fa-comments');
//        $side_menu->AddItem(' برنامه فردی', UR_CMT .
//                'Req/Index', 0, 'fa-comments');

        $index = $side_menu->AddItem('اعضا ', '#', 0, 'fa-group');
        $side_menu->AddItem('فهرست  اعضا', UR_CMT .
                'Member/Index', $index);
        $side_menu->AddItem(' ثبت عضو جدید', UR_CMT .
                'Member/NewMember', $index);
        $side_menu->AddItem('   جستجوی اعضا', UR_CMT .
                'Member/Search', $index);

        $side_menu->AddItem('خروج', UR_CMT . 'Access/Logout', 0, 'fa-user');

        echo $side_menu->Render('nav-accordion', 'sidebar-menu animate-fast');
        ?>
        <!-- sidebar menu end-->
    </div>
</aside>