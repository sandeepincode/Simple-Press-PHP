<?php
/**
 * Created by PhpStorm.
 * User: Junaid
 * Date: 07-Nov-16
 * Time: 7:32 PM
 */
?>

<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
</div>
</div>
</div>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- will add all #wrappers here-->


<!-- Bootstrap Core JavaScript as standard-->
<script src="js/bootstrap.min.js"></script>


<!-- WYSIWYG script -->
<script src="//cdn.ckeditor.com/4.5.10/full/ckeditor.js"></script>

<!-- Gallery Image Viewer Script -->
<link rel="stylesheet" href="fancyBox/source/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="fancyBox/source/jquery.fancybox.pack.js"></script>
<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
<!-- Gallery JS -->
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox();
    });
</script>

</body>

</html>
