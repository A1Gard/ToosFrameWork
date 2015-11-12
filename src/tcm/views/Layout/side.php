<section id="sidebar">

    <ul id="nav-accordion" class="sidebar-menu" >
        <!-- sidebar menu start-->
        <?php
        $side_menu = new TMenu();
        $side_menu->AddItem('میزکار', UR_MP, 0, 'fa-dashboard');

        $index = $side_menu->AddItem('یادداشت ها', '#', 0, 'fa-bullhorn');
        $side_menu->AddItem('فهرست یادداشت ها', UR_MP .
                'Topic', $index);
        $side_menu->AddItem('یادداشت جدید', UR_MP .
                'Topic/NewTopic', $index);

        $index = $side_menu->AddItem('دسته ها', '#', 0, 'fa-book');
        $side_menu->AddItem('فهرست کلاسیک دسته ها', UR_MP .
                'Category', $index);
        $side_menu->AddItem(' فهرست حرفه ای دسته ها', UR_MP .
                'Category/Pro', $index);
        $side_menu->AddItem('فهرست سایت', UR_MP .
                'DropDownMenu', 0, 'fa-ellipsis-h');
        $side_menu->AddItem(' تنظیمات سایت', UR_MP .
                'Index/Setting', 0, 'fa-cogs');
        $side_menu->AddItem(' جملات انگیزشی', UR_MP .
                'Index/Sentence', 0, 'fa-star');
        $side_menu->AddItem(' دیدگاه', UR_MP .
                'Comment', 0, 'fa-comments'); 
//        $side_menu->AddItem(' برنامه فردی', UR_MP .
//                'Req', 0, 'fa-comments');

        $index = $side_menu->AddItem('مدیران ', '#', 0, 'fa-user');
        $side_menu->AddItem('فهرست  مدیران', UR_MP .
                'Manager', $index);
        $side_menu->AddItem(' ثبت مدیر جدید', UR_MP .
                'Manager/NewManager', $index);
        $index = $side_menu->AddItem('اعضا ', '#', 0, 'fa-group');
        
        $side_menu->AddItem('فهرست  اعضا', UR_MP .
                'Member', $index);
        $side_menu->AddItem(' ثبت عضو جدید', UR_MP .
                'Member/NewMember', $index);
        $side_menu->AddItem('   جستجوی اعضا', UR_MP .
                'Member/Search', $index);

        $side_menu->AddItem('خروج', UR_MP . 'Access/Logout', 0, 'fa-user');

        echo $side_menu->Render('nav-accordion', 'sidebar-menu animate-fast');
        ?>
        <!-- sidebar menu end-->
    </ul>
</section>