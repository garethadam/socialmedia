function showResult(searchtxt)
	{
			if (searchtxt !== '')
				{
					$.ajax ( {
					type: "POST",
					url: "../../controller/result.php",
					data: {
						search: searchtxt
						},
					dataType:"text",
					cache: false,
					success: function(data)
					{
						$("#result").html(data).show();
					}
					} );
					 if (event.keyCode == 13)
						{
						window.location = "../html/search.php?search="+searchtxt;
						}
				}
			else
				{
					$("#result").html("").hide();
				}
		}
