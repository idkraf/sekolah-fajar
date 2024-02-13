<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
    </h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i></a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-6">
       <div class="card card-info">
        <div class="card-header with-border">
          <h3 class="card-title">Informasi</h3>

          <!--div class="card-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div-->
        </div>
        <!-- /.box-header -->
        <div class="card-body">

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
                    <div class="container"> 
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
      
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="card radius-10 overflow-hidden">
            <div class="card-body info-box-content">
                <div class="text-white font-35"><i class="fa fa-3x fa-dollar icon"></i></div>
                <h3><?php echo 'Rp. ' . number_format($total_bulan, 0, ',', '.') ?></h3>
                <p>Sisa Tagihan Bulanan</p>
                <span class="info-box-number" style="opacity: 0;">kosong</span>
            </div>
        </div>
      </div>
      
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="card radius-10 overflow-hidden">
            <div class="card-body info-box-content">
                <div class="text-white font-35"><i class="fa fa-3x fa-dollar icon"></i></div>
                <!--span class="info-box-icon"><i class="fa fa-money icon"></i></span-->
                <h3><?php echo 'Rp. ' . number_format($total_bebas-$total_bebas_pay, 0, ',', '.') ?></h3>
                <p>Sisa Tagihan Lainnya</p>
                <span class="info-box-number" style="opacity: 0;">kosong</span>
           
            </div>
        </div>
      </div>
      
      
    </div>
    <div style="margin-bottom: 50px;"></div>

  </section>
  <!-- /.content -->
</div>