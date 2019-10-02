<!DOCTYPE html>
<html>
<head>
	<title>Todo Aps</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
	<div id="app">
      	<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<form>
						<br>
						<br>
						<h1 class="text-center">Todolist</h1>
						{{ csrf_field() }}
						<hr>
						<div class="row">
							<div class="col-md-10">
								<input type="text" class="form-control" placeholder="Input todolist" name="todo" id="todo" >
							</div>
							<div class="col-md-2">
								<button type="button" id="submitTODO" class="btn btn-primary" onclick="createList()">Create List</button>
							</div>
						</div>
						<hr>
					</form>
					<ul class="list-group" id="dataList">
						
					</ul>
				</div>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			get_list();
		});
	</script>

	<script>
		var _token = $('input[name="_token"]').val();

		function get_list()
		{
			$.ajax({
				url: '/lists/getLists',
				type: 'GET',
				success: function(results) {
					var result = JSON.parse(results);
					var data = result.data;
					var html = '';
					for (var i = 0; i < data.length; i++) {
						var obj = data[i];

						html +=  '<li class="list-group-item">'+ obj.list_name +'<button type="button" class="btn btn-danger float-right" onclick="deleteList('+obj.id+')">×</span>'+'</button>'+'</li>';

						$('#dataList').html(html);
					}
				}
			});
		}

		function createList()
		{
			var list = $('#todo').val();

			if (list != "") {
				$.ajax({
					url: 'lists',
					type: 'POST',
					data: {_token : _token, todo:list},
					success: function(results)
					{
						$('#todo').val('');
						get_list();
						// alert('You have a new List!');
					}
				});
			} else {
				alert("Fill list field!");
			}
		}

		function deleteList(id)
		{
			$.ajax({
				url: 'lists/' + id,
				type: 'DELETE',
				data: { _token : _token },
				success: function(results)
				{
					$('#dataList').html('');
					get_list();
				}
			});
		}


	</script>
</body>
</html>