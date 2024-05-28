

 function deleteRecord(href,id){
    if(confirm("Are you sure to delete record?")){
      $.ajax({
      url: href+id, 
      type: 'DELETE',
      data: {
         _token: $("input[name=_token]").val()
      },
      success:function(response){
        $("#rid"+id).remove();
        
      }
    });
  }
}



function updateStatus(href,id){

      $.ajax({
      url: href+id, 
      type: 'PUT',
      data: {
         _token: $("input[name=_token]").val()
      },
      success:function(response){

      }
    });
}

function defaultStatus(href,id){
  if(confirm("Are you sure to change the language setting?")){
  $.ajax({
  url: href+id, 
  type: 'PUT',
  data: {
     _token: $("input[name=_token]").val()
  },
  success:function(response){
    location.reload(true);  
  }
});
  }
}


function exportTableToExcel(tableID, filename = 'content'){
  var downloadLink;
  var dataType = 'application/vnd.ms-excel';
  var tableSelect = document.getElementById(tableID);
  var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
  
  // Specify file name
  filename = filename?filename+'.xls':'excel_data.xls';
  
  // Create download link element
  downloadLink = document.createElement("a");
  
  document.body.appendChild(downloadLink);
  
  if(navigator.msSaveOrOpenBlob){
      var blob = new Blob(['\ufeff', tableHTML], {
          type: dataType
      });
      navigator.msSaveOrOpenBlob( blob, filename);
  }else{
      // Create a link to the file
      downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
  
      // Setting the file name
      downloadLink.download = filename;
      
      //triggering the function
      downloadLink.click();
  }
}




	$(document).ready(function($) 
	{ 

		$(document).on('click', '.btn_print', function(event) 
		{
			event.preventDefault();

			//credit : https://ekoopmans.github.io/html2pdf.js
			
			var element = document.getElementById('myTable'); 

			//easy
			// html2pdf().from(element).save();

			//custom file name
			// html2pdf().set({filename: 'code_with_mark_'+js.AutoCode()+'.pdf'}).from(element).save();


			//more custom settings
			var opt = 
			{
			  margin:       0.2,
			  filename:     'pageContent_'+js.AutoCode()+'.pdf',
			  image:        { type: 'jpeg', quality: 0.98 },
			  html2canvas:  { scale: 2 },
			  jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
			};

			// New Promise-based usage:
			html2pdf().set(opt).from(element).save();

		});
 
	});
	
	
	
	 function setClipboard(value) {
    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = value;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
    alert("Address copied: "+value);
}