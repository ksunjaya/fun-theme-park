<form id="log-form" class="login-main" action="login" method="POST">
        <div class="login-content bg-white" style="width: 90%;">
            <div class="login-h1-box" style="height: 15%;">
                <h1 class="c-dark-blue fs-48">LOG</h1>
            </div>
            <div class="log-isi" style="height: 85%; width: 100%;">
                <div class="log-isi-kiri">
                    <div class="log-isi-kiri-2">
                        <div class="log-kiri-row">
                            <h2>FROM</h2>
                        </div>
                        <div class="log-kiri-row">
                            <input type="date" name="dateFrom">
                        </div>
                        <div class="log-kiri-row">
                            <h2>UNTIL</h2>
                        </div>
                        <div class="log-kiri-row" style="margin-bottom: 25px;">
                            <input type="date" name="dateUntil">
                        </div>
                        <div class="footer-box-button" style="margin-bottom: 25px;">
                            <button type="submit" id="login" class="login-next-button c-white bg-dark-blue" href=""><span class="material-icons md-48">arrow_forward</span></button>
                        </div>
                        <div class="login-h1-box" style="margin-bottom: 25px;">
                            <h1 class="c-dark-blue fs-48">SUMMARY</h1>
                        </div>
                        <div class="log-kiri-row log-txt-biru" style="margin-bottom: 25px;">
                            <label class="fw-700 fs-18 c-dark-blue">TOTAL INCOME</label>
                            <h3>Rp. <?php
                                $sum = 0;
                                foreach ($result as $key => $value){
                                    $sum+=$value->getTotalPrice();
                                }
                                $x = "";
                                for($i = strlen($sum)-3; $i >= 0; $i -= 3){
                                    $x = substr($sum, 0, $i).'.'.substr($sum, $i, strlen($sum));
                                }
                                echo $x;
                            ?></h3>
                        </div>
                        <div class="log-kiri-row log-txt-biru ">
                            <label class="fw-700 fs-18 c-dark-blue ">TOTAL CUSTOMER</label>
                            <h3><?php
                                $sum2 = 0;
                                foreach ($result as $key => $value){
                                    $sum2+=$value->getTotalTicket();
                                }
                                echo $sum2;
                            ?></h3>
                        </div>
                    </div>
                </div>
                <div class="log-isi-kanan ">
                    <div class="log-isi-kanan-2">
                        <div class="log-download-box">
                            <a class="log-download-button">
                                <h2>DOWNLOAD</h2>
                            </a>
                        </div>
                        <div class="log-table-box">
                            <div class="log-table-box-2">
                                <table class="log-table">
                                    <tr>
                                        <th>DATE</th>
                                        <th>ID BOOKING</th>
                                        <th>TOTAL TICKET</th>
                                        <th>TOTAL PRICE</th>
                                    </tr>
                                    <?php 
                                        foreach ($result as $key => $value) {
                                            echo "<tr>";
                                            echo "<td>".$value->getDate()."</td>";
                                            echo "<td>".$value->getIDBooking()."</td>";
                                            echo "<td>".$value->getTotalTicket()."</td>";
                                            $sum = $value->getTotalPrice();
                                            $y = "";
                                            for($i = strlen($sum)-3; $i >= 0; $i -= 3){
                                                $y = substr($sum, 0, $i).'.'.substr($sum, $i, strlen($sum));
                                            }
                                            echo "<td>Rp. ".$y."</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                        <div class="log-kanan-footer">
                            <div class="log-kanan-footer-kiri">
                                <div>
                                    <a href="main " class="footer-button ">HOME</a>
                                </div>
                                <div>
                                    <a href="logout " class="footer-button ">SIGN OUT</a>
                                </div>
                            </div>
                            <div class="log-kanan-footer-kanan">
                                <?php
                                if($page > 0) {
                                    //kalau di halaman 1 ga perlu tampilin tombol back
                                    $href = 'tickets?page='.($page - 1);
                                    echo '<a class="login-next-button log-table-next-button " href="'.$href.'" style="margin-right: 25px;"><span class="material-icons md-48">chevron_left</span></a>'; 
                                }
                                if($page < $last_page-1){
                                    //kalau halaman terkahir ga perlu tombol next
                                    $href = 'tickets?page='.($page + 1);
                                    echo '<a class="login-next-button log-table-next-button " href="'.$href.'"><span class="material-icons md-48">chevron_right</span></a>'; 
                                    // echo '<a href="'.$href.'" class="next"><span> > </span> </a>'; 
                                }
                                ?>
        
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>