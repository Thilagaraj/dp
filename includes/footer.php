

  <!-- Footer -->
  <footer class="site-footer">
    <span class="site-footer-legal">&copy; 2017 <a href="http://dharaniprinters.com/">DHARANI PRINTERS</a></span>
    <div class="site-footer-right">
      Powered by <a href="http://dharaniprinters.com/">DHARANI PRINTERS</a>
    </div>
  </footer>
<div class="slidePanel-loading slidePanel-loading-show loader-loading" style="display:none;bottom:0;position:fixed;background:rgba(255,255,255,0.8);z-index:1000000;"><div class="loader loader-default"></div></div>
  <!-- Core  -->
  <script src="assets/vendor/bootstrap/bootstrap.js"></script>
  <script src="assets/vendor/animsition/jquery.animsition.js"></script>
  <script src="assets/vendor/asscroll/jquery-asScroll.js"></script>
  <script src="assets/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="assets/vendor/asscrollable/jquery.asScrollable.all.js"></script>
  <script src="assets/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
  <script src="assets/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>

  <!-- Plugins -->
  <script src="assets/vendor/switchery/switchery.min.js"></script>
  <script src="assets/vendor/intro-js/intro.js"></script>
  <script src="assets/vendor/screenfull/screenfull.js"></script>
  <script src="assets/vendor/slidepanel/jquery-slidePanel.js"></script>
  <script src="assets/vendor/select2/select2.js"></script>

  <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/datatables-fixedheader/dataTables.fixedHeader.js"></script>
  <script src="assets/vendor/datatables-bootstrap/dataTables.bootstrap.js"></script>
  <script src="assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
  <script src="assets/vendor/datatables-tabletools/dataTables.tableTools.js"></script>
  <script src="assets/vendor/formvalidation/formValidation.min.js"></script>
  <script src="assets/vendor/formvalidation/framework/bootstrap.min.js"></script> 
  <!-- Scripts -->
  <script src="assets/js/core.js"></script>
  <script src="assets/js/site.js"></script>

  <script src="assets/js/sections/menu.js"></script>
  <script src="assets/js/sections/menubar.js"></script>
  <script src="assets/js/sections/sidebar.js"></script>

  <script src="assets/js/configs/config-colors.js"></script>
  <script src="assets/js/configs/config-tour.js"></script>

  <script src="assets/js/components/select2.js"></script>
  <script src="assets/js/components/asscrollable.js"></script>
  <script src="assets/js/components/animsition.js"></script>
  <script src="assets/js/components/slidepanel.js"></script>
  <script src="assets/js/components/switchery.js"></script>
  <script src="assets/js/components/datatables.js"></script>
  <script src="assets/js/components/bootstrap-datepicker.js"></script>
 
  <script>
    (function(document, window, $) {
      'use strict';

      var Site = window.Site;

      $(document).ready(function($) {
        Site.run();
		$(document).on('click','[data-loading]',function(){
			$('.loader-loading').show();			
		});
      });
	 <?php
		$colData=["order_name","order_phone","order_email","order_address","order_product","order_product_information","order_date","order_delivery_date","order_quantity","order_amount","order_location","order_status"];
		$CFcolData=["field_name","field_label","field_type","field_desc","field_status","'option_value[]'"];
		$PrdcolData=["product_name","product_description","'product_fields[]'","product_status"];
		
		if($page=='custom-field-entry')
			$colData=$CFcolData;
		if($page=='product-entry')
			$colData=$CFcolData;
	 ?>
	<?php if($page=='order-entry' || $page=='custom-field-entry' || $page=='product-entry'):?>
		(function() {
        $('#orderform').formValidation({
          framework: "bootstrap",
          icon: null,
          fields: {
			  <?php foreach( $colData as $col):?>
			  <?php echo $col;$cn=ucwords(str_replace(array('order_','_','[]',"'","'"),array('','','','',''),$col))?>: {
              validators: {
                notEmpty: {
                  message: '<?php echo $cn;?> is required'
                },               
              }
            },
			<?php endforeach;?>
			 
			
		}
        });
      })();
	<?php endif;?>
	
      $('[data-selected]').each(function(){
		  $(this).val($(this).data('selected'));
	  })
    })(document, window, jQuery);
  </script>

</body>

</html>