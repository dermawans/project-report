$(document).ready(function() {
            var count = 0;
 
            $("#add_item_in").click(function(){
                    count += 1;
                $('#container').append(
                           '<tr class="records">'
                         + '<th><div id="'+count+'">' + count + '</div></th><input id="id_item_' + count + '" name="id_item_' + count + '" value="I_'+ count +'" type="hidden" readonly></th>'
                         + '<th><select id="id_category_'+ count +'" name="id_category_'+ count +'"><option value="1">Terminal</option><option value="2">Power Adaptor Terminal</option><option value="3">Printer</option><option value="4">Power Adaptor Printer</option><option value="5">Router</option><option value="6">Power Adaptor Router</option><option value="7">Modem</option><option value="8">SIM Card</option><option value="9">Other</option></select></th>'
                         + '<th><input id="item_name_' + count + '" name="item_name_' + count + '" type="text"></th>'
                         + '<th><input id="esn_' + count + '" name="esn_' + count + '" type="text"></th>'
                         + '<th><input id="sn_' + count + '" name="sn_' + count + '" type="text"></th>'
                         + '<th><input id="total_' + count + '" name="total_' + count + '" type="text"></th>'
                         + '<th><input id="status_' + count + '" name="status_' + count + '" type="text"></th>'
                         + '<th><input id="contents_' + count + '" name="contents_' + count + '" type="text"></th>'
						 + '<th><textarea id="note_' + count + '" name="note_'+ count +'"></textarea>'
                         + '<th><a class="remove_item btn btn-xs btn-danger" href="#" >Delete</a>'
						 + '<input id="additemin_' + count + '" name="additemin[]" value="'+ count +'" type="hidden"></th></tr>'
                    );
                });
				
                /*$(".remove_item").live('click', function (ev) {
                if (ev.type == 'click') {
                $(this).parents(".records").fadeOut();
                        $(this).parents(".records").remove();
            	}
            	});*/
				$("body").on('click', '.remove_item', function (ev) {
                if (ev.type == 'click') {
                $(this).parents(".records").fadeOut();
                        $(this).parents(".records").remove();
				}
           		 });
				
        });
		
		
                       