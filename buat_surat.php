<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['submit'])){

            $no_surat = $_REQUEST['no_surat'].'/SEKRT/DISKOMINFO/'.date('Y');
            $tujuan = $_REQUEST['tujuan'];
            $kegiatan = $_REQUEST['kegiatan'];
            $kode = substr($_REQUEST['perihal'],0,30);
            $perihal = trim($kode);
            $tgl_surat = $_REQUEST['tgl_surat'];
            $lampiran = $_REQUEST['lampiran'];
            $hari = $_REQUEST['hari'];
            $waktu = $_REQUEST['waktu'];
            $tempat = $_REQUEST['tempat'];

            $query = mysqli_query($config, "INSERT INTO tbl_buat_surat
                (no_surat,tujuan,kegiatan,perihal,tgl_surat,lampiran,hari,waktu,tempat)
                VALUES('$no_surat','$tujuan','$kegiatan','$perihal','$tgl_surat','$lampiran','$hari','$waktu','$tempat')");

            if($query == true){
                $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                header("Location: ./admin.php?page=surat");
                die();
            } else {
                $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                echo '<script language="javascript">window.history.back();</script>';
            }
        } else {?>

            <!-- Row Start -->
            <div class="row">
                <!-- Secondary Nav START -->
                <div class="col s12">
                    <nav class="secondary-nav">
                        <div class="nav-wrapper blue-grey darken-1">
                            <ul class="left">
                                <li class="waves-effect waves-light"><a href="?page=surat&act=add" class="judul"><i class="material-icons">mail</i> Buat Surat Keluar</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <!-- Secondary Nav END -->
            </div>
            <?php
                if(isset($_SESSION['errQ'])){
                    $errQ = $_SESSION['errQ'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card red lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errQ.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['errQ']);
                }
                if(isset($_SESSION['errEmpty'])){
                    $errEmpty = $_SESSION['errEmpty'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card red lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errEmpty.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['errEmpty']);
                }
            ?>
            <!-- Row form Start -->
            <div class="row jarak-form">
                
                <!-- Form START -->
                <form class="col s12" method="POST" action="?page=surat&act=add" enctype="multipart/form-data">

                    <!-- Row in form START -->
                    <div class="row">
                        <!-- Nomor Surat -->
                        <div class="input-field col s6">
                            <div class="col 6">
                                <i class="material-icons prefix md-prefix">looks_two</i>
                                <input type="text" name="no_surat">
                                <label for="no_surat">Nomor Surat</label>
                            </div>
                            <div class="col 6">
                                <label style="margin-left:220px;">/SEKRT/DISKOMINFO/<?php echo date('Y'); ?></label>
                            </div>
                        </div>
                        <!-- Perihal -->
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">bookmark</i>
                            <select id="kode" class="validate" name="perihal">
                                <option value="">Kode Klasifikasi</option>
                                <?php 
                                    $s = mysqli_query($config, "SELECT kode, nama FROM tbl_klasifikasi");
                                    while ($row = mysqli_fetch_array($s)) {
                                        echo '<option value="'.$row['nama'].'">'.$row['kode'].' | '.$row['nama'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <!-- Tujuan -->
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">place</i>
                            <input id="tujuan" type="text" class="validate" name="tujuan">
                            <label for="tujuan">Tujuan</label>
                        </div>
                        <!-- Tanggal Surat -->
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">date_range</i>
                            <input id="tgl_surat" type="text" name="tgl_surat" class="datepicker">
                            <label for="tgl_surat">Tanggal Surat</label>
                        </div>  
                        <!-- Lampiran -->
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">description</i>
                            <input id="lampiran" type="text" class="validate" name="lampiran">
                            <label for="lampiran">Lampiran</label>
                        </div>
                        <!-- Kegiatan -->
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">description</i>
                            <input id="kegiatan" type="text" class="validate" name="kegiatan">
                            <label for="kegiatan">Kegiatan</label>
                        </div>
                        <!-- Hari -->
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">featured_play_list</i>
                            <input id="hari" type="text" class="validate" name="hari">
                            <label for="hari">Hari</label>
                        </div>
                        <!-- Waktu -->
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">featured_play_list</i>
                            <input id="waktu" type="text" class="validate" name="waktu">
                            <label for="waktu">Waktu</label>
                        </div>
                        <!-- Tempat -->
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">featured_play_list</i>
                            <input id="tempat" type="text" class="validate" name="tempat">
                            <label for="tempat">Tempat</label>
                        </div>
                    </div>
                    <!-- Row in form END -->

                    <div class="row">
                        <div class="col 6">
                            <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                        </div>
                        <div class="col 6">
                            <a href="?page=surat" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
                        </div>
                    </div>

                </form>
                <!-- Form END -->

            </div>
            <!-- Row form END -->

<?php
        }
    }
?>
