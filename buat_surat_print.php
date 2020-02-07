<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {
        echo '
        <style type="text/css">
            table {
                background: #fff;
                padding: 5px;
            }
            tr, td {
                border: table-cell;
                border: 0px white;
            }
            tr,td {
                vertical-align: top!important;
            }
            #right {
                border-right: none !important;
            }
            #left {
                border-left: none !important;
            }
            .isi {
                height: 300px!important;
            }
            .disp {
                text-align: center;
                padding: 1.5rem 0;
                margin-bottom: .5rem;
            }
            .logodisp {
                float: left;
                position: relative;
                width: 110px;
                height: 110px;
                margin: 0 0 0 1rem;
            }
            #lead {
                width: auto;
                position: relative;
                margin: 25px 0 0 75%;
            }
            .lead {
                font-weight: bold;
                text-decoration: underline;
                margin-bottom: -10px;
            }
            .tgh {
                text-align: center;
            }
            #nama {
                font-size: 2.1rem;
                margin-bottom: -1rem;
            }
            #alamat {
                font-size: 16px;
            }
            .up {
                text-transform: uppercase;
                margin: 0;
                line-height: 2.2rem;
                font-size: 1.5rem;
            }
            .status {
                margin: 0;
                font-size: 1.3rem;
                margin-bottom: .5rem;
            }
            #lbr {
                font-size: 20px;
                font-weight: bold;
            }
            .separator {
                border-bottom: 2px solid #616161;
                margin: -1.3rem 0 1.5rem;
            }
            @media print{
                body {
                    font-size: 12px;
                    color: #212121;

                }
                nav {
                    display: none;
                }
                table {
                    width: 100%;
                    font-size: 12px;
                    color: #212121;
                }
                tr, td {
                    border: 0px white;
                    padding: 8px!important;

                }
                tr,td {
                    vertical-align: top!important;
                }
                #lbr {
                    font-size: 20px;
                }
                .isi {
                    height: 200px!important;
                }
                .tgh {
                    text-align: center;
                }
                .disp {
                    text-align: center;
                    margin: -.5rem 0;
                }
                .logodisp {
                    float: left;
                    position: relative;
                    width: 80px;
                    height: 80px;
                    margin: .5rem 0 0 .5rem;
                }
                #lead {
                    width: auto;
                    position: relative;
                    margin: 15px 0 0 75%;
                }
                .lead {
                    font-weight: bold;
                    text-decoration: underline;
                    margin-bottom: -10px;
                }
                #nama {
                    font-size: 20px!important;
                    font-weight: bold;
                    text-transform: uppercase;
                    margin: -10px 0 -20px 0;
                }
                .up {
                    font-size: 17px!important;
                    font-weight: normal;
                }
                .status {
                    font-size: 17px!important;
                    font-weight: normal;
                    margin-bottom: -.1rem;
                }
                #alamat {
                    margin-top: -15px;
                    font-size: 13px;
                }
                #lbr {
                    font-size: 17px;
                    font-weight: bold;
                }
                .separator {
                    border-bottom: 2px solid #616161;
                    margin: -1rem 0 1rem;
                }

            }
        </style>

        <body onload="window.print()">

        <!-- Container START -->
            <div id="colres">
                <div class="disp">';
                    $query2 = mysqli_query($config, "SELECT institusi, nama, status, alamat, logo FROM tbl_instansi");
                    list($institusi, $nama, $status, $alamat, $logo) = mysqli_fetch_array($query2);
                        echo '<img class="logodisp" src="./upload/'.$logo.'"/>';
                        echo '<h6 class="up">'.$institusi.'</h6>';
                        echo '<h5 class="up" id="nama">'.$nama.'</h5><br/>';
                        echo '<h6 class="status">'.$status.'</h6>';
                        echo '<span id="alamat">Jalan Jendral Sudirman No.74 Telp. (0511) 6701255 Fax. (0511) 6701166</p></span>';

                    echo '
                </div>
                <div class="separator"></div>';

                $id = mysqli_real_escape_string($config, $_REQUEST['id']);
                $query = mysqli_query($config, "SELECT * FROM tbl_buat_surat WHERE id='$id'");

                if(mysqli_num_rows($query) > 0){
                $no = 0;
                while($row = mysqli_fetch_array($query)){

                echo '
                    <table>
                        <tbody>
                            <tr>
                                <td id="left" width="15%">Nomor</td>
                                <td id="left" width="1%">:</td>
                                <td id="left" width="40%">'.$row['no_surat'].'</td>
                                <td class="tgh">Marabahan,  '.indoDate($row['tgl_surat']).'</td>
                            </tr>
                            <tr>
                                <td id="left" width="15%">Lampiran</td>
                                <td id="left" width="1%">:</td>
                                <td id="left" width="40%">'.$row['lampiran'].'</td>
                                <td class="tgh"></td>
                            </tr>
                            <tr>
                                <td id="left" width="15%">Perihal</td>
                                <td id="left" width="1%">:</td>
                                <td id="left" width="40%"><strong><u>'.$row['perihal'].'</u></strong></td>
                                <td class="tgh"></td>
                            </tr>
                            <tr>
                                <td id="left" width="15%"></td>
                                <td id="left" width="1%"></td>
                                <td id="left" width="40%"></td>
                                <td id="left"><strong>Kepada Yth : </strong></td>
                            </tr>
                            <tr>
                                <td id="left" width="15%"></td>
                                <td id="left" width="1%"></td>
                                <td id="left" width="40%"></td>
                                <td id="left">'.$row['tujuan'].'</td>
                            </tr>
                            <tr>
                                <td id="left" width="15%"></td>
                                <td id="left" width="1%"></td>
                                <td id="left" width="40%"></td>
                                <td id="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;di - Marabahan</td>
                            </tr>
                            <tr>
                                <td id="left" width="15%"></td>
                                <td id="left" width="1%"></td>
                                <td id="left" width="40%"></td>
                                <td id="left"></td>
                            </tr>
                            <tr>
                                <td id="left" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Sehubungan akan dilaksanakannya program dan kegiatan Diskominfo Tahun Anggaran 2020
                                maka untuk lebih mengkoordinasikan kegiatan tersebut maka akan dilaksanakan '.$row['kegiatan'].' 
                                yang akan dilaksanakan pada:
                                </td>
                            </tr>
                        </tbody>
                    </table>';
                echo '
                    <table>
                        <tbody>
                            <tr>
                                <td id="left" width="5%"></td>
                                <td id="left" width="10%">Hari/Tanggal</td>
                                <td id="left" width="40%"> : '.$row['hari'].'</td>
                            </tr>
                            <tr>
                                <td id="left" width="5%"></td>
                                <td id="left" width="10%">Waktu</td>
                                <td id="left" width="40%"> : '.$row['waktu'].'</td>
                            </tr>
                            <tr>
                                <td id="left" width="5%"></td>
                                <td id="left" width="10%">Tempat</td>
                                <td id="left" width="40%"> : '.$row['tempat'].'</td>
                            </tr>
                            <tr>
                                <td id="left" colspan="3">
                                </td>
                            </tr>
                            <tr>
                                <td id="left" colspan="3">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Demikian disampaikan agar dapat menjadi perhatian.
                                </td>
                            </tr>
                        </tbody>
                    </table>';

                } echo '
            <div id="lead">
                <p>Kepala Instansi</p>
                <div style="height: 50px;"></div>';
                $query = mysqli_query($config, "SELECT kepsek, nip FROM tbl_instansi");
                list($kepsek,$nip) = mysqli_fetch_array($query);
                if(!empty($kepsek)){
                    echo '<p class="lead">'.$kepsek.'</p>';
                } else {
                    echo '<p class="lead">Ketua Kominfo</p>';
                }
                if(!empty($nip)){
                    echo '<p>NIP. '.$nip.'</p>';
                } else {
                    echo '<p>NIP. -</p>';
                }
                echo '
            </div>
        </div>
        <div class="jarak2"></div>
    <!-- Container END -->

    </body>';
    }
}
?>
