<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua-gradient">
                    <span class="info-box-icon"><i class="fa fa-calculator icon" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><strong>Penerimaan KAS</strong></span>
                        <span class="info-box-number" style="opacity: 0;"><?php echo 'Rp. ' . number_format($total_kredit, 0, ',', '.') ?></span>

                        <span class="info-box-text dash-text">Hari ini</span>
                        <span class="info-box-number"><?php echo 'Rp. ' . number_format($total_kredit_hr, 0, ',', '.') ?></span>
          
                        <span class="info-box-text dash-text">Bulan ini</span>
                        <span class="info-box-number"><?php echo 'Rp. ' . number_format($total_kredit, 0, ',', '.') ?></span>
                        <span class="info-box-text dash-text">Tahun ini</span>                        
                        <?php
                        $totalAll = $total_kredit;//$total_bulan+$total_bebas+$total_debit;
                        ?>
                        <span class="info-box-number"><?php echo 'Rp. ' . number_format($totalAll,0, ',', '.') ?></span>
                    </div>
                </div>
                <!-- <div class="mini-box">
          <a href="#">More Info  <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
        </div> -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red-gradient">
                    <span class="info-box-icon"><i class="fa fa-money icon"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><strong>Pengeluaran KAS</strong></span>
                        <span class="info-box-number" style="opacity: 0;"><?php echo 'Rp. ' . number_format($total_debit, 0, ',', '.') ?></span>

                        <span class="info-box-text dash-text">Hari ini</span>
                        <span class="info-box-number"><?php echo 'Rp. ' . number_format($total_kredit, 0, ',', '.') ?></span>
                        <span class="info-box-text dash-text">Bulan ini</span>
                        <span class="info-box-number">Rp. 0</span>
                        <span class="info-box-text dash-text">Tahun ini</span>
                        <span class="info-box-number">Rp. 0</span>
                    </div>
                </div>
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green-gradient">
                    <span class="info-box-icon"><i class="fa fa-bank icon"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><strong>Pembayaran Siswa</strong></span>
                        <span class="info-box-number" style="opacity: 0;">kosong</span>
                        <span class="info-box-text dash-text">Hari ini</span>
                        <span class="info-box-number">Rp. 0</span>
                        <span class="info-box-text dash-text">Bulan ini</span>
                        <span class="info-box-number"><?php echo 'Rp. ' . number_format($total_bulan, 0, ',', '.') ?></span>
                        <span class="info-box-text dash-text">Tahun ini</span>
                        <span class="info-box-number">Rp. 0</span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-yellow-gradient">
                    <span class="info-box-icon"><i class="fa fa-credit-card icon"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><strong>Tabungan Siswa</strong></span>
                        <span class="info-box-number" style="opacity: 0;">kosong</span>
                        <span class="info-box-text dash-text">Hari ini</span>
                        <span class="info-box-number">Rp. 0</span>
                        <span class="info-box-text dash-text">Bulan ini</span>
                        <span class="info-box-number">Rp. 0</span>
                        <span class="info-box-text dash-text">Tahun ini</span>
                        <span class="info-box-number">Rp. 0</span>
                    </div>
                </div>
            </div>
    </div>


    <div class="row">
      <div class="col-md-6">
       <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><strong>Papan Informasi</strong> </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <!-- Indicators --> 
              <ol class="carousel-indicators ind"> 
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li> 
                <li data-target="#carousel-example-generic" data-slide-to="1"></li> 
                <li data-target="#carousel-example-generic" data-slide-to="2"></li> 
              </ol> 
              <!-- Wrapper for slides --> 
              <div class="carousel-inner"> 
                <?php
                $i = 1;
                foreach ($information as $row):
                  ?>
                  <div class="item <?php echo ($i == 1) ? 'active' : ''; ?>"> 
                    <div class="row"> 
                        <div class="adjust1"> 
                            <div class="caption"> 
                              <p class="text-info lead adjust2"><?php echo $row['information_title'] ?></p>  
                              <blockquote class="adjust2"> <p><?php echo strip_tags(character_limiter($row['information_desc'], 250)) ?></p> 
                              </blockquote> 
                          </div> 
                        </div> 
                    </div> 
                  </div> 
                  <?php
                  $i++;
                endforeach;
                ?>
              </div> <!-- Controls --> 
              <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> 
                <span class="glyphicon glyphicon-chevron-left" style="font-size:20px"></span> </a> 
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"> 
                  <span class="glyphicon glyphicon-chevron-right" style="font-size:20px"></span> 
                </a> 
              </div> 
            </div>

        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->

      <div class="col-md-6">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Kalender</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">

            <div id="calendar"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- row -->



  </section>
  <!-- /.content -->
</div>

<div class="modal fade in" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <?php echo form_open(current_url()); ?>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addModalLabel">Tambah Agenda</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="add" value="1">
        <label>Tanggal*</label>
        <p id="labelDate"></p>
        <input type="hidden" name="date" class="form-control" id="inputDate">
        <label >Keterangan*</label>
        <textarea name="info" id="inputDesc" class="form-control"></textarea><br />
      </div>
      <div class="modal-footer">
        <button type="submit" id="btnSimpan" class="btn btn-success">Simpan</button>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>

<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <?php echo form_open(current_url()); ?>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="delModalLabel">Hapus Hari Libur</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="del" value="1">
        <input type="hidden" name="id" id="idDel">
        <label>Tahun</label>
        <p id="showYear"></p>
        <label>Tanggal</label>
        <p id="showDate"></p>
        <label >Keterangan*</label>
        <p id="showDesc"></p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Hapus</button>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>

<script type="text/javascript">
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'prevYear,nextYear',
    },
    
    events: "<?php echo site_url('manage/dashboard/get');?>",

    dayClick: function(date, jsEvent, view) {

      var tanggal = date.getDate();
      var bulan = date.getMonth()+1;
      var tahun = date.getFullYear();
      var fullDate = tahun + '-' + bulan + '-' + tanggal;

      $('#addModal').modal('toggle');
      $('#addModal').modal('show');

      $("#inputDate").val(fullDate);
      $("#labelDate").text(fullDate);
      $("#inputYear").val(date.getFullYear());
      $("#labelYear").text(date.getFullYear());
    },

    eventClick: function(calEvent, jsEvent, view) {
      $("#delModal").modal('toggle');
      $("#delModal").modal('show');
      $("#idDel").val(calEvent.id);
      $("#showYear").text(calEvent.year);

      var tgl = calEvent.start.getDate();
      var bln = calEvent.start.getMonth()+1;
      var thn = calEvent.start.getFullYear();

      $("#showDate").text(tgl+'-'+bln+'-'+thn);
      $("#showDesc").text(calEvent.title);
    }


  });

  $("#inputDesc").on('change keyup focus input propertychange', function(){
    var desc = $("#inputDesc").val();
    if (desc.trim().length > 0) {
      $("#btnSimpan").removeClass('disabled');
    }else{
      $("#btnSimpan").addClass('disabled');
    }
  })

  $("#closeModal").click(function(){
    $("#inputDesc").val('');
    $("#btnSimpan").addClass('disabled');
  });

</script>  