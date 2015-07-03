<?php // print_r($this->cls_list);die; ?>
<ul class="listview">
    <li class="pinned animate"> 
        <div  class="row">
            <div class="grd2">ش</div>
            <div class="grd7"> کاربر</div>
            <div class="grd7"> عنوان </div>
            <div class="grd2"> وضعیت </div>
            <div class="grd6">
                عملیات
            </div>
        </div>
    </li>
    <?php foreach ($this->cls_list as $cls):  ?>
    <li> 
        <div  class="row">
            <div class="grd2"><?= $cls['req_id'] ?></div>
            <div class="grd7"><?= $cls['member_name']  ?></div>
            <div class="grd7"><?= $cls['req_title']  ?></div>
            <div class="grd2 text-center"><img src="<?= UR_CM_PUB ?>images/user<?= $cls['req_status']  ?>.png" alt="[usr info]" /></div>
            <div class="grd6">
                <a class="button delete" href="<?= UR_CM ?>Req/Delete/<?= $cls['req_id']  ?>"> حذف </a>
                <a class="button" href="<?= UR_CM ?>Req/Edit/<?= $cls['req_id']  ?>"> ویرایش  و  پاسخ </a>
                <?php if($cls['req_status'] == 0): ?>
                <a class="button" href="<?= UR_CM ?>Req/Status/<?= $cls['req_id']  ?>/1"> تایید </a>
                <?php else: ?>
                <a class="button" href="<?= UR_CM ?>Req/Status/<?= $cls['req_id']  ?>/0"> عدم تایید </a>
                <?php endif; ?>
            </div>
        </div>
    </li>
    <?php endforeach;  ?>
    <?php
        $this->pagination->Render();
    ?>
</ul>

