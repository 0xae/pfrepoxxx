$(document).ready(function () {
   var pId = parseInt($("#producer_id").val());
   var pState = parseInt($("#producer_state").val());

   console.info({
       producer_id: pId,
       producer_state: pState
   });

   // the producer has not been created yet
   if (isNaN(pId)) {
       // create the user
       $("#modal_criar_user").modal();
   } else if (isNaN(pState)) {
       // configure the producer iff it has not been configured yet
       $("#modal_criar_produtor").modal();
   }
});

