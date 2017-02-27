</body>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<!--Loader script start-->
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(255, 255, 255, .8) url('FhHRx.gif') 50% 50% no-repeat;
    }

    /* When the body has the loading class, we turn
       the scrollbar off with overflow:hidden */
    body.loading {
        overflow: hidden;
    }

    /* Anytime the body has the loading class, our
       modal element will be visible */
    body.loading .modal {
        display: block;
    }
</style>
<script>
    $body = $("body");

    $(window).on({
        //console.log('load');
        beforeunload: function () {
            $body.addClass("loading");
        },
        unload: function () {
            $body.addClass("loading");
        },
        //load:function(){$body.addClass("loading");}
    });

    $(document).on({
        ajaxStart: function () {
            $body.addClass("loading");
        },
        ajaxStop: function () {
            $body.removeClass("loading");
        },
        ready: function () {
            $body.removeClass("loading");
        }
    });

    //$body.removeClass("loading");

</script>
<!--Loader script end-->
<div class="modal"><!-- Place at bottom of page --></div>
</html>