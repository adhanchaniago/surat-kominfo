<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_SESSION['errQ'])){
            $errQ = $_SESSION['errQ'];
            echo '<div id="alert-message" class="row jarak-card">
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

    	$id = mysqli_real_escape_string($config, $_REQUEST['id']);
    	$query = mysqli_query($config, "SELECT * FROM tbl_buat_surat WHERE id='$id'");

    	if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){

    		  echo '<!-- Row form Start -->
				<div class="row jarak-card">
				    <div class="col m12">
                        <div class="card">
                            <div class="card-content">
        				        <table>
        				            <thead class="red lighten-5 red-text">
        				                <div class="confir red-text"><i class="material-icons md-36">error_outline</i>
        				                Apakah Anda yakin akan menghapus data ini?</div>
        				            </thead>

        				            <tbody>
        				                <tr>
        				                    <td width="13%">No. Surat</td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.$row['no_surat'].'</td>
        				                </tr>
        				                <tr>
        				                    <td width="13%">Perihal</td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.$row['perihal'].'</td>
        				                </tr>
        				                <tr>
        				                    <td width="13%">Isi Kegiatan</td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.$row['kegiatan'].'</td>
        				                </tr>
        				                <tr>
        				                    <td width="13%">Tujuan </td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.$row['tujuan'].'</td>
        				                </tr>
        				                <tr>
        				                    <td width="13%">Tanggal Surat</td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.indoDate($row['tgl_surat']).'</td>
        				                </tr>
        				            </tbody>
    				   		    </table>
				            </div>
                            <div class="card-action">
        		                <a href="?page=surat&act=edit&submit=yes&id='.$row['id'].'" class="btn-large deep-orange waves-effect waves-light white-text">HAPUS <i class="material-icons">delete</i></a>
        		                <a href="?page=surat" class="btn-large blue waves-effect waves-light white-text">BATAL <i class="material-icons">clear</i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row form END -->';

            	if(isset($_REQUEST['submit'])){
            		$id = $_REQUEST['id'];

                        //jika tidak ada file akan mengekseskusi script dibawah ini
                        $query = mysqli_query($config, "DELETE FROM tbl_buat_surat WHERE id='$id'");

                        if($query == true){
                            $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
                            header("Location: ./admin.php?page=surat");
                            die();
                        } else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">
                                    window.location.href="./admin.php?page=surat&act=del&id='.$id.'";
                                  </script>';
                        }
                }
	    }
    }
}
?>
