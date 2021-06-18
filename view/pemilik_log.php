<form id = "log-form" class="login-main" action="login" method="POST">
    <div class="login-content bg-white">
        <div class="login-h1-box" style="height: 20%;">
            <h1 class="c-dark-blue fs-48">LOGIN</h1>
        </div>
        <div class="log-isi" style="height: 80%;">
            <div class="log-isi-kiri">
                <div>
                    <h2>FROM</h2>
                </div>
                <div>
                    <input type="date" id="dateFrom">
                </div>
                <div>
                    <h2>UNTIL</h2>
                </div>
                <div>
                    <input type="date" id="dateFrom">
                </div>
                <div class="footer-box-button">
                    <button type="submit" id="login" class="login-next-button c-white bg-dark-blue" href=""><span class="material-icons md-48">arrow_forward</span></button>
                </div>
                <div class="login-h1-box">
                    <h1 class="c-dark-blue fs-48">SUMMARY</h1>
                </div>
                <div class="login-box" style="margin-bottom: 50px;">
                    <label class="fw-700 fs-18 c-dark-blue">TOTAL INCOME</label>
                    <h3>Rp. 2,590,000</h3>
                </div>
                <div class="login-box" style="margin-bottom: 50px;">
                    <label class="fw-700 fs-18 c-dark-blue">TOTAL CUSTOMER</label>
                    <h3>38</h3>
                </div>
            </div>
            <div class="log-isi-kanan">
                <div>
                    <a>
                        <h2>DOWNLOAD</h2>
                    </a>
                </div>
                <div>
                    <table>
                        <tr>
                            <th>DATE</th>
                            <th>ID BOOKING</th>
                            <th>TOTAL TICKET</th>
                            <th>TOTAL PRICE</th>
                        </tr>
                        <?php 
                        // foreach ($result as $key => $value) {
                        // 	echo "<tr>";
                        // 	echo "<td>".$value->getDate()."</td>";
                        // 	echo "<td>".$value->getIDBooking()."</td>";
                        // 	echo "<td>".$value->getTotalTicket()."</td>";
                        // 	echo "<td>".$value->getTotalHarga()."</td>";
                        // 	echo "</tr>";
                        // }
                        ?>
                    </table>
                </div>
                <div>
                    <div>
                        <div>
                            <a href = "logout"class="footer-button">HOME</a>
                        </div>
                        <div>
                            <a href = "logout"class="footer-button">SIGN OUT</a>
                        </div>
                    </div>
                    <div>
                        <button type="submit" id="login" class="login-next-button c-white bg-dark-blue" href=""><span class="material-icons md-48">arrow_back</span></button>
                        <button type="submit" id="login" class="login-next-button c-white bg-dark-blue" href=""><span class="material-icons md-48">arrow_forward</span></button>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</form>
