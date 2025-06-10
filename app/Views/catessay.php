<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<style media="screen">
.nomor {
  width: 47px;
  margin-right: 6px;
  margin-bottom: 5px;
}
</style>
<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?= base_url()?>xassets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="https://www.freepnglogos.com/uploads/logo-depag-png/file-kementerian-agama-logo-wikimedia-commons-1.png" alt="" height="21">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?= base_url()?>xassets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= base_url()?>xassets/images/logo-light.png" alt="" height="21">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>

            </div>

            <div id="scrollbar" class="p-3">
              <h4>NOMOR SOAL</h4>
              <?php
              $n = 1;
              foreach ($soals as $soal){?>
                <button type="button" class="nomor btn <?= ($soal['jawaban_peserta'] <> '' || $soal['jawaban_peserta'] <> null)? 'btn-success':'btn-danger';?> btn-page" id="btn<?= $n;?>" onclick="loadsoal(<?= $n;?>);"><?= $n;?></button>
                <?php $n++;} ?>
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="card card-body">
                          <div class="row">
                            <div class="col">
                              <span id="ujian_ket"><strong><?= $ujian->ket?></strong></span>
                              <br>
                              <span id="kategori"><strong></strong></span>
                            </div>
                          </div>
                          <br>
                            <div class="row">
                              <div class="col">
                                Batas Waktu<br>
                                <span id="clock" class="text-primary"></span>
                              </div>
                              <div class="col">
                                Jumlah Soal<br>
                                <span id="jumlahsoal"><?= count($soals)?></span>
                              </div>
                              <div class="col">
                                Soal Dijawab<br>
                                <span class="soal_terjawab text-bold"></span>
                              </div>
                              <!-- <div class="col">
                                Belum Dijawab<br>
                                <span class="belum_terjawab"></span>
                              </div> -->
                              <div class="col">
                                <a href="<?= site_url('catess/selesai');?>" onclick="return confirm('Apakah Anda yakin ingin mengakhiri ujian?')" class="btn btn-danger"><i class="fa fa-sign-out"></i> Selesai ujian?</a>
                              </div>
                            </div>
                          </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0" id="soalno">...</h4>
                                    <h6 class="card-title mb-0" id="kompetensi">...</h6>
                                    <br>
                                    <p class="card-title mb-0" id="pertanyaan">...</p>
                                    <input type="hidden" name="soal_id" id="soal_id">
                                </div><!-- end card header -->

                                <div class="card-body">
                                  <div class="pilihan">
                                    <form class="" action="index.html" method="post">
                                      <input type="hidden" name="soal_id" id="soal_id">
                                      <input type="hidden" name="nourut" id="nourut">
                                      <textarea class="form-control" id="jawaban" name="jawaban" rows="10"></textarea>
                                    </form>
                                  </div>
                                    <!-- end table responsive -->
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        <!-- end col -->
                    </div>
                    <div class="soalstart">
                      <button type="button" class="btn btn-primary btn-label right ms-auto save"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Simpan dan Lanjutkan</button>
        							<button type="button" class="btn btn-success btn-label right ms-auto" onclick="javascript:soalnext();"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Lewati Soal Ini</button>
        						</div>
        						<div class="soalfinish" style="display: none;">
                      <button type="button" class="btn btn-primary btn-label right ms-auto save">Simpan</button>
        						</div>

                    </div>
                </div>
                <!-- container-fluid -->
        </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © CAT Uji Kompetensi.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Biro Sumber Daya Manusia
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <script src="<?= base_url()?>xassets/js/jquery.countdown.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment-with-locales.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.46/moment-timezone-with-data-1970-2030.js"></script>

        <script type="text/javascript">
        	jQuery(document).ready(function($) {
        		$('.soal_terjawab').html('<?= $jumlah;?>');
            //moment.tz.setDefault("Asia/Jakarta");
            var finishTime = moment.tz("<?= $log->finish_time?>","Asia/Jakarta");

        		$('#clock').countdown(finishTime.toDate(), function(event) {
        		  $(this).html(event.strftime('%H:%M:%S'));
        		});
        		// $('#clock').countdown('<?= $log->finish_time;?>', function(event) {
        		//   $(this).html(event.strftime('%H:%M:%S'));
        		// });
            // $('.ujian_ket').html('<?= $ujian->ket;?>');
        		//console.log(jsonObj[0]['pertanyaan']);
        		loadsoal(1);
            // $("#paging").niceScroll({cursorcolor:"#b3b3b3",autohidemode:false});

        		$('.save').on('click', function(event) {
        			var jawaban = $('#jawaban').val();
        			var soal_id = $('#soal_id').val();
        			var nourut = $('#nourut').val();
              var soal_terjawab = parseInt($('.soal_terjawab').html())+1;
              
        			$.post( "<?= site_url('catess/save');?>",
        				{ soal_id: soal_id, jawaban_peserta: jawaban }
        			).done(function( data ) {
        				if(data == 0){
        					alert('Maaf, waktu telah berakhir. Anda tidak bisa menyimpan jawaban.');
        					$(window.location).attr('href', '');
        				}
        				if(jawaban != '' && jawaban != null){
        					jsonObj[nourut]['j'] = jawaban;

        					$('#btn'+(parseInt(nourut)+1)).removeClass('btn-danger');
        					$('#btn'+(parseInt(nourut)+1)).addClass('btn-success');
                  $('.soal_terjawab').html(soal_terjawab);
        					loadsoal(parseInt(nourut)+2);
        				}else{
        					alert('Silahkan isi jawaban');
        				}
        		  });

        		});
        	});

        	function soalnext() {
        		var nourut = $('#nourut').val();
        		loadsoal(parseInt(nourut)+2);
        	}

        	function loadsoal(no) {
        		var number = parseInt(no)-1;
        		if(no < <?= count($soals)?>){
        			$('.soalfinish').css('display', 'none');
        			$('.soalstart').css('display', '');
        		}else if(no > <?= count($soals)?>){
        			var number = 0;
        			var no = 1;
        			$('.soalfinish').css('display', 'none');
        			$('.soalstart').css('display', '');
        		}else{
        			$('.soalstart').css('display', 'none');
        			$('.soalfinish').css('display', '');
        		}
        		$('.btn-page').removeClass('active');
        		$('#btn'+no).addClass('active');
        		$('#soalno').html('<h4>Soal No. '+no+'</h4>');
        		$('#soal_id').val(jsonObj[number]['id']);
        		$('#nourut').val(number);
            $('#kompetensi').html('Kompetensi Dasar : '+jsonObj[number]['kompetensi_dasar']);
        		$('#pertanyaan').html(jsonObj[number]['pertanyaan']);
            $('#jawaban').val(jsonObj[number]['j']);  

            const spanKategori = document.getElementById("kategori");
            spanKategori.innerText = jsonObj[number]['category_name'];
            console.log(jsonObj);
        	}

        	function savejawaban() {

        	}

        	jsonObj = [];
        	<?php
        	foreach ($soals as $soal) {
        		$pertanyaan = str_replace('\u0000', '', json_encode($soal['pertanyaan']));
            $pertanyaan = str_replace('\n', '<br>', json_encode($soal['pertanyaan']));
        	?>
        	item = {}
        	item ["id"] = '<?= $soal['id'];?>';
          item ["kompetensi_dasar"] = '<?= $soal['kompetensi_dasar'];?>';
        	item ["pertanyaan"] = "<?= str_replace('"','',$pertanyaan);?>";
          if (<?= json_encode($soal['jawaban_peserta']);?> != null) {
          	item ["j"] = '<?= json_encode($soal['jawaban_peserta']);?>';
          }
        	item ["category_id"] = '<?= $soal['category_id'];?>';
          item ["category_name"] = '<?= $soal['category_name'];?>';

        	jsonObj.push(item);
        	<?php
        	}
        	?>
        	//console.log(jsonObj[0]);
        </script>
<?= $this->endSection() ?>
