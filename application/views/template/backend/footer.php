
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?= base_url();?>assets/js/bootstrap.js"></script>

    <!-- select2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
    <script>
      $(document).ready(function() {
          $('.select2').select2();
      });
      
      var ckeditor = CKEDITOR.replace('ckeditor');
      ckeditor.on('required', function(evt) {
          editor.showNotification('This field is required.', 'warning');
          evt.cancel();
      });
    </script>
  </body>
</html>
