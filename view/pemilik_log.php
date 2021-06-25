<div id="log-form" class="login-main">
        <div class="login-content bg-white" style="width: 90%;">
            <div class="login-h1-box" style="height: 15%;">
                <h1 class="c-dark-blue fs-48">LOG</h1>
            </div>
            <div class="log-isi" style="height: 85%; width: 100%;">
                <div class="log-isi-kiri">
                    <form class="log-isi-kiri-2" action="log-transaksi" method="GET">
                        <div class="log-kiri-row">
                            <h2>FROM</h2>
                        </div>
                        <div class="log-kiri-row">
                            <input type="date" class = "input-date"name="dateFrom">
                        </div>
                        <div class="log-kiri-row">
                            <h2>UNTIL</h2>
                        </div>
                        <div class="log-kiri-row" style="margin-bottom: 25px;">
                            <input type="date" class = "input-date" name="dateUntil">
                        </div>
                        <div class="footer-box-button" style="margin-bottom: 25px;">
                            <button type="submit" class="login-next-button c-white bg-dark-blue" style="height: 60px; border-radius:15px" href=""><span class="txtButton">SET</span></button>
                        </div>
                        <div class="login-h1-box" style="margin-bottom: 25px;">
                            <h1 class="c-dark-blue fs-48">SUMMARY</h1>
                        </div>
                        <div class="log-kiri-row log-txt-biru" style="margin-bottom: 25px;">
                            <label class="fw-700 fs-18 c-dark-blue">TOTAL INCOME</label>
                            <h3>Rp. <?php echo $totalIncome;?></h3>
                        </div>
                        <div class="log-kiri-row log-txt-biru ">
                            <label class="fw-700 fs-18 c-dark-blue ">TOTAL CUSTOMER</label>
                            <h3><?php echo $totalCustomer;?></h3>
                        </div>
                    </form>
                </div>
                <div class="log-isi-kanan ">
                    <div class="log-isi-kanan-2">
                        <form class="log-download-box" method="POST" action="pdf-transaksi">
                            <?php
                            // foreach($query_result as $value)
                            // {
                            //     echo '<input type="hidden" name="result[]" value="'. $value. '">';
                            // }
                            ?>
                            <input type="hidden" name = "dateFrom" value= <?php echo $dateFrom ?>>
                            <input type="hidden" name = "dateUntil" value= <?php echo $dateUntil ?>>
                            <input type="hidden" name = "totalIncome" value= <?php echo $totalIncome ?>>
                            <input type="hidden" name = "totalCustomer" value= <?php echo $totalCustomer ?>>
                            <button class="log-download-button" type="submit">
                                <h2>DOWNLOAD</h2>
                            </button>
                        </form>
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
                                            echo "<td>".$value->getFormattedPrice()."</td>";
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
                                if ($dateFrom != "" && $dateUntil != ""){
                                    if($page > 0) {
                                        //kalau di halaman 1 ga perlu tampilin tombol back
                                        $href = 'log-transaksi?page='.($page - 1).'&dateFrom='.$dateFrom.'&dateUntil='.$dateUntil;
                                        echo '<a class="login-next-button log-table-next-button " href="'.$href.'" style="margin-right: 25px;"><span class="material-icons md-48">chevron_left</span></a>'; 
                                    }
                                    if($page < $last_page){
                                        //kalau halaman terkahir ga perlu tombol next
                                        $href = 'log-transaksi?page='.($page + 1).'&dateFrom='.$dateFrom.'&dateUntil='.$dateUntil;
                                        echo '<a class="login-next-button log-table-next-button " href="'.$href.'"><span class="material-icons md-48">chevron_right</span></a>';
                                    }
                                }else if ($dateFrom != ""){
                                    if($page > 0) {
                                        //kalau di halaman 1 ga perlu tampilin tombol back
                                        $href = 'log-transaksi?page='.($page - 1).'&dateFrom='.$dateFrom;
                                        echo '<a class="login-next-button log-table-next-button " href="'.$href.'" style="margin-right: 25px;"><span class="material-icons md-48">chevron_left</span></a>'; 
                                    }
                                    if($page < $last_page){
                                        //kalau halaman terkahir ga perlu tombol next
                                        $href = 'log-transaksi?page='.($page + 1).'&dateFrom='.$dateFrom;
                                        echo '<a class="login-next-button log-table-next-button " href="'.$href.'"><span class="material-icons md-48">chevron_right</span></a>';
                                    }
                                }else if ($dateUntil != ""){
                                    if($page > 0) {
                                        //kalau di halaman 1 ga perlu tampilin tombol back
                                        $href = 'log-transaksi?page='.($page - 1).'&dateUntil='.$dateUntil;
                                        echo '<a class="login-next-button log-table-next-button " href="'.$href.'" style="margin-right: 25px;"><span class="material-icons md-48">chevron_left</span></a>'; 
                                    }
                                    if($page < $last_page){
                                        //kalau halaman terkahir ga perlu tombol next
                                        $href = 'log-transaksi?page='.($page + 1).'&dateUntil='.$dateUntil;
                                        echo '<a class="login-next-button log-table-next-button " href="'.$href.'"><span class="material-icons md-48">chevron_right</span></a>';
                                    }
                                }else{
                                    if($page > 0) {
                                        //kalau di halaman 1 ga perlu tampilin tombol back
                                        $href = 'log-transaksi?page='.($page - 1);
                                        echo '<a class="login-next-button log-table-next-button " href="'.$href.'" style="margin-right: 25px;"><span class="material-icons md-48">chevron_left</span></a>'; 
                                    }
                                    if($page < $last_page){
                                        //kalau halaman terkahir ga perlu tombol next
                                        $href = 'log-transaksi?page='.($page + 1);
                                        echo '<a class="login-next-button log-table-next-button " href="'.$href.'"><span class="material-icons md-48">chevron_right</span></a>';
                                    }
                                }
                                ?>
        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>