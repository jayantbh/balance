<div id="members">
	<?php
		$query = 'SELECT mate FROM flatmates ORDER BY mate ASC';
		$result = mysqli_query($con,$query);
		while($row = mysqli_fetch_array($result)){
			echo "<div class='panel card'><h6>".$row[0]."<br><span class='add' data-user='".$row[0]."' title='Add new entry'>+</span> <span class='sub' data-user='".$row[0]."' title='Remove last entry'>-</span></h6>";
			echo "<input id='stuff' style='width: 60%; margin-top: 10px; text-align: center;' data-user='".$row[0]."' placeholder='".$row[0]."'><input id='trans' style='width: 15%; margin-top: 10px; text-align: center;' placeholder='$$$' data-user='".$row[0]."'>";
			$query2 = 'SELECT item,transaction,`date` FROM transactions WHERE name = "'.$row[0].'" ORDER BY DATE DESC LIMIT 0,15';
			$result2 = mysqli_query($con,$query2);
			echo "<table style='width: 100%;'><br><br>";
			while($row2 = mysqli_fetch_array($result2)){
				echo "<tr title='Time: ".$row2[2]."'><td class='item' style='width: 90%;'>$row2[0]</td><td class='transaction' style='width: 10%; font-weight: bold;'>$row2[1]</td></tr>";
			}
			echo "</table></div>";
		}
	?>
</div>
<style>
	ul li:nth-child(1){
		background-color: #999;
		border-radius: 5px 0px 0px 5px;
	}
	ul li:nth-child(1) a{
		color: white;
	}
</style>