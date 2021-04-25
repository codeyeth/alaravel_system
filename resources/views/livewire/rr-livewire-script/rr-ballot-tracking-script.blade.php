<script>
    Livewire.on('scrollToTop', logsCount => {
        var liCount = logsCount;
        var elmnt = document.getElementById("li_" + liCount);
        elmnt.scrollIntoView();
    })
</script>