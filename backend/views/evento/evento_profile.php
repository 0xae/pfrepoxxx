<div class="row" style="padding: 35px">
    <div class="col-md-6">
        <h2 style="color: #313541; font-weight: 700;">Descrição</h2>
        <p style="font-size: 17px;color: #313541;"> <?= $b['ticket_description']; ?> </p>
        <h2 style="color: #313541; font-weight: 700;">Business</h2>
        <h1 style="color: #009447; font-weight: 700; margin-top: -10px;"><?= $b['ticket_biz_percent']; ?>%</h1>
        <h2 style="color: #313541; font-weight: 700;">Preço</h2>
        <h1 style="color: #009447; font-weight: 700; margin-top: -10px;"><?= $b['ticket_preco']; ?>ECV</h1>
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
