<!-- JS -->
<script type="text/javascript" src="js/different.js"></script>

<script>
    // Update unreaded messages
    $(document).ready(function() {
        setInterval(function() {
            // Messages
            $("#update_messeges_unreded").load(" #update_messeges_unreded");
            // Notifications
            $("#update_notif_unreded").load(" #update_notif_unreded");
        },5000)
    });

    // Textarea
    let textarea = document.querySelectorAll('textarea');

    textarea[0].addEventListener('keydown', expandTextarea);
    textarea[1].addEventListener('keydown', expandTextarea);
                    
    function expandTextarea() {
        let element = this;
        setTimeout(function(){
        element.style.cssText = 'height: auto; padding: 0';
        element.style.cssText = 'height:' + element.scrollHeight + 'px';
        }, 0);
    }
</script>