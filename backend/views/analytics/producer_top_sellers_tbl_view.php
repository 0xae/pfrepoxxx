<div class="col-md-12" style="padding: 10px;">
    <div class="col-md-4">
    </div>
    <div class=" push-right" style="float: right; margin-top:8px; margin-right:20px">
    </div>  
</div>

<div class="col-md-12" style="padding:0px;margin:0px;">
<table class="table table-striped fb-stats">
    <thead>
        <tr class="active fb-table-header">
            <th class="fb-header">Producer</th>
            <th class="fb-header" style="text-align: center;">Tickets sold</th>
            <th class="fb-header" style="text-align: center;">Average Ticket Price</th>
            <th class="fb-header" style="text-align: center">Gross Revenue</th>
            <th class="fb-header" style="text-align: center">Liquid Revenue</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="p in topSellers">
            <td style="padding-left: 70px;width: 450px;">
                <img ng-src="../passafree_uploads/{{ p.producer_picture }}" style="width:44px; height:44px" />
                        
                <h4 style="display:inline">
                    <a href="#" style="font-weight: bolder; margin-left: 10px">
                        {{ p.producer_name }}
                    </a>
                </h4>
            </td>
            <td class="fb-col">
                <center>
                    <strong>
                    <span class="money"> {{ p.tickets_sold }}  </span>
                    </strong>
                </center>
            </td>
            <td class="fb-col">
                <center>
                    <strong>
                    <span class="money"> {{ p.tickets_price_average }}  </span>
                    </strong>
                </center>
            </td>
            <td class="fb-col">
                <center>
                    <strong>
                        <span class="money"> {{ p.gross_revenue }} </span>  
                    </strong>
                </center>
            </td>
            <td class="fb-col">
                <center>
                    <strong>
                        <span class="money">{{ p.liquid_revenue }}</span>
                    </strong>
                </center>
            </td>
        </tr>
    </tbody>
</table>
</div>
