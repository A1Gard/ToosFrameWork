<?php ?>


<br />
<h2 class="rtl">
    <?= $this->title ?>
</h2>
<br />
<br />
<div class="row">
    <div class="grd-primary">
        <label>
            <select name="mode" id="mode">
                <option value="0"> <?= _lg('name') ?> </option>
                <option value="1"> <?= _lg('tel') ?> </option>
                <option value="2"> <?= _lg('email') ?> </option>

            </select>
        </label>
        <label>
            جستجو:
            <input type="text" maxlength="30" class="autocomplete" />
        </label>
    </div>
    <div class="grd-secondary">

    </div>

    <script type="text/javascript">
        $(".autocomplete").autocomplete({
            source: function (request, response) {

               
                $.ajax({
                    url: "<?= UR_CM ?>Search/AjaxSearchAll",
                    dataType: "json",
                    data: {
                        q: request.term,
                        mode: <?= SEARCH_MODE_MEMEBER ?>,
                        field: $('#mode').val()
                    },
                    success: function (data) {
                        response(data);
                    },
                });
            },
            minLength: 2,
            select: function (event, ui) {
                window.location = "<?= UR_CM ?>Member/Edit/"+ui.item.id;
            },
        });
    </script>
</div>

