<div id="members">
	<?php
		$query = 'SELECT mate FROM flatmates ORDER BY mate ASC';
		$result = mysqli_query($con,$query);
		while($row = mysqli_fetch_array($result)){
			echo "<div class='panel card'><h6>".$row[0]."</h6>";
			$query2 = 'SELECT AVG(transaction),COUNT(*),MAX(transaction),MIN(transaction),MIN(date),MAX(date),SUM(transaction) FROM `transactions` WHERE name= "'.$row[0].'"';
			$result2 = mysqli_query($con,$query2);
			$m = date("m");
			$m--;
			$start = date("Y-$m-00 H:m:s");
			$end = date("Y-m-00 H:m:s");
			$m1 = $m-1;
			$start1 = date("Y-$m1-00 H:m:s");
			$end1 = date("Y-$m-00 H:m:s");
			$m2 = $m-2;
			$start2 = date("Y-$m2-00 H:m:s");
			$end2 = date("Y-$m1-00 H:m:s");
			$now = date("Y-m-d H:m:s");
			$thismonth = date("Y-m-00 H:m:s");
			$query3 = 'SELECT SUM(transaction) FROM `transactions` WHERE name= "'.$row[0].'" AND date>="'.$start.'" AND date<="'.$end.'"';
			$result3 = mysqli_query($con,$query3);
			$row3 = mysqli_fetch_array($result3);
			$query4 = 'SELECT SUM(transaction) FROM `transactions` WHERE name= "'.$row[0].'" AND date>="'.$start1.'" AND date<="'.$end1.'"';
			$result4 = mysqli_query($con,$query4);
			$row4 = mysqli_fetch_array($result4);
			$query5 = 'SELECT SUM(transaction) FROM `transactions` WHERE name= "'.$row[0].'" AND date>="'.$start2.'" AND date<="'.$end2.'"';
			$result5 = mysqli_query($con,$query5);
			$row5 = mysqli_fetch_array($result5);
			$queryN = 'SELECT SUM(transaction) FROM `transactions` WHERE name= "'.$row[0].'" AND date>="'.$thismonth.'" AND date<="'.$now.'"';
			$resultN = mysqli_query($con,$queryN);
			$rowN = mysqli_fetch_array($resultN);

			if($row3[0]<=0)
				$row3[0]=0;
			if($row4[0]<=0)
				$row4[0]=0;
			if($row5[0]<=0)
				$row5[0]=0;
			if($rowN[0]<=0)
				$rowN[0]=0;

			$queryM = 'SELECT COUNT(mate) FROM `flatmates`';
			$resultM = mysqli_query($con,$queryM);
			$rowM = mysqli_fetch_array($resultM);
			$query6 = 'SELECT SUM(transaction) FROM `transactions` WHERE date>="'.$start.'" AND date<="'.$end.'"';
			$result6 = mysqli_query($con,$query6);
			$row6 = mysqli_fetch_array($result6);
			$query7 = 'SELECT SUM(transaction) FROM `transactions` WHERE date>="'.$start1.'" AND date<="'.$end1.'"';
			$result7 = mysqli_query($con,$query7);
			$row7 = mysqli_fetch_array($result7);
			$query8 = 'SELECT SUM(transaction) FROM `transactions` WHERE date>="'.$start2.'" AND date<="'.$end2.'"';
			$result8 = mysqli_query($con,$query8);
			$row8 = mysqli_fetch_array($result8);
			$queryC = 'SELECT SUM(transaction) FROM `transactions` WHERE date>="'.$thismonth.'" AND date<="'.$now.'"';
			$resultC = mysqli_query($con,$queryC);
			$rowC = mysqli_fetch_array($resultC);

			$queryStats = 'SELECT lastcleared FROM `stats`';
			$resultStats = mysqli_query($con,$queryStats);
			$lastcleared = mysqli_fetch_array($resultStats);

			$queryStats = 'SELECT SUM(transaction) FROM `transactions` WHERE date>"'.$lastcleared[0].'"';
			$resultStats = mysqli_query($con,$queryStats);
			$totalSpentSinceLastCleared = mysqli_fetch_array($resultStats);
			
			$queryStats = 'SELECT SUM(transaction) FROM `transactions` WHERE name="'.$row[0].'" AND date>"'.$lastcleared[0].'"';
			$resultStats = mysqli_query($con,$queryStats);
			$spentSinceLastCleared = mysqli_fetch_array($resultStats);

			echo "$lastcleared[0] $totalSpentSinceLastCleared[0] $spentSinceLastCleared[0]";
			
			$row6[0]/=$rowM[0];
			$row7[0]/=$rowM[0];
			$row8[0]/=$rowM[0];
			$rowC[0]/=$rowM[0];
			$totalSpentSinceLastCleared[0]/=$rowM[0];

			$bal1m = $row3[0] - $row6[0];
			$bal2m = $row4[0] - $row7[0];
			$bal3m = $row5[0] - $row8[0];
			$balN = $rowN[0] - $rowC[0];
			$balSinceLastCleared = $spentSinceLastCleared[0] - $totalSpentSinceLastCleared[0];

			echo "<table class='stats' style='width: 100%;'><br><br>";
			while($row2 = mysqli_fetch_array($result2)){
				echo "<tr><td class='item' style='width: 51%;'>Average expenses</td><td class='transaction' style='width: 49%; font-weight: bold;'>Rs. $row2[0]</td></tr>";
				echo "<tr><td class='item' style='width: 51%;'>Number of expenses</td><td class='transaction' style='width: 49%; font-weight: bold;'>$row2[1]</td></tr>";
				echo "<tr><td class='item' style='width: 51%;'>Maximum expenses</td><td class='transaction' style='width: 49%; font-weight: bold;'>Rs. $row2[2]</td></tr>";
				echo "<tr><td class='item' style='width: 51%;'>Minimum expenses</td><td class='transaction' style='width: 49%; font-weight: bold;'>Rs. $row2[3]</td></tr>";
				echo "<tr><td class='item' style='width: 51%;'>First expenses on</td><td class='transaction' style='width: 49%; font-weight: bold;'>$row2[4]</td></tr>";
				echo "<tr><td class='item' style='width: 51%;'>Last expenses on</td><td class='transaction' style='width: 49%; font-weight: bold;'>$row2[5]</td></tr>";
				echo "<tr><td class='item' style='width: 51%;'>Total expenses sum</td><td class='transaction' style='width: 49%; font-weight: bold;'>Rs. $row2[6]</td></tr>";
				echo "<tr><td class='item' style='width: 51%;'>Spent <span style='font-weight: bold;'>last month<span> </td><td class='transaction' style='width: 49%; font-weight: bold;'>Rs. $row3[0]</td></tr>";
				echo "<tr><td class='item' style='width: 51%;'>Spent <span style='font-weight: bold; color: #555;'>2 months</span> back</td><td class='transaction' style='width: 49%; font-weight: bold;'>Rs. $row4[0]</td></tr>";
				echo "<tr><td class='item' style='width: 51%;'>Spent <span style='font-weight: bold; color: #777;'>3 months</span> back</td><td class='transaction' style='width: 49%; font-weight: bold;'>Rs. $row5[0]</td></tr>";
				echo "<tr><td class='item' style='width: 51%;'>Balance <span style='font-weight: bold;'>last month</span></td><td class='transaction' style='width: 49%; font-weight: bold;'>Rs. $bal1m</td></tr>";
				echo "<tr><td class='item' style='width: 51%;'>Balance <span style='font-weight: bold; color: #555;'>2 months</span> back</td><td class='transaction' style='width: 49%; font-weight: bold;'>Rs. $bal2m</td></tr>";
				echo "<tr><td class='item' style='width: 51%;'>Balance <span style='font-weight: bold; color: #777;'>3 months</span> back</td><td class='transaction' style='width: 49%; font-weight: bold;'>Rs. $bal3m</td></tr>";
				echo "<tr><td class='item' style='width: 51%;'>Expense <span style='font-weight: bold; color: #700;'>this month</span></td><td class='transaction' style='width: 49%; font-weight: bold;'>Rs. $rowN[0]</td></tr>";
				echo "<tr><td class='item' style='width: 51%;'>Balance <span style='font-weight: bold; color: #700;'>this month</span></td><td class='transaction' style='width: 49%; font-weight: bold;'>Rs. $balN</td></tr>";
				echo "<tr><td class='item' style='width: 51%;'>Expense <span style='font-weight: bold; color: #700;'>since last cleared</span></td><td class='transaction' style='width: 49%; font-weight: bold;'>Rs. $spentSinceLastCleared[0]</td></tr>";
				echo "<tr><td class='item' style='width: 51%;'>Balance <span style='font-weight: bold; color: #700;'>since last cleared</span></td><td class='transaction' style='width: 49%; font-weight: bold;'>Rs. $balSinceLastCleared</td></tr>";
				
			}
			echo "</table></div>";
		}
	?>
</div>
<style>
	ul li:nth-child(2){
		background-color: #999;
	}
	ul li:nth-child(2) a{
		color: white;
	}
</style>