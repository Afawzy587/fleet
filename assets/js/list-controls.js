$(document).ready(function(){
    $(".add_information").click(function(){
        
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
    $(".edit_group").click(function(){
        var id                 = $(this).attr('id');
        var name               = $("#name_"+id).val();
        var description        = $("#description_"+id).val();
        var page               = "system_information_js.php?do=edit_group";
        if(name != "")
        {
            if(description != "")
            {
                jQuery.ajax( 
                {
                    async :true,
                    type  :"POST",
                    url   :page,
                    data  :"name=" + name + "&description=" + description +"&id=" +id,
                    success : function(responce) {
                        if(responce == 100)
                        {
                            location.reload(true);
                        }else if(responce == 400)
                            {
                                alert('insert before')
                            }
                    },
                    error : function() {
                        return true;
                    }
                });        
            }
        }
        
    });
    $(".add_group").click(function(){
        
        var name        = $(this).closest("form").find("input[name='name']").val();
        var description = $(this).closest("form").find("textarea[name='description']").val();
        var page    = "system_information_js.php?do=add_group";
        if(name != "")
        {
            if(description != "")
            {
                jQuery.ajax( 
                {
                    async :true,
                    type  :"POST",
                    url   :page,
                    data  :"name=" + name + "&description=" + description,
                    success : function(responce) {
                        if(responce == 100)
                        {
                            location.reload(true);
                        }else if(responce == 400)
                            {
                                alert('insert before')
                            }
                    },
                    error : function() {
                        return true;
                    }
                });        
            }
        }
        
    });
    $(".add_name").click(function(){
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

                    }else{
                        alert(responce)
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
                        $('#select_'+table).html(html);
                                          }
                       });
                    }).done(function()
                    {
                        $.ajax({
                            type:'POST',
                            url:'system_information_js.php?do=delete_data_refrish',
                            data:'table='+table,
                            success:function(html){
                                $('ul.'+table+'_delete').html(html);
                                                  }
                               });
                            }); 
        }else{
            alert('insert name')
        }
           
    });
    $('div.delete').on('click','i.delete_name',function(){
		page ="system_information_js.php?do=delete_name";
		id   = $(this).attr('id');
        details = id.split('-');
        table   = details[0];
        if (confirm($('#'+table+'_lang_del').val()))
		{
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
                            $("#li_"+id).animate({height: 'auto', opacity: '0.2'}, "slow");
                            $("#li_"+id).animate({width: 'auto', opacity: '0.9'}, "slow");
                            $("#li_"+id).animate({height: 'auto', opacity: '0.2'}, "slow");
                            $("#li_"+id).animate({width: 'auto', opacity: '1'}, "slow");
                            $("#li_" + id).fadeTo(400, 0, function () { $("#li_" + id).slideUp(400);});
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
                            $('#select_'+table).html(html);
                                              }
                           });
                }); ;
            }else{
                alert(" can't delete this item")
            }
        }
	});
    $('select.select_item').on('change',function(){
        var t_id       = $(this).val();
        var details    = t_id.split('-');
        var table      = details[0];
        var page  ="system_information_js.php?do=edit_name";
        if(t_id){
            $.ajax({
                type:'POST',
                url:page,
                data:'details='+t_id,
                success:function(html){
                    $('div#'+table+'_edit_name').html(html);
                                      }
                   });
        }
	});
    $(".update_name").click(function(){
        var name    = $(this).closest("form").find("input[name='name']").val();
        var id      = $(this).closest("form").find("input[name='id']").val();
        var table   = $(this).closest("form").find("input[name='in']").val();
        var page    = "system_information_js.php?do=update_name";
        if(name != "")
        {
            jQuery.ajax( 
            {
                async :true,
                type  :"POST",
                url   :page,
                data  :"name=" + name + "&table=" + table +"&id=" + id ,
                success : function(responce) {
                    if(responce == 100)
                    {
                        $("#"+table).animate({height: 'auto', opacity: '0.2'}, "slow");
                        $("#"+table).animate({width: 'auto', opacity: '0.9'}, "slow");
                        $("#"+table).animate({height: 'auto', opacity: '0.2'}, "slow");
                        $("#"+table).animate({width: 'auto', opacity: '1'}, "slow");

                    }else{
                        alert(responce)
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
                        $('#select_'+table).html(html);
                                          }
                       });
                    }).done(function()
                    {
                        $.ajax({
                            type:'POST',
                            url:'system_information_js.php?do=delete_data_refrish',
                            data:'table='+table,
                            success:function(html){
                                $('ul.'+table+'_delete').html(html);
                                                  }
                               }).done('select.select_item');
                            }); 
        }else{
            alert('insert name')
        }
           
    });
    $("#but_upload").click(function(){

        var fd = new FormData();

        var files = $('#file')[0].files[0];

        fd.append('image',files);
        var page    = "system_information_js.php?do=upload_logo";
        $.ajax({
            url:page,
            type:'post',
            data:fd,
            contentType: false,
            processData: false,
            success:function(response){
                if(response == 100)
                    {
                        $("#company_logo").animate({height: 'auto', opacity: '0.2'}, "slow");
                        $("#company_logo").animate({width: 'auto', opacity: '0.9'}, "slow");
                        $("#company_logo").animate({height: 'auto', opacity: '0.2'}, "slow");
                        $("#company_logo").animate({width: 'auto', opacity: '1'}, "slow");

                    }else{
                        alert(responce)
                    }
            }
        });
    });
    $('button.delete').click(function(e){
        e.preventDefault();
		var table            = $('#table').val();
		var permission       = $('#permission').val();
		var id               = $(this).attr('id').replace("item_","");
        var number           = $(this).parent('div').attr('id').replace("item_","");
        var page             = "system_information_js.php?do=delete_data";
		if (id != 0)
		{
			jQuery.ajax( {
				async :true,
				type :"POST",
				url :page,
				data: "&id=" + id + "&permission="+permission+"&table="+table,
				success : function(responce) {
                    if(responce == 100)
                        {
                            $("#tr_"+id).animate({height: 'auto', opacity: '0.2'}, "slow");
                            $("#tr_"+id).animate({width: 'auto', opacity: '0.9'}, "slow");
                            $("#tr_"+id).animate({height: 'auto', opacity: '0.2'}, "slow");
                            $("#tr_"+id).animate({width: 'auto', opacity: '1'}, "slow");
                            $("#tr_"+id).fadeTo(400, 0, function () { $("#tr_" + id).slideUp(400);});
                        }
                    
				
				},
				error : function() {
					return true;
				}
			});
		}
	});
	$("button.checkall").on("click", function(){
      $("#checkhour").prop("checked");
    });
    $(".update_user_group").click(function(){
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
    $(".edit_expenses").click(function(){
        var id                 = $(this).attr('id');
        var name               = $("#myInput_"+id).val();
        var page               = "system_information_js.php?do=edit_expenses";
        if(name != "")
        {
			jQuery.ajax( 
			{
				async :true,
				type  :"POST",
				url   :page,
				data  :"name=" + name +"&id=" +id,
				success : function(responce) {
					if(responce == 100)
					{
						location.reload(true);
					}else if(responce == 400)
						{
							alert('insert before')
						}
				},
				error : function() {
					return true;
				}
			});        
        }
        
    });	 
	$(".add_expenses").click(function(){
        var name               = $("#myInput").val();
        var page               = "system_information_js.php?do=add_expenses";
        if(name != "")
        {
			jQuery.ajax( 
			{
				async :true,
				type  :"POST",
				url   :page,
				data  :"name=" + name,
				success : function(responce) {
					if(responce == 100)
					{
						location.reload(true);
					}else if(responce == 400)
						{
							alert('insert before')
						}
				},
				error : function() {
					return true;
				}
			});        
        }
        
    });	
	$(".delete_expenses").click(function(){
        var id                 = $(this).attr('id');
        var page               = "system_information_js.php?do=delete_expenses";
        if(id != "")
        {
			jQuery.ajax( 
			{
				async :true,
				type  :"POST",
				url   :page,
				data  :"&id=" +id,
				success : function(responce) {
					if(responce == 100)
					{
						location.reload(true);
					}else 
						{
							alert('not  delete')
						}
				},
				error : function() {
					return true;
				}
			});        
        }
        
    });
    $('select.project').on('change',function(){
	var projectID = $(this).val();
	if(projectID){
		$.ajax({
			type:'POST',
			url:'system_information_js.php?do=route',
			data:'project='+projectID,
			success:function(html){
				$('select#route').html(html);
								  }
			   });
				  }
	});
    $('.add_other').click(function() {
        $('[name="add_other"]').val('1');
    });
    $(".delete_services").click(function(){
        var id                 = $(this).attr('id');
        var page               = "system_information_js.php?do=delete_services";
        if(id != "")
        {
			jQuery.ajax( 
			{
				async :true,
				type  :"POST",
				url   :page,
				data  :"&id=" +id,
				success : function(responce) {
					if(responce == 100)
					{
						location.reload(true);
					}else 
						{
							alert('not  delete')
						}
				},
				error : function() {
					return true;
				}
			});        
        }
        
    });
	$(".end_damage").click(function(){
        var id                 = $(this).attr('id');
        var page               = "system_information_js.php?do=end_damage";
        if(id != "")
        {
			jQuery.ajax( 
			{
				async :true,
				type  :"POST",
				url   :page,
				data  :"&id=" +id,
				success : function(responce) {
					if(responce == 100)
					{
						$("#tr_"+id).animate({height: 'auto', opacity: '0.2'}, "slow");
                        $("#tr_"+id).animate({width: 'auto', opacity: '0.9'}, "slow");
                        $("#tr_"+id).animate({height: 'auto', opacity: '0.2'}, "slow");
                        $("#tr_"+id).animate({width: 'auto', opacity: '1'}, "slow");
						
						setTimeout(location.reload(true), 1000);
					}else 
					{
						alert('not  end')
					}
				},
				error : function() {
					return true;
				}
			});        
        }
        
    });
    $('select.select_type').on('change',function(){
        var id    = $(this).val();
        var page  ="system_information_js.php?do=type_max";
        if(id){
            $.ajax({
                type:'POST',
                url:page,
                data:'id='+id,
                success:function(data)
                {
                                            alert(data)

                    if(data > 0)
                    {
                        $('#car_number').setAttribute("max",data); 
                    }else{
                        $('#car_number').setAttribute("placeholder",data); 
                    }
                    
                }
                });
        }
	});
});
