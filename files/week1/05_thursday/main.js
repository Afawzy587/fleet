            // table

            getPagination('#table-id');
            $('#maxRows').trigger('change');
            function getPagination (table){
                
                  $('#maxRows').on('change',function(){
                      $('.pagination').html('');						// reset pagination div
                      var trnum = 0 ;									// reset tr counter 
                      var maxRows = 10;		                    	// get Max Rows from select option
                
                      var totalRows = $(table+' tbody tr').length;		// numbers of rows 
                     $(table+' tr:gt(0)').each(function(){			// each TR in  table and not the header
                         trnum++;									// Start Counter 
                         if (trnum > maxRows ){						// if tr number gt maxRows
                             
                             $(this).hide();							// fade it out 
                         }if (trnum <= maxRows ){$(this).show();}// else fade in Important in case if it ..
                     });											//  was fade out to fade it in 
                     if (totalRows > maxRows){						// if tr total rows gt max rows option
                         var pagenum = Math.ceil(totalRows/maxRows);	// ceil total(rows/maxrows) to get ..  
                         $('.pagination').append(` <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>`);						//	numbers of pages 
                         for (var i = 1; i <= pagenum ;){			// for each page append pagination li 
                         $('.pagination').append('<li class="page-item" data-page="'+i+'">\
                                              <a class="page-link">'+ i++ +'<span class="sr-only">(current)</span></a>\
                                            </li>').show();
                         }											// end for i 
             
                         $('.pagination').append(` <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
            </li>`);
                    } 												// end if row count > max rows
                    $('.pagination li:first-child').addClass('active'); // add active class to the first li 
                
                
                //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT
            //    showig_rows_count(maxRows, 1, totalRows);
                //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT
        
                $('.pagination li').on('click',function(e){		// on click each page
                e.preventDefault();
                        var pageNum = $(this).attr('data-page');	// get it's number
                        var trIndex = 0 ;							// reset tr counter
                        $('.pagination li').removeClass('active');	// remove active class from all li 
                        $(this).addClass('active');					// add active class to the clicked 
                
                
                //SHOWING ROWS NUMBER OUT OF TOTAL
            //    showig_rows_count(maxRows, pageNum, totalRows);
                //SHOWING ROWS NUMBER OUT OF TOTAL
                
                
                
                         $(table+' tr:gt(0)').each(function(){		// each tr in table not the header
                             trIndex++;								// tr index counter 
                             // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
                             if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
                                 $(this).hide();		
                             }else {$(this).show();} 				//else fade in 
                         }); 										// end of for each tr in table
                            });										// end of on click pagination list
                });
                                                    // end of on select change 
                 
                                        // END OF PAGINATION 
            
            }	
        
        
        //ROWS SHOWING FUNCTION
        // function showig_rows_count(maxRows, pageNum, totalRows) {
        //    //Default rows showing
        //         var end_index = maxRows*pageNum;
        //         var start_index = ((maxRows*pageNum)- maxRows) + parseFloat(1);
        //         var string = 'Showing '+ start_index + ' to ' + end_index +' of ' + totalRows + ' entries';               
        //         $('.rows_count').html(string);
        // }
        
        // All Table search script
        function FilterkeyWord_all_table() {
          
        // Count td if you want to search on all table instead of specific column
        
          var count = $('.table').children('tbody').children('tr:first-child').children('td').length; 
        
                // Declare variables
          var input, filter, table, tr, td, i;
          input = document.getElementById("search_input_all");
          var input_value =     document.getElementById("search_input_all").value;
                filter = input.value.toLowerCase();
          if(input_value !=''){
                table = document.getElementById("table-id");
                tr = table.getElementsByTagName("tr");
        
                // Loop through all table rows, and hide those who don't match the search query
                for (i = 1; i < tr.length; i++) {
                  
                  var flag = 0;
                   
                  for(j = 0; j < count; j++){
                    td = tr[i].getElementsByTagName("td")[j];
                    if (td) {
                     
                        var td_text = td.innerHTML;  
                        if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
                        //var td_text = td.innerHTML;  
                        //td.innerHTML = 'shaban';
                          flag = 1;
                        } else {
                          //DO NOTHING
                        }
                      }
                    }
                  if(flag==1){
                             tr[i].style.display = "";
                  }else {
                     tr[i].style.display = "none";
                  }
                }
            }else {
              //RESET TABLE
              $('#maxRows').trigger('change');
            }
        }
        
// delete confirmation
        $('.delete_confirmation_btn').on('click', function(){
            alert('delete');
        });

// addContactForm
var form = $(".addContactForm");
form.onsubmit = function() {
    alert('submitted')
}

// Master Checkbox

 $(".Master").change(function(){
     console.log($(this).attr("data-chx-type"));
    if(this.checked) {
                $("[data-chx-type="+$(this).attr("data-chx-type")+"]").prop('checked', true);
            }else{
                $("[data-chx-type="+$(this).attr("data-chx-type")+"]").prop('checked', false);
            }
});


// upload file input

$('#inputGroupFile02').on('change', function () {
    //get the file name
    var fileName = $(this).val();
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
})

$('.custom-file-input').on('change', function () {
    //get the file name
    var fileName = $(this).val();
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
})

// max chacrters
var myDiv = $('.custom-file-input');
myDiv.text(myDiv.text().substring(0,50));

// tabs
$('.nav-tabs li').on('click', function () {
  $('.nav-tabs li').not(this).removeClass('active');
  $(this).addClass('active');
});

// modal_sidenav
$('.modal_sidenav li').on('click', function () {
  $('.modal_sidenav li').not(this).removeClass('active');
  $(this).addClass('active');
});

// datepickers
$('#datepicker1').datepicker({
  uiLibrary: 'bootstrap4'
});

$('#datepicker2').datepicker({
  uiLibrary: 'bootstrap4'
});

$('#datepicker3').datepicker({
  uiLibrary: 'bootstrap4'
});

$('#datepicker4').datepicker({
  uiLibrary: 'bootstrap4'
});

$('#datepicker5').datepicker({
  uiLibrary: 'bootstrap4'
});

$('#datepicker6').datepicker({
  uiLibrary: 'bootstrap4'
});

$('#datepicker7').datepicker({
  uiLibrary: 'bootstrap4'
});

$('#datepicker8').datepicker({
  uiLibrary: 'bootstrap4'
});