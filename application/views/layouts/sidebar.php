<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">FINANCIAL MANAGEMENT</li>
      <ul class="timeline">
        <!-- <li class="container time-label">
            <span class="bg-blue">
              Intro
            </span>
        </li> -->
        <li>
          <?php
            if ($this->uri->segment(1) == 'intro') {
              echo "<i class='fa fa-circle-o bg-black'></i>";
            }else{
              echo "<i class='fa fa-check-circle-o bg-black'></i>";
            }
          ?>
          <!-- <i class="fa fa-circle-o bg-blue"></i> -->
          <div class="timeline-item <?php if($this->uri->segment(1) == 'intro') { echo 'active open'; } ?>">
            <h3 class="timeline-header">Intro</h3>
          </div>
        </li>
        <li>
          <?php
            $step1 = $this->db->query("SELECT COUNT(*) as cek FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
            foreach ($step1->result() as $obj) {
              $stepsatu = $obj->cek;
            }
            if($stepsatu==1){           
              echo "<i class='fa fa-check-circle-o bg-black'></i>";
            }else{
              echo "<i class='fa fa-circle-o bg-black'></i>";
            }
          ?>
          <!-- <i class="fa fa-circle-o bg-blue"></i> -->
          <div class="timeline-item <?php if($this->uri->segment(1) == 'stepone') { echo 'active open'; } ?>">
            <h3 class="timeline-header">Step 1</h3>
          </div>
        </li>
        <li>
          <?php
            $step2 = $this->db->query("SELECT COUNT(*) as cek FROM piutang WHERE jenis_piutang = 'usaha' AND iduser = ".$this->session->userdata('id')."");
            foreach ($step2->result() as $obj) {
              $stepdua = $obj->cek;
            }
            if($stepdua>=1){           
              echo "<i class='fa fa-check-circle-o bg-black'></i>";
            }else{
              echo "<i class='fa fa-circle-o bg-black'></i>";
            }
          ?>
          <!-- <i class="fa fa-circle-o bg-blue"></i> -->
          <div class="timeline-item <?php if($this->uri->segment(1) == 'steptwo') { echo 'active open'; } ?>">
            <h3 class="timeline-header">Step 2</h3>
          </div>
        </li>
        <li>
          <?php
            $step3 = $this->db->query("SELECT COUNT(*) as cek FROM piutang WHERE jenis_piutang = 'lainnya' AND iduser = ".$this->session->userdata('id')."");
            foreach ($step3->result() as $obj) {
              $steptiga = $obj->cek;
            }
            if($steptiga>=1){           
              echo "<i class='fa fa-check-circle-o bg-black'></i>";
            }else{
              echo "<i class='fa fa-circle-o bg-black'></i>";
            }
          ?>
          <!-- <i class="fa fa-circle-o bg-blue"></i> -->
          <div class="timeline-item <?php if($this->uri->segment(1) == 'stepthree') { echo 'active open'; } ?>">
            <h3 class="timeline-header">Step 3</h3>
          </div>
        </li>
        <li>
          <?php
            $step4 = $this->db->query("SELECT COUNT(*) as cek FROM barang_dagangan WHERE iduser = ".$this->session->userdata('id')."");
            foreach ($step4->result() as $obj) {
              $stepempat = $obj->cek;
            }
            if($stepempat>=1){           
              echo "<i class='fa fa-check-circle-o bg-black'></i>";
            }else{
              echo "<i class='fa fa-circle-o bg-black'></i>";
            }
          ?>
          <!-- <i class="fa fa-circle-o bg-blue"></i> -->
          <div class="timeline-item <?php if($this->uri->segment(1) == 'stepfour') { echo 'active open'; } ?>">
            <h3 class="timeline-header">Step 4</h3>
          </div>
        </li>
        <li>
          <?php
            $step5 = $this->db->query("SELECT COUNT(*) as cek FROM barang_lainnya WHERE iduser = ".$this->session->userdata('id')."");
            foreach ($step5->result() as $obj) {
              $steplima = $obj->cek;
            }
            if($steplima>=1){           
              echo "<i class='fa fa-check-circle-o bg-black'></i>";
            }else{
              echo "<i class='fa fa-circle-o bg-black'></i>";
            }
          ?>
          <div class="timeline-item <?php if($this->uri->segment(1) == 'stepfive') { echo 'active open'; } ?>">
            <h3 class="timeline-header">Step 5</h3>
          </div>
        </li>
        <li>
          <?php
            $step6 = $this->db->query("SELECT COUNT(*) as cek FROM activa_tetap WHERE iduser = ".$this->session->userdata('id')."");
            foreach ($step6->result() as $obj) {
              $stepenam = $obj->cek;
            }
            if($stepenam>=1){           
              echo "<i class='fa fa-check-circle-o bg-black'></i>";
            }else{
              echo "<i class='fa fa-circle-o bg-black'></i>";
            }
          ?>
          <div class="timeline-item <?php if($this->uri->segment(1) == 'stepsix') { echo 'active open'; } ?>">
            <h3 class="timeline-header">Step 6</h3>
          </div>
        </li>
        <li>
          <?php
            $step7 = $this->db->query("SELECT COUNT(*) as cek FROM activa_lainnya WHERE iduser = ".$this->session->userdata('id')."");
            foreach ($step7->result() as $obj) {
              $steptujuh = $obj->cek;
            }
            if($steptujuh>=1){           
              echo "<i class='fa fa-check-circle-o bg-black'></i>";
            }else{
              echo "<i class='fa fa-circle-o bg-black'></i>";
            }
          ?>
          <!-- <i class="fa fa-circle-o bg-black"></i> -->
          <div class="timeline-item <?php if($this->uri->segment(1) == 'stepseven') { echo 'active open'; } ?>">
            <h3 class="timeline-header">Step 7</h3>
          </div>
        </li>
        <li>
          <?php
            $step8 = $this->db->query("SELECT COUNT(*) as cek FROM hutang WHERE jenis_hutang = 'usaha' AND iduser = ".$this->session->userdata('id')."");
            foreach ($step8->result() as $obj) {
              $stepdelapan = $obj->cek;
            }
            if($stepdelapan>=1){           
              echo "<i class='fa fa-check-circle-o bg-black'></i>";
            }else{
              echo "<i class='fa fa-circle-o bg-black'></i>";
            }
          ?>
          <!-- <i class="fa fa-circle-o bg-black"></i> -->
          <div class="timeline-item <?php if($this->uri->segment(1) == 'stepeight') { echo 'active open'; } ?>">
            <h3 class="timeline-header">Step 8</h3>
          </div>
        </li>
        <li>
          <?php
            $step9 = $this->db->query("SELECT COUNT(*) as cek FROM hutang WHERE jenis_hutang = 'bank' AND iduser = ".$this->session->userdata('id')."");
            foreach ($step9->result() as $obj) {
              $stepsembilan = $obj->cek;
            }
            if($stepsembilan>=1){           
              echo "<i class='fa fa-check-circle-o bg-black'></i>";
            }else{
              echo "<i class='fa fa-circle-o bg-black'></i>";
            }
          ?>
          <!-- <i class="fa fa-circle-o bg-black"></i> -->
          <div class="timeline-item <?php if($this->uri->segment(1) == 'stepnine') { echo 'active open'; } ?>">
            <h3 class="timeline-header">Step 9</h3>
          </div>
        </li>
        <li>
          <?php
            $step10 = $this->db->query("SELECT COUNT(*) as cek FROM hutang WHERE jenis_hutang = 'lainnya' AND iduser = ".$this->session->userdata('id')."");
            foreach ($step10->result() as $obj) {
              $stepsepuluh = $obj->cek;
            }
            if($stepsepuluh>=1){           
              echo "<i class='fa fa-check-circle-o bg-black'></i>";
            }else{
              echo "<i class='fa fa-circle-o bg-black'></i>";
            }
          ?>
          <!-- <i class="fa fa-circle-o bg-black"></i> -->
          <div class="timeline-item <?php if($this->uri->segment(1) == 'stepten') { echo 'active open'; } ?>">
            <h3 class="timeline-header">Step 10</h3>
          </div>
        </li>
        <li>
          <?php
            $step11 = $this->db->query("SELECT COUNT(modal_disetor) as cek FROM saldo_kas WHERE iduser = ".$this->session->userdata('id')."");
            foreach ($step11->result() as $obj) {
              $stepsebelas = $obj->cek;
            }
            if($stepsebelas==1){           
              echo "<i class='fa fa-check-circle-o bg-black'></i>";
            }else{
              echo "<i class='fa fa-circle-o bg-black'></i>";
            }
          ?>
          <!-- <i class="fa fa-circle-o bg-black"></i> -->
          <div class="timeline-item <?php if($this->uri->segment(1) == 'stepeleven') { echo 'active open'; } ?>">
            <h3 class="timeline-header">Step 11</h3>
          </div>
        </li>
        <li>
          <i class="fa fa-circle-o bg-black"></i>
          <div class="timeline-item <?php if($this->uri->segment(1) == 'stepfinish') { echo 'active open'; } ?>">
            <h3 class="timeline-header">Finish</h3>
          </div>
        </li>
        <!-- <li>
          <i class="fa fa-circle-o bg-blue"></i>
          <div class="timeline-item">
            <h3 class="timeline-header"><a href="#">Step 14</a></h3>
          </div>
        </li>
        <li>
          <i class="fa fa-circle-o bg-blue"></i>
          <div class="timeline-item">
            <h3 class="timeline-header"><a href="#">Step 15</a></h3>
          </div>
        </li> -->
        <!-- <li class="container time-label">
            <span class="bg-blue">
              Finish
            </span>
        </li> -->
      </ul>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>