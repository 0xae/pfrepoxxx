<div class="row" style="padding: 35px">
    <div class="col-md-6">
        <h2 style="color: #313541; font-weight: 700;">Stock</h2>
        <h1 style="color: #009447; font-weight: 700; margin-top: -10px;">
              <span class="money"> <?= $b['tickets_stock']; ?> </span>
        </h1>

        <h2 style="color: #313541; font-weight: 700;">Tickets sold</h2>
        <h1 style="color: #009447; font-weight: 700; margin-top: -10px;">
              <span class="money"> <?= $b['tickets_sold']; ?> </span>
        </h1>

        <h2 style="color: #313541; font-weight: 700;">Profit</h2>
        <h1 style="color: #009447; font-weight: 700; margin-top: -10px;">
             <span class="money"> <?= $b['liquid_revenue']; ?> </span>
        </h1>
    </div>

    <div class="col-md-3 text-center"><br><br>
        <div class="fundo_circle">
            <div class="c100 p50" style="margin-bottom:23px">
                <span>
                     <span id=""><?= $b['checkin_percent'] ?>%</span>
                     <br/>
                    <small>
                     <span id="" class="value"><?= $b['tickets_sold'] ?></span>
                    </small>
                 </span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>
           <span style="color: #009447; font-weight: 700; text-transform: uppercase; font-size: 20px;">Entrada</span>
        </div>
    </div>

<div class="col-md-3 text-center"><br><br>
    <div class="fundo_circle">
        <div class="c100 p50" style="margin-bottom:23px">
            <span>
                 <span id=""><?= $b['tickets_percent'] ?>%</span>
                 <br/>
                 <small> <span id="" class="value"><?= $b['tickets_total'] ?></span> </small>
             </span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
        </div>
        <span style="color: #009447; font-weight: 700; text-transform: uppercase; font-size: 20px;">Stock</span>
    </div>
</div>

</div>
