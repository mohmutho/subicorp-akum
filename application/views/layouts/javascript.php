<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.js"></script>
<script src="<?php echo base_url();?>assets/js/app.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/knob/jquery.knob.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/chartjs/Chart.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> -->
<script src="<?php echo base_url();?>assets/js/demo.js"></script>
<!-- CK Editor -->
<!-- <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script> -->

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
    $("#example1").DataTable();
    $("#example2").DataTable();
    $("#example3").DataTable();
    $("#example4").DataTable();
    $("#example5").DataTable();
    $('#datepicker').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    });
    $('#datepicker2').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    });
    $('#datepicker3').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    });
    $('#datepicker4').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    });
    $('#datepicker5').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    });
    $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').focus()
    });
    // CKEDITOR.replace('editor1');
    $("#country").keyup(function () {
      $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>/transaksi_pokok/GetCountryName",
          data: {
              keyword: $("#country").val()
          },
          dataType: "json",
          success: function (data) {
              if (data.length > 0) {
                  $('#DropdownCountry').empty();
                  $('#country').attr("data-toggle", "dropdown");
                  $('#DropdownCountry').dropdown('toggle');
              }
              else if (data.length == 0) {
                  $('#country').attr("data-toggle", "");
              }
              $.each(data, function (key,value) {
                  if (data.length >= 0)
                      $('#DropdownCountry').append('<li role="displayCountries" ><a role="menuitem dropdownCountryli" class="dropdownlivalue">' + value['nama_barang'] + '</a></li>');
              });
          }
      });
    });
    $('ul.txtcountry').on('click', 'li a', function () {
        $('#country').val($(this).text());
    });
    $( function() {
      $( "#nama_barang" ).autocomplete({
          source: "<?php echo site_url('transaksi_pokok/get_barang/?');?>",
          select: function (event, ui) {
              $('[name="idbarang"]').val(ui.item.description); 
          }
        });
    } );
  });
</script>