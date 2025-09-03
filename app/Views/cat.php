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
                <button type="button" class="nomor btn <?= ($soal['jawaban_peserta'] > 0)? 'btn-success':'btn-danger';?> btn-page" id="btn<?= $n;?>" onclick="loadsoal(<?= $n;?>);"><?= $n;?></button>
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
                                <?php 
                                  // Check if using Safe Exam Browser
                                  $isSEB = (strpos($_SERVER['HTTP_USER_AGENT'] ?? '', 'SEB') !== false);
                                  if (!$isSEB) {                
                                ?>
                                    <a href="<?= site_url('cat/selesai');?>" onclick="return confirm('Apakah Anda yakin ingin mengakhiri ujian?')" class="btn btn-danger"><i class="fa fa-sign-out"></i> Selesai ujian?</a>
                                <?php } else { ?>
                                    <div class="mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="confirmCheck" name="confirmCheck" value="1">
                                            <label class="form-check-label" for="confirmCheck">
                                                Saya yakin ingin mengakhiri ujian
                                            </label>
                                        </div>
                                    </div>
                                    <a id="confirmExit" href="<?= site_url('cat/selesai');?>" class="btn btn-danger" style="display: none;"><i class="fa fa-sign-out"></i> Selesai ujian?</a>
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0" id="soalno">...</h4>
                                    <h4 class="card-title mb-0" id="pertanyaan">...</h4>
                                    <input type="hidden" name="soal_id" id="soal_id">
                                </div><!-- end card header -->

                                <div class="card-body">
                                  <div class="pilihan">
                                    <form class="" action="index.html" method="post">
                                    <div class="form-group">
                                      <input type="radio" name="jawaban" id="jawaban1" value="1"> a. <label id="p1" for="jawaban1"></label>
                                    </div>
                                    <div class="form-group">
                                      <input type="radio" name="jawaban" id="jawaban2" value="2"> b. <label id="p2" for="jawaban2"></label>
                                    </div>
                                    <div class="form-group">
                                      <input type="radio" name="jawaban" id="jawaban3" value="3"> c. <label id="p3" for="jawaban3"></label>
                                    </div>
                                    <div class="form-group">
                                      <input type="radio" name="jawaban" id="jawaban4" value="4"> d. <label id="p4" for="jawaban4"></label>
                                    </div>
                                    <div class="form-group">
                                      <input type="radio" name="jawaban" id="jawaban5" value="5"> e. <label id="p5" for="jawaban5"></label>
                                    </div>
                                    <input type="hidden" name="soal_id" id="soal_id">
                                    <input type="hidden" name="nourut" id="nourut">
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
            // Munculkan tautan ketika checkbox diklik
            $('#confirmCheck').on('click', function(event) {
                if ($(this).is(':checked')) {
                    $('#confirmExit').css('display', 'block'); // Menampilkan tautan
                } else {
                    $('#confirmExit').css('display', 'none'); // Menyembunyikan tautan jika tidak dicentang
                }
            });

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
        			var jawaban = $('input[name=jawaban]:checked').val();
        			var soal_id = $('#soal_id').val();
        			var nourut = $('#nourut').val();
        			// if(parseInt($('.soal_terjawab').html()) >= 130){
        			// 	var soal_terjawab = $('.soal_terjawab').html();
        			// }else{
        			// 	var soal_terjawab = parseInt($('.soal_terjawab').html())+1;
        			// }
              //var soal_terjawab = parseInt($('.soal_terjawab').html())+1;
        			//console.log(parseInt($('.soal_terjawab').html()));
              if (jsonObj[nourut]['j'] != null && jsonObj[nourut]['j'] != '') {
                var soal_terjawab = $('.soal_terjawab').html();
              }else{
                var soal_terjawab = parseInt($('.soal_terjawab').html())+1;
              }

        			$.post( "<?= site_url('cat/save');?>",
        				{ soal_id: soal_id, jawaban_peserta: jawaban }
        			).done(function( data ) {
        				if(data == 0){
        					alert('Maaf, waktu telah berakhir. Anda tidak bisa menyimpan jawaban.');
        					$(window.location).attr('href', '');
        				}
        				if(jawaban > 0){

        					jsonObj[nourut]['j'] = jawaban;

        					$('#btn'+(parseInt(nourut)+1)).removeClass('btn-danger');
        					$('#btn'+(parseInt(nourut)+1)).addClass('btn-success');
        					$('.soal_terjawab').html(soal_terjawab);
        					loadsoal(parseInt(nourut)+2);
        				}else{
        					alert('Silahkan pilih jawaban');
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
        		$('#pertanyaan').html(jsonObj[number]['pertanyaan']);
        		$('#p1').html(jsonObj[number]['p1']);
        		$('#p2').html(jsonObj[number]['p2']);
        		$('#p3').html(jsonObj[number]['p3']);
        		$('#p4').html(jsonObj[number]['p4']);
        		$('#p5').html(jsonObj[number]['p5']);
        		if(jsonObj[number]['j'] > 0){
        			$('#jawaban'+jsonObj[number]['j']).prop("checked", true);

        		}else{
        			$('input[name=jawaban]').prop("checked", false);
        		}

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
            $pertanyaan = str_replace('\"', '', $soal['pertanyaan']);
        		$p1 = str_replace('\u0000', '', json_encode($soal['p1']));
            $p1 = str_replace('\n', '<br>', json_encode($soal['p1']));
            $p1 = str_replace('\"', '', $soal['p1']);
        		$p2 = str_replace('\u0000', '', json_encode($soal['p2']));
            $p2 = str_replace('\n', '<br>', json_encode($soal['p2']));
            $p2 = str_replace('\"', '<br>', $soal['p2']);
        		$p3 = str_replace('\u0000', '', json_encode($soal['p3']));
            $p3 = str_replace('\n', '<br>', json_encode($soal['p3']));
            $p3 = str_replace('\"', '<br>', $soal['p3']);
        		$p4 = str_replace('\u0000', '', json_encode($soal['p4']));
            $p4 = str_replace('\n', '<br>', json_encode($soal['p4']));
            $p4 = str_replace('\"', '<br>', $soal['p4']);
        		$p5 = str_replace('\u0000', '', json_encode($soal['p5']));
            $p5 = str_replace('\n', '<br>', json_encode($soal['p5']));
            $p5 = str_replace('\"', '<br>', $soal['p5']);

            if($soal['category_id'] == 13){
        			$p1 = explode('##',$soal['p1'])[0];
        			$p2 = explode('##',$soal['p2'])[0];
        			$p3 = explode('##',$soal['p3'])[0];
        			$p4 = explode('##',$soal['p4'])[0];
        			$p5 = explode('##',$soal['p5'])[0];
        		}
        	?>
        	item = {}
        	item ["id"] = '<?= $soal['id'];?>';
        	item ["pertanyaan"] = "<?= str_replace('"','',$pertanyaan);?>";
        	item ["p1"] = "<?= str_replace('"','&quot;',$p1);?>";
        	item ["p2"] = "<?= str_replace('"','&quot;',$p2);?>";
        	item ["p3"] = "<?= str_replace('"','&quot;',$p3);?>";
        	item ["p4"] = "<?= str_replace('"','&quot;',$p4);?>";
        	item ["p5"] = "<?= str_replace('"','&quot;',$p5);?>";
        	item ["j"] = '<?= $soal['jawaban_peserta'];?>';
        	item ["category_id"] = '<?= $soal['category_id'];?>';
          item ["category_name"] = '<?= $soal['category_name'];?>';

        	jsonObj.push(item);
        	<?php
        	}
        	?>
        	//console.log(jsonObj[0]);
        </script>
<?= $this->endSection() ?>
