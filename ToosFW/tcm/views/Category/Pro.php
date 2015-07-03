
<div class="pro-ol rtl"> 

    <form action="<?= UR_CM  ?>Category/Sync" method="post" id="sort_form">

        <?php echo $this->cat->CategoryOL(); ?>

        <input type="hidden" id="sorted" name="sorted" />
        <br />
        <button type="submit" > <?php _lp('Save'); ?> </button>
    </form>

</div>

<script type="text/javascript">


    $(function() {
        
        var group = $(".drg").sortable({
            group: 'serialization',
            delay: 500
        });

        $("#sort_form").bind('submit', function() {

            var data = group.sortable("serialize").get();

            console.log(group);
            var jsonString = JSON.stringify(data, null, ' ');

            $("#sorted").val(jsonString);

            
            window.ret = false;
            
            $.ajax({
                type: 'POST',
                data: $(this).serialize(),
                url: $(this).attr('action'),
                success: function(data) {
                    window.ret = true;

                },
                error: function() {
                    window.ret =  false;
                }
            });

            return window.ret;
        });

    });

</script>