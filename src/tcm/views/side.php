<section id="sidebar">

    <ul id="nav-accordion" class="sidebar-menu" >
        <!-- sidebar menu start-->

        <?php
        $side_menu = new TMenu();
        $side_menu->AddItem('میزکار', UR_MPT, 0, 'fa-dashboard');

        $index = $side_menu->AddItem('یادداشت ها', '#', 0, 'fa-bullhorn');
        $side_menu->AddItem('فهرست یادداشت ها', UR_MPT .
                'Topic/Index', $index);
        $side_menu->AddItem('یادداشت جدید', UR_MPT .
                'Topic/NewTopic', $index);


        $index = $side_menu->AddItem('دسته ها', '#', 0, 'fa-book');
        $side_menu->AddItem('فهرست کلاسیک دسته ها', UR_MPT .
                'Category/Index', $index);
        $side_menu->AddItem(' فهرست حرفه ای دسته ها', UR_MPT .
                'Category/Pro', $index);
        $side_menu->AddItem('منوی سایت', UR_MPT .
                'DropDownMenu/Index', 0, 'fa-ellipsis-h');
        $side_menu->AddItem(' تنظیمات سایت', UR_MPT .
                'Index/Setting', 0, 'fa-cogs');
        $side_menu->AddItem(' جملات انگیزشی', UR_MPT .
                'Index/Sentence', 0, 'fa-star');
        $side_menu->AddItem(' دیدگاه', UR_MPT .
                'Comment/Index', 0, 'fa-comments');
//        $side_menu->AddItem(' برنامه فردی', UR_MPT .
//                'Req/Index', 0, 'fa-comments');

        $index = $side_menu->AddItem('اعضا ', '#', 0, 'fa-group');
        $side_menu->AddItem('فهرست  اعضا', UR_MPT .
                'Member/Index', $index);
        $side_menu->AddItem(' ثبت عضو جدید', UR_MPT .
                'Member/NewMember', $index);
        $side_menu->AddItem('   جستجوی اعضا', UR_MPT .
                'Member/Search', $index);

        $side_menu->AddItem('خروج', UR_MPT . 'Access/Logout', 0, 'fa-user');

        echo $side_menu->Render('nav-accordion', 'sidebar-menu animate-fast');
        ?>
        <!-- sidebar menu end-->
    </ul>
</section>