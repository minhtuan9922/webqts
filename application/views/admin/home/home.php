<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Home</a>
			</li>
		</ol>
	</nav>
	<div class="main">
		<h2>Chào mừng bạn đến với trang quản trị.</h2>
		<div id="chart_div"></div>
	</div>
</div>
<script>
	google.charts.load('current', {packages: ['corechart', 'bar']});
	google.charts.setOnLoadCallback(drawBasic);

	function drawBasic() {

	  var data = new google.visualization.DataTable();
	  data.addColumn('number', 'Time of Day');
	  data.addColumn('number', 'Tổng lượt truy cập');

	  data.addRows([
		  <?php
		  if(!empty($view))
		  {
			  foreach($view as $item)
			  {
				  echo '['.$item['day'].', '.$item['total'].'],';
			  }
		  }
		  ?>
	  ]);

	  var options = {
		title: 'Thống kê truy cập hàng ngày',
		hAxis: {
		  title: 'Thống kê truy cập',
		  //format: 'd-m-Y',
		  viewWindow: {
//			min: [7, 30, 0],
//			max: [17, 30, 0]
		  }
		},
		vAxis: {
		  //title: 'Rating (scale of 1-10)'
		}
	  };

	  var chart = new google.visualization.ColumnChart(
		document.getElementById('chart_div'));

	  chart.draw(data, options);
	}
</script>