<section id="sidebar">

    <ul id="nav-accordion" class="sidebar-menu" >
        <!-- sidebar menu start-->
        <?php
        
        global $side_menu;
        echo $side_menu->Render('nav-accordion', 'sidebar-menu animate-fast');
        ?>
        <!-- sidebar menu end-->
    </ul>
</section>