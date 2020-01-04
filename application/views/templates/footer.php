      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; HERO 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

      </div>
      <!-- End of Page Wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
      </a>

      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Cancel Plan Modal-->
      <div class="modal fade" id="cancelPlanModal" tabindex="-1" role="dialog" aria-labelledby="cancelPlanModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="cancelPlanModalLabel">Are you sure?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">You are about to cancel this plan. All the deposits you made on this plan will be categorized as "others".</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-danger" href="<?php echo base_url('wishlist/cancel_plan/' . $list_details['list_id']); ?>">OK</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Bootstrap core JavaScript-->
      <script src="<?php echo base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
      <script src="<?php echo base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- Core plugin JavaScript-->
      <script src="<?php echo base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

      <!-- Custom scripts for all pages-->
      <script src="<?php echo base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

      <!-- date picker -->
      <script src="<?php echo base_url('assets/'); ?>vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

      <!-- currency formatter -->
      <script src="<?php echo base_url('assets/'); ?>js/pcsFormatNumber.jquery.js"></script>

      <script>
        $('.custom-file-input').on('change', function() {
          let fileName = $(this).val().split('\\').pop();
          $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        $('#goal_date').datepicker({
          format: 'yyyy-mm-dd',
          startDate: '+1d'
        });

        $('#est_cost').pcsFormatNumber({
          decimal_separator: ".",
          currency: "Rp."
        });

        $('#save_flexible_amount').pcsFormatNumber({
          decimal_separator: ".",
          currency: "Rp."
        });
      </script>

      </body>

      </html>