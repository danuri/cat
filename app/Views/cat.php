<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="<?= site_url()?>" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="21">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="<?= site_url()?>" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="21">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="index.html">
                                <i class="las la-house-damage"></i> <span data-key="t-dashboard">Nomor Soal</span>
                            </a>
                        </li>


                        <div class="help-box text-center">
                            <img src="assets/images/create-invoice.png" class="img-fluid" alt="">
                            <p class="mb-3 mt-2 text-muted">Upgrade To Pro For More Features</p>
                            <div class="mt-3">
                                <a href="invoice-add.html" class="btn btn-primary"> Create Invoice</a>
                            </div>
                        </div>

                    </ul>
                </div>
                <!-- Sidebar -->
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Pilihlah 5 dari 10 sikap di bawah ini, yang menurut Anda sangat sesuai dengan sikap Anda terkait Anti Kekerasan.</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="formCheck1">
                                            <label class="form-check-label" for="formCheck1">
                                            mempekerjakan manusia melebihi batas kemampuan jam kerja, fisik dan pikiran
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck2">
                                            <label class="form-check-label" for="formCheck2">
                                            merasa berhutang kepada orang lain menumpuhkan rasa empati terhadap orang lain
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="formCheck3">
                                            <label class="form-check-label" for="formCheck3">
                                            sebaik-baiknya manusia beragama adalah yang memberi manfaat, menghidari kerusakan
                                            </label>
                                        </div>
                                    </div>
                                    <!-- end table responsive -->
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <div class="d-flex align-items-start gap-3 mt-4">
                        <button type="button" class="btn btn-warning btn-label previestab" data-previous="v-pills-bill-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Kembali ke Soal Sebelumnya</button>
                        <button type="button" class="btn btn-primary btn-label right ms-auto"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Simpan dan Lanjutkan</button>
                        <button type="button" class="btn btn-success btn-label right ms-auto"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Lewati Soal Ini</button>
                    </div>


                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © CAT Moderasi Beragama.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Biro Kepegawaian Kementerian Agama RI
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <script type="text/javascript">
        	jQuery(document).ready(function($) {
        		$('.soal_terjawab').html('<?php echo $jumlah;?>');
        		$('#clock').countdown('<?php echo $log->finish_time;?>', function(event) {
        		  $(this).html(event.strftime('%H:%M:%S'));
        		});
        		//console.log(jsonObj[0]['pertanyaan']);
        		loadsoal(1);
            $("#paging").niceScroll({cursorcolor:"#b3b3b3",autohidemode:false});

        		$('.save').on('click', function(event) {
        			var jawaban = $('input[name=jawaban]:checked').val();
        			var soal_id = $('#soal_id').val();
        			var nourut = $('#nourut').val();
        			if(parseInt($('.soal_terjawab').html()) >= 100){
        				var soal_terjawab = $('.soal_terjawab').html();
        			}else{
        				var soal_terjawab = parseInt($('.soal_terjawab').html())+1;
        			}
        			console.log(parseInt($('.soal_terjawab').html()));

        			$.post( "<?php echo site_url('home/save');?>",
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
        		if(no < 100){
        			$('.soalfinish').css('display', 'none');
        			$('.soalstart').css('display', '');
        		}else if(no > 100){
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
        		$('#soalno').html('Soal No. '+no);
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
        	}

        	function savejawaban() {

        	}

        	jsonObj = [];
        	<?php
        	foreach ($soals as $soal) {
        		$pertanyaan = str_replace('\u0000', '', json_encode($soal->pertanyaan));
        		$p1 = str_replace('\u0000', '', json_encode($soal->p1));
        		$p2 = str_replace('\u0000', '', json_encode($soal->p2));
        		$p3 = str_replace('\u0000', '', json_encode($soal->p3));
        		$p4 = str_replace('\u0000', '', json_encode($soal->p4));
        		$p5 = str_replace('\u0000', '', json_encode($soal->p5));
        	?>
        	item = {}
        	item ["id"] = '<?php echo $soal->id;?>';
        	item ["pertanyaan"] = "<?php echo str_replace('"','',$pertanyaan);?>";
        	item ["p1"] = "<?php echo str_replace('"','',$p1);?>";
        	item ["p2"] = "<?php echo str_replace('"','',$p2);?>";
        	item ["p3"] = "<?php echo str_replace('"','',$p3);?>";
        	item ["p4"] = "<?php echo str_replace('"','',$p4);?>";
        	item ["p5"] = "<?php echo str_replace('"','',$p5);?>";
        	item ["j"] = '<?php echo $soal->jawaban_peserta;?>';

        	jsonObj.push(item);
        	<?php
        	}
        	?>
        	//console.log(jsonObj[0]);

        </script>
<?= $this->endSection() ?>
