    
        </div>
    </div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!--Datatables-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/b-1.6.5/b-html5-1.6.5/sb-1.0.1/sp-1.2.2/datatables.min.js"></script>
    <!--TOOGLE BUTTON-->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });

        });
    </script>
    <!--Datatables-->
    <script>
    $(document).ready( function () {
      $('#myTable').DataTable();
    } );
  </script>

    <script>
    $(document).ready( function () {
      var table = $('#Att').DataTable( {
        pageLength : 5,
        searching : false,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
      } )
    } );    
    </script>

    
    <script>
    $(document).ready(function() {
      var table = $('#log').DataTable( {
        "order": [[ 0, "desc" ]]
      } )
    } );    
    </script>


    <!--AOS-->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <!-- Custom JS-->
  <script src="<?php echo base_url('assets/js/style.js') ?>"></script>

  <!--CKEditor-->
  
<script>
    CKEDITOR.replace( 'remark' );
</script>

  
  
</body>

</html>