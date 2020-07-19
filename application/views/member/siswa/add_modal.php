<div class="main-content">
    <div class="main-content-inner">
            <!-- /section:settings.box -->
            <div class="page-header" style="display:none;">
                <h1>
                    Formulir Tambah siswa
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        
                    </small>
                </h1>
            </div><!-- /.page-header -->
			
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/siswa/doAdd/'?>" role="form"> 
                       <?php 
                       $dataOld = $this->session->flashdata('oldPost'); 
                       echo $this->session->flashdata('msgbox');?>
                        <!-- #section:elements.form -->
						<div class="form-group">        
                          <div class="col-sm-2" style="border-bottom: 2px solid #6EBACC;">
                            Harap isi isian di bawah ini:
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">NIK</label>

                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" name="txtNIK" value="<?php echo $dataOld['txtNIK']; ?>" placeholder="Isi NIK" class="col-xs-10 col-sm-5" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama siswa</label>

                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" name="txtNamasiswa" value="<?php echo $dataOld['txtNamasiswa']; ?>" placeholder="Isi nama karyawatan" class="col-xs-10 col-sm-5" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">No HP</label>

                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" name="txtNoHp" value="<?php echo $dataOld['txtNoHp']; ?>" placeholder="Isi no hp" class="col-xs-10 col-sm-5" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Alamat siswa</label>

                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" name="txtAlamat" value="<?php echo $dataOld['txtAlamat']; ?>" placeholder="Isi alamat siswa" class="col-xs-10 col-sm-5" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">No Rek</label>

                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" name="txtNoRek" value="<?php echo $dataOld['txtNoRek']; ?>" placeholder="Isi no rekening" class="col-xs-10 col-sm-5" required/>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Bank</label>

                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" name="NamaBank" value="<?php echo $dataOld['NamaBank']; ?>" placeholder="Isi nama bank" class="col-xs-10 col-sm-5" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Gaji Utama</label>

                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" name="txtGaji" value="<?php echo $dataOld['txtGaji']; ?>" placeholder="Isi gaji utama" class="col-xs-10 col-sm-5" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jabatan</label>

                            <div class="col-sm-9">
                                <select name="spinJabatan" class="col-xs-10 col-sm-5">
                                <?php
                                $getJabatan = $this->m_jabatan->getAllJabatan();
                                foreach ($getJabatan as  $value) {
                                ?>
                                <option value="<?php echo $value['JabatanID'] ?>"><?php echo $value['NamaJabatan'] ?></option>
                                <?php
                                }
                                 ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Golongan Pajak</label>

                            <div class="col-sm-9">
                                <select name="spinGolongan" class="col-xs-10 col-sm-5">
                                <?php
                                $getGolongan = $this->m_jabatan->getAllGolonganPajak();
                                foreach ($getGolongan as  $value) {
                                ?>
                                <option value="<?php echo $value['GolonganPajakID'] ?>"><?php echo $value['NamaGolongan'] ?></option>
                                <?php
                                }
                                 ?>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Simpan
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    Reset
                                </button>
                            </div>
                        </div>

                        <div class="hr hr-24"></div>

                    </form>


                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->