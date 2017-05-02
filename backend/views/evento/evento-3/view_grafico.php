<?php
use kartik\date\DatePicker;
?>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="detail_estatistica">
                <div role="tabpanel">
                    <ul class="nav nav-tabs bilhte" id="_tabGrafigo" role="tablist">
                    
                        <?php if($modelBilhete){?>
                        <li role="presentation" class="active">
                            <a href="#geral1" aria-controls="home" role="tab" data-toggle="tab" class="_grafic">Geral</a>
                        </li>
                        
                        <?php foreach($modelBilhete as $modelB){ ?>
                            <li role="presentation">
                                <a href="#G<?=$modelB->idbilhete?>" aria-controls="tab" role="tab" data-toggle="tab" class="_grafic"><?=$modelB->nome_bilhete?></a>
                            </li>
                            
                        
                        <?php }
                        }?>
                    </ul>
                    <div class="tab-content">
                    <?php if($modelBilhete){?>
                        <div role="tabpanel" class="tab-pane fade in active" id="geral1">
                            <div class="col-md-12">
                                <div class="col-lg-3" id="business_input_filter">
                                    <?= DatePicker::widget([
                                        'name'=>'first_period',
                                        'options' => ['placeholder' => 'First Period','id'=>'first_period'],
                                        'pluginOptions' => [
                                                'format' => 'yyyy-mm-dd','todayHighlight' => true
                                            ]
                                        ]);?>
                                </div>
                                <!--DATA FIM-->
                                <div class="col-lg-3" id="business_input_filter">
                                <?= DatePicker::widget([
                                    'name'=>'last_period',
                                    'options' => ['placeholder' => 'Last Period','id'=>'last_period'],
                                    'pluginOptions' => [
                                            'format' => 'yyyy-mm-dd','todayHighlight' => true
                                        ]
                                    ]);?>

                                </div>
                                <button id="_applyFilter" class="btn btn-primary">Apply</button>
                            </div>
                            <div id="graficoGeral"></div>
                        </div>
                        
                      <?php      foreach($modelBilhete as $modelB){ ?>
                                <div role="tabpanel" class="tab-pane" id="G<?=$modelB->idbilhete?>">
                                    
                                    <div class="col-md-12">
                                <div class="col-lg-3" ">
                                    <?= DatePicker::widget([
                                        'name'=>'first_period'.$modelB->idbilhete,
                                        'options' => ['placeholder' => 'First Period','id'=>'first_period'.$modelB->idbilhete],
                                        'pluginOptions' => [
                                                'format' => 'yyyy-mm-dd','todayHighlight' => true
                                            ]
                                        ]);?>
                                </div>
                                <!--DATA FIM-->
                                <div class="col-lg-3">
                                <?= DatePicker::widget([
                                    'name'=>'last_period'.$modelB->idbilhete,
                                    'options' => ['placeholder' => 'Last Period','id'=>'last_period'.$modelB->idbilhete],
                                    'pluginOptions' => [
                                            'format' => 'yyyy-mm-dd','todayHighlight' => true
                                        ]
                                    ]);?>

                                </div>
                                <button id="_applyFilter<?=$modelB->idbilhete?>" class="btn btn-primary">Apply</button>
                            </div>
                            <div id="G<?=$modelB->idbilhete?>B" nome_bilhete="<?=$modelB->nome_bilhete?>"></div>
                                    
                                </div>
                        <?php 
                        }
                            }?>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
 $idEvento=$_GET['id'];
 $urlGetBilhteGeral=Yii::$app->getUrlManager()->createUrl('evento/bilhetegeral');
 $urlGetBilhete=Yii::$app->getUrlManager()->createUrl('evento/eventobilhete');
 
    $scrip=<<<JS

  // +++++++++++++++++++++++++++ Grafico +++++++++++++++++++++++++++++++++++++++
        
        function graficoRender(dados,render){
        
       Highcharts.chart(render, {

            chart: {
                width: 1100,
                type: 'line'
            },

            title: {
                text: 'Number Access'
            },

            subtitle: {
                text: ''
            },

            yAxis: {
                title: {
                    text: 'Number of Employees'
                }
            },

            xAxis: {
                    type: 'category'
                },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    pointStart: 2010
                }
            },
            series:dados
                });  
            }
        
     function getDadoBilhete(id,render,nome_bilhete){
     
        first=$("#first_period"+id).val()+'';
        last=$("#last_period"+id).val()+'';
        
         $(document).on('click','#_applyFilter'+id,function(){
            
            first=$("#first_period"+id).val()+'';
            last=$("#last_period"+id).val()+'';
            graficoBilheteUnico(id,first,last,nome_bilhete,render);
            return;
            
         });
         
        
         if( first != "" && last != ""){
            graficoBilheteUnico(id,first,last,nome_bilhete,render);
         }
         else{
             graficoBilheteUnico(id,"2017-04-01","2017-04-30",nome_bilhete,render);
         }
            
     }
     
     function graficoBilheteUnico(id,first,last,nome_bilhete,render){
     
        $.post('$urlGetBilhete',{idBilhete:id,first:first,last:last},function(data){
                dados=$.parseJSON(data);
                serieUnico=[{
                    name:nome_bilhete,
                    data:dados
                }]
                graficoRender(serieUnico,render);
                
            });
     }
        
    $("#_applyFilter").click(function(){

        first=$("#first_period").val()+'';
        last=$("#last_period").val()+'';
        
         getDados(first,last,"graficoGeral");

    });
    
function getDados(first,last,idGrafico){

    $.post('$urlGetBilhteGeral',{idEvento:$idEvento,first:first,last:last},function(data){
        console.log(data);
        Grafico(data,idGrafico);
    });
}
    
    

function Grafico(dados,idGrafico){
    da=$.parseJSON(dados);
    serie=[];
    
    for(v=0;v<da.length;v++){
        serie.push(
            {
                name:da[v][0],
                data:da[v][1]
            });
    }
    graficoRender(serie,idGrafico)
}

getDados("2017-04-01","2017-04-30","graficoGeral")

function getIdDivGrafigo(idGrafico){

     render=idGrafico+'B';
     
     idGrafico=idGrafico.substr(1,idGrafico.length);
     nome_bilhete=$('#'+render).attr('nome_bilhete');
     
     getDadoBilhete(idGrafico,render,nome_bilhete);
     
}


$('._grafic').on('shown.bs.tab', function (e) {


    var idGrafico = $(e.target).attr("href");
    idGrafico=idGrafico.substr(1,idGrafico.length);
   
    if($(e.target).attr("href")!='#geral1'){
    
       getIdDivGrafigo(idGrafico);
       
    }
    else{
    
        first=$("#first_period").val()+'';
        last=$("#last_period").val()+'';
    
        if( first != "" && last != ""){
            getDados(first,last,"graficoGeral");
         }
         else{
            getDados("2017-04-01","2017-04-30","graficoGeral");
         }
        
    }
   
});

JS;
$this->registerJs($scrip);

?>
