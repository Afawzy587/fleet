$('#AddDocBtn').click(function( event ) {
      
  if($("#add_doc_form").valid()){
    console.log('valid');
    var docName = $('input[name="doc_name"]')[0].value;
    var date1Name = $('input[name="date_input_name"]')[0].value;
    var date2Name = $('input[name="date2_input_name"]')[0].value;
    var imgBtnName = $('input[name="imageBtn_name"]')[0].value;
    var valueInputItem = $('input[name="value_input_name"]')[0].value;
    
    var newDocItem = $('.document_item:first').clone();
    newDocItem.find('p.document_title')[0].innerText = docName;
    newDocItem.find('input[name="doc_title"]')[0].value = docName;
    newDocItem.find('label[for="date1"]')[0].innerText = date1Name;
    newDocItem.find('label[for="date2"]')[0].innerText = date2Name;
    newDocItem.find('label[class*="image_upload_btn"]')[0].innerText = imgBtnName;
    newDocItem.find('label[for="value_input"]')[0].innerText = valueInputItem;
    
        $('#AddDocModal').modal('hide');
        $('.documents_list').append(newDocItem);  
  } else console.log('not valid')

});

$("#add_doc_form").validate({
  rules: {
      doc_name: "required",
      date_input_name : "required",
      date2_input_name: "required",
      imageBtn_name: "required" ,
      value_input_name: "required"
  },
  messages: {
    doc_name: "أدخل اسم الوثيقة",
    date_input_name : "أدخا اسم التاريخ الأول",
    date2_input_name: "أدخل اسم التاريخ الثاني",
    imageBtn_name: "أدخل اسم زر الصورة" ,
    value_input_name: "أدخل اسم القيمة"
  }
});