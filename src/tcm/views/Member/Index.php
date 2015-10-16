<ul class="listview">
    <li class="pinned animate"> 
        <div  class="row">
            <div class="grd2">ش</div>
            <div class="grd7"> نام</div>
            <div class="grd7"> ایمیل </div>
            <div class="grd2"> نوع </div>
            <div class="grd6">
                عملیات
            </div>
        </div>
    </li>
    <?php foreach ($this->cls_list as $cls):  ?>
    <li> 
        <div  class="row">
            <div class="grd2"><?php echo  $cls['member_id'] ?></div>
            <div class="grd7"><?php echo  $cls['member_name']  ?></div>
            <div class="grd7"><?php echo  $cls['member_email']  ?></div>
            <div class="grd2 text-center"><img src="<?php echo  UR_MP_ASSETS ?>images/user<?php echo  $cls['member_type']  ?>.png" alt="[usr info]" /></div>
            <div class="grd6">
                <a class="button delete" href="<?php echo  UR_MP ?>Member/Delete/<?php echo  $cls['member_id']  ?>"> حذف </a>
                <a class="button" href="<?php echo  UR_MP ?>Member/Edit/<?php echo  $cls['member_id']  ?>"> ویرایش </a>
                <?php if($cls['member_type'] == 0): ?>
                <a class="button" href="<?php echo  UR_MP ?>Member/Type/<?php echo  $cls['member_id']  ?>/1"> تایید </a>
                <?php else: ?>
                <a class="button" href="<?php echo  UR_MP ?>Member/Type/<?php echo  $cls['member_id']  ?>/0"> عدم تایید </a>
                <?php endif; ?>
            </div>
        </div>
    </li>
    <?php endforeach;  ?>
    <?php
        $this->pagination->Render();
    ?>
</ul>

