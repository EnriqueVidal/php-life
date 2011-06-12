$(function(){
	 // Create the canvas
   for (i=0; i<20; i++)
   {
     $("#canvas").append("<tr></tr>")
     for (j=0; j<20; j++)
     {
       $("tr:last").append('<td class="cell" id="[' + i + ',' + j +']" selected="false"></td>');
     }
   }
   
   $('.cell').live('click', function() {
     if ($(this).attr("selected") == "false")
     {
       $(this).attr("selected", true)
       $(this).addClass('selected-cell'); 
       return false;
     }

     $(this).attr("selected", false)
     $(this).removeClass('selected-cell');
   });
   
   $('#send-cells').click(function(){
     cells = new Array();
     $(".selected-cell").each(function(value) {
       cells[value] = this.id;
     });
     
    $.getJSON("php/calculator.php", { cells: cells, width: 20, height: 20 }, function(data){

       $(".selected-cell").each(function(){
         $(this).removeClass('selected-cell');
         $(this).attr('selected', false);
       });

       $(data.surviving_cells).each(function(){
         arr = String(this);

         // for some reason passin "#" + arr to the $() jQuery method didn't work
         cell = $(document)[0].getElementById(arr);
         $(cell).addClass('selected-cell');
         $(cell).attr('selected', true);
       });

				if ($("#auto:checked").length == 1)
					$.doTimeout(3000, $("#send-cells").click().delay(3000));
     });
   });
 });

function kill_or_born_cells()
{
	
}