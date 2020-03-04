$(document).ready(function(){
    
    
    $( ".add_information" ).click(function()
    {
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file',files);
        var name    = $(this).closest("form").find("input[name='name']").val();
        var address = $(this).closest("form").find("input[name='address']").val();
        var phone   = $(this).closest("form").find("input[name='phone']").val();
        var page    = "system_information_js.php?do=add_information";
        jQuery.ajax( 
        {
            async :true,
            type  :"POST",
            url   :page,
            data  :"name=" + name + "&address=" + address + "&phone=" + phone,
            success : function(responce) {
                if(responce == 100)
                {
                    $("#company_information").animate({height: 'auto', opacity: '0.2'}, "slow");
                    $("#company_information").animate({width: 'auto', opacity: '0.9'}, "slow");
                    $("#company_information").animate({height: 'auto', opacity: '0.2'}, "slow");
                    $("#company_information").animate({width: 'auto', opacity: '1'}, "slow");
                }
            },
            error : function() {
                return true;
            }
        });    
    }); 
    
    $( ".add_name" ).click(function()
    {
        var name    = $(this).closest("form").find("input[name='name']").val();
        var table   = $(this).closest("form").find("input[name='in']").val();
        var page    = "system_information_js.php?do=add_name";
        if(name != "")
        {
            jQuery.ajax( 
            {
                async :true,
                type  :"POST",
                url   :page,
                data  :"name=" + name + "&table=" + table ,
                success : function(responce) {
                    if(responce == 100)
                    {
                        $("#"+table).animate({height: 'auto', opacity: '0.2'}, "slow");
                        $("#"+table).animate({width: 'auto', opacity: '0.9'}, "slow");
                        $("#"+table).animate({height: 'auto', opacity: '0.2'}, "slow");
                        $("#"+table).animate({width: 'auto', opacity: '1'}, "slow");

                    }else if(responce == 400){
                        alert(" تم تسجيل العنصر مسبقا ")
                    }
                },
                error : function() {
                    return true;
                }
            }).done(function()
            {
                $.ajax({
            type:'POST',
            url:'system_information_js.php?do=select_data',
            data:'table='+table,
            success:function(html){
                $('div.'+table).html(html);
                                  }
               });
            }); 
        }else{
            alert('insert name')
        }
           
    });
    
    $('i.delete').click(function(e){
        e.preventDefault();
		page ="system_information_js.php?do=delete_name";
		id   = $(this).attr('id');
        details = id.split('_');
        table   = details[0];
		if (id != "")
		{
			jQuery.ajax( {
				async :true,
				type :"POST",
				url :page,
				data: "details=" + id + "",
				success : function(responce) {
					if(responce == 100)
                    {
                        $("#"+table).animate({height: 'auto', opacity: '0.2'}, "slow");
                        $("#"+table).animate({width: 'auto', opacity: '0.9'}, "slow");
                        $("#"+table).animate({height: 'auto', opacity: '0.2'}, "slow");
                        $("#"+table).animate({width: 'auto', opacity: '1'}, "slow");

                    }
				},
				error : function() {
					return true;
				}
			}).done(function()
            {
                $.ajax({
                    type:'POST',
                    url:'system_information_js.php?do=select_data',
                    data:'table='+table,
                    success:function(html){
                        $('div.'+table).html(html);
                                          }
                       });
            }); ;
		}else{
            alert(" can't delete this item")
        }
	});
});
