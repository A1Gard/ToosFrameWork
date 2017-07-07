
<div class="gray-ol"> 

    <form action="<?php echo UR_MP . CURRENT_EXTENSION ?>/Sync" method="post" id="sort_form">

        <?php echo $this->cat->CategoryOL(); ?>

        <input type="hidden" id="sorted" name="sorted" />
        <br />
        <button type="submit" class="ui button blue" > <?php _lp('Save'); ?> </button>
    </form>

</div>

<script type="text/javascript">


    $(function () {

        var group = $(".drg").sortable({
            group: 'serialization',
            delay: 500
        });
        $("#sort_form").bind('submit', function () {

            var data = group.sortable("serialize").get();

//            console.log(group);
            var jsonString = JSON.stringify(data, null, ' ');

            $("#sorted").val(jsonString);

            window.ret = false;

            $.ajax({
                type: 'POST',
                data: $(this).serialize(),
                url: $(this).attr('action'),
                success: function (e) {
                    if (e.success) {
                        alertify.success(e.value);

                    } else {
                        alertify.error(e.value);
                    }
                }
            });

            return window.ret;
        });

    });

</script>