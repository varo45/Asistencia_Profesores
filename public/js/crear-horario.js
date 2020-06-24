<script>
    $('.clase').hide();
    $('.guardia').hide();
    $('.sel').on('change', function() {
        id=$(this).parent().attr('id');
        if($(this).val() == 'clase')
        {
            $('#'+id+' .guardia').hide(),
            $('#'+id+' .clase').fadeIn()
        }
        if($(this).val() == 'guardia')
        {
            $('#'+id+' .clase').hide(),
            $('#'+id+' .guardia').fadeIn()
        }
        if($(this).val() == 'libre')
        {
            $('#'+id+' .clase').hide(),
            $('#'+id+' .guardia').hide()
        }
    });
</script>