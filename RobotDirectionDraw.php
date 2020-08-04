 <!DOCTYPE html>
<html>
<head>
<title>Robot Controller Page</title>

 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 
<style>
	table {
		margin-left: auto;
		margin-right: auto;
	}
	
	td , th {
		text-align: center;
		vertical-align: middle;
		height: 10px; 
		width: 10px;
	}
	
	.btns{
		height: 35px; 
		width:120px;
		border-radius: 20px;
		background-color: #006a71; 
	    color: white; 
	    border: 0px solid;
	}
	
	.btns:hover {
	  background-color: #d3de32;
	}
	
	.stopbtn{
		background-color: #d3de32;
	}
	
	.pagecontent{
		margin: auto;
		background: white;
		padding: 10px;
		text-align: center;
	}
	
	.pagebg {
		background: #d3de32;
	}
	
	.heading {
		background-color: #006a71;
		color: white;
		text-align: center;
		padding: 10px;
	}

</style>
</head>
<body class="pagebg container">
<form method="post" action="insertcode.php">			
	<div>
		<h2 class="heading">Draw Robot Steps</h1>
	</div>
	
	<div class="pagecontent">
	
	<div class="row">
	
		<?php
			require('DBPJ_cn.inc');
			require('DBPJ_db.inc');
			$conn = db_connect(); 
			
			$sqlSelect = "select F,B,R,L
						  from directions_set 
						  ORDER BY ID DESC  
						  LIMIT 1;";
			$resultSelect = db_do_query($conn, $sqlSelect);
			$num = mysql_numrows($resultSelect);
			
			
		
			mysql_close();	
		?>	
		
		<div class="col-sm-6">
			<div>
				<h4 class="heading">Enter the values for each direction</h1>
			</div>
			<table class="table table-bordered">
				<tbody>
				  <tr>
					<td><label>Forward</label></td>
					<td><input type="text" name="Forward" id="Forward"></td>
				  </tr>
				  <tr>
					<td><label>Right</label></td>
					<td><input type="text" name="Right" id="Right"></td>
				  </tr>
				  <tr>
					<td><label>Left</label></td>
					<td><input type="text" name="Left" id="Left"></td>
				  </tr>
				  <tr>
					<td><label>Backward</label></td>
					<td><input type="text" name="Backward" id="Backward"></td>
				  </tr>
				</tbody>
			</table>
				<div class="row">
					<div class="col-sm-4">
						<div>	
							<button class="btns" type="sumbit" name="save">Save</button>

						</div>
						</br>
					</div>
					<div class="col-sm-4">
						<div>	
							<button class="btns" type="reset" name="send" >Reset</button>
						</div>
					</div>
					
					<div class="col-sm-4">
						<div>	
							<button class="btns" type="button" name="show" onclick="myFunction2()">Show Last Steps</button>
							<script>
								function myFunction2() {
									 document.getElementById('MyDiv').style.display = "block";
								}
							</script>
						</div>
					</div>

					</br>
				</div>
			</div>

		
		<div class="col-sm-6">
			<div>
				<h4 class="heading">Last Directions Values</h1>
			</div>
			<?php
			$i=0;
			while ($i < $num) {
					$F = mysql_result($resultSelect, $i, "F");
					$B = mysql_result($resultSelect, $i, "B");
					$R = mysql_result($resultSelect, $i, "R");
					$L = mysql_result($resultSelect, $i, "L");
				 //The while loop continues
			?>
			<div id="MyDiv" style="display:none;">
			<table class="table table-bordered">
				<tbody>
				  <tr>
					<td><label>Forward</label></td>
					<td><input disabled="disabled" type="text" name="dForward" value="<?php echo $F; ?>"></td>
				  </tr>
				  <tr>
					<td><label>Right</label></td>
					<td><input disabled="disabled" type="text" name="dRight" value="<?php echo $R; ?>"></td>
				  </tr>
				  <tr>
					<td><label>Left</label></td>
					<td><input disabled="disabled" type="text" name="dLeft" value="<?php echo $L; ?>"></td>
				  </tr>
				  <tr>
					<td><label>Backward</label></td>
					<td><input disabled="disabled" type="text" name="dBackward" value="<?php echo $B; ?>"></td>
				  </tr>
				</tbody>
			</table>
			</div>
			<?php
				$i++;
			} // end while
			?>
		
			<div class="row">
				<div class="col-sm-12">
					<div>	
						<button class="btns" type="button" name="show" onclick="myFunction()">Show Drwaings</button>
						<script>
							function myFunction() {
								 document.getElementById('myCanvas').style.display = "block";
							}
						</script>
					</div>
					</br>
				</div>
				</br>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-12">
			<div>
				<h3 class="heading">The Robot Movemnt Line Draw</h1>
			</div>
			
			<div>
				<canvas style="display:none;" id="myCanvas" width="700" height="300" style="border:1px solid #d3d3d3;"></canvas>
					<?php
					
					?>
					 <script>
							var c = document.getElementById("myCanvas");
							var ctx = c.getContext("2d");
							
							ctx.beginPath();
							
							ctx.moveTo(0, 10);
							ctx.lineTo(<?php echo $F; ?>, 10 );
							ctx.lineTo(<?php echo $F; ?>, 10+<?php echo $R; ?>);
							ctx.lineTo(<?php echo $F; ?>+<?php echo $L; ?>, 10+<?php echo $R; ?>);
							ctx.lineTo(<?php echo $L; ?>+<?php echo $F; ?>, 10+<?php echo $R; ?>+<?php echo $B; ?>);
							ctx.stroke();
						  
					</script

			</div>	
			</br>
		
		</div>
		</br>
	</div>
	</br>
</form>
</body>
</html>
