<section id="sidebar">
    <div id="nscroll">

        <!-- sidebar menu start-->
        <?php
        global $side_menu;
        echo $side_menu->Render('nav-accordion', 'sidebar-menu animate-fast');
        ?>
        <!-- sidebar menu end-->
        <div class="text-center margin">

            <div class="ui button inverted" id="toggle-menu">
                <i class="icon resize horizontal"></i>
                <i class="icon list layout"></i>
            </div>
        </div>
    </div>
</section>