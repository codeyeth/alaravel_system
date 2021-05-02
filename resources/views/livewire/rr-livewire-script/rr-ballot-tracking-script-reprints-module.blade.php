<script>
    window.addEventListener('addToBatchList', event => {
        $('#addToBatchBtn_' + event.detail.btnID ).attr('disabled', true);
    })
    
    window.addEventListener('removeFromBatchList', event => {
        $('#addToBatchBtn_' + event.detail.btnID ).removeAttr('disabled', true);
    })
</script>