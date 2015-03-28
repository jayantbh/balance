<?php
	$d1=new DateTime("2014-10-01 00:00:00"); $d2=new DateTime(date("Y-m-d H:m:s")); $monthsTillNow = $d1->diff($d2)->m+$d1->diff($d2)->y*12;

	$m = date("m");
	$m--;
	$start = date("Y-$m-00 H:m:s");
	$end = date("Y-m-00 H:m:s");
	$now = date("Y-m-d H:m:s");
	$thismonth = date("Y-m-00 H:m:s");

	$m1 = $m-1;
	$start1 = date("Y-$m1-00 H:m:s");
	$end1 = date("Y-$m-00 H:m:s");
	$m2 = $m-2;
	$start2 = date("Y-$m2-00 H:m:s");
	$end2 = date("Y-$m1-00 H:m:s");

	$query = 'SELECT SUM(transaction) FROM `transactions` WHERE date>="'.$start.'" AND date<="'.$end.'"';
	$result = mysqli_query($con,$query);
	$explm = mysqli_fetch_array($result);
	$query = 'SELECT SUM(transaction) FROM `transactions` WHERE date>="'.$thismonth.'" AND date<="'.$now.'"';
	$result = mysqli_query($con,$query);
	$expnow = mysqli_fetch_array($result);
	$change = $expnow[0]/$explm[0]*100;

	$query = 'SELECT SUM(transaction) FROM `transactions` WHERE date>="'.$start1.'" AND date<="'.$end1.'"';
	$result = mysqli_query($con,$query);
	$exp2mo = mysqli_fetch_array($result);
	$query = 'SELECT SUM(transaction) FROM `transactions` WHERE date>="'.$start2.'" AND date<="'.$end2.'"';
	$result = mysqli_query($con,$query);
	$exp3mo = mysqli_fetch_array($result);
	$change2 = $explm[0]/$exp2mo[0]*100;

	$query = 'SELECT SUM(transaction) from transactions';
	$result = mysqli_query($con,$query);
	$totexp = mysqli_fetch_array($result);

	$query = 'SELECT COUNT(*) from transactions';
	$result = mysqli_query($con,$query);
	$numexp = mysqli_fetch_array($result);

	$query = 'SELECT MAX(transaction) from transactions';
	$result = mysqli_query($con,$query);
	$maxexp = mysqli_fetch_array($result);

	$query = 'SELECT MIN(transaction) from transactions';
	$result = mysqli_query($con,$query);
	$minexp = mysqli_fetch_array($result);

	$query = 'SELECT AVG(transaction) from transactions';
	$result = mysqli_query($con,$query);
	$avgexp = mysqli_fetch_array($result);

	$query = 'SELECT name,COUNT(*) as ent FROM `transactions` group by name order by count(*) DESC LIMIT 1';
	$result = mysqli_query($con,$query);
	$maxpur = mysqli_fetch_array($result);

	$query = 'SELECT name,COUNT(*) as ent FROM `transactions` group by name order by count(*) ASC LIMIT 1';
	$result = mysqli_query($con,$query);
	$lespur = mysqli_fetch_array($result);

	$query = 'SELECT name,SUM(transaction) FROM `transactions` group by name order by SUM(transaction) DESC LIMIT 1';
	$result = mysqli_query($con,$query);
	$higexp = mysqli_fetch_array($result);

	$query = 'SELECT name,SUM(transaction) FROM `transactions` group by name order by SUM(transaction) ASC LIMIT 1';
	$result = mysqli_query($con,$query);
	$lowexp = mysqli_fetch_array($result);

	$query = 'SELECT SUM(transaction) from transactions';
	$result = mysqli_query($con,$query);
	$totexp = mysqli_fetch_array($result);
?>
<div id="stats">
	<div class="card">
		<h6>Complete Statistics</h6><br>
		<table class="stats">
			<tr>
				<td>Total expenses till date:</td>
				<td>Rs. <?php echo "$totexp[0]";?></td>
			</tr>
			<tr>
				<td>Total number of expenses:</td>
				<td><?php echo "$numexp[0]";?></td>
			</tr>
			<tr>
				<td>Maximum expense till date:</td>
				<td>Rs. <?php echo "$maxexp[0]";?></td>
			</tr>
			<tr>
				<td>Minimum expense till date:</td>
				<td>Rs. <?php echo "$minexp[0]";?></td>
			</tr>
			<tr>
				<td>Average expense per month:</td>
				<td>Rs. <?php echo $totexp[0]/$monthsTillNow;?></td>
			</tr>
			<tr>
				<td>Months at the flat:</td>
				<td><span style="color: #c00;"><?php echo $monthsTillNow;?></span> Months</td>
			</tr>
			<tr>
				<td>Maximum expense in a month:</td>
				<td>Code Incomplete!</td>
			</tr>
			<tr>
				<td>Minimum expense in a month:</td>
				<td>Code Incomplete!</td>
			</tr>
			<tr>
				<td>Person with the most purchases:</td>
				<td><?php echo "$maxpur[0] ($maxpur[1])";?></td>
			</tr>
			<tr>
				<td>Person with the least purchases:</td>
				<td><?php echo "$lespur[0] ($lespur[1])";?></td>
			</tr>
			<tr>
				<td>Person with the maximum expenditure:</td>
				<td><?php echo "$higexp[0] ($higexp[1])";?></td>
			</tr>
			<tr>
				<td>Person with the least expenditure:</td>
				<td><?php echo "$lowexp[0] ($lowexp[1])";?></td>
			</tr>
			<tr>
				<td>Change in expenditure compared to last month:</td>
				<td><?php echo round($change-100,2);?>%</td>
			</tr>
			<tr>
				<td>Change in expenditure of last month compared to 2 months ago:</td>
				<td><?php echo round($change2-100,2);?>%</td>
			</tr>
			<tr>
				<td>Total expenses this month:</td>
				<td>Rs. <?php echo "$expnow[0]";?></td>
			</tr>
			<tr>
				<td>Total expenses last month:</td>
				<td>Rs. <?php echo "$explm[0]";?></td>
			</tr>
			<tr>
				<td>Total expenses 2 months ago:</td>
				<td>Rs. <?php echo "$exp2mo[0]";?></td>
			</tr>
			<tr>
				<td>Total expenses 3 months ago:</td>
				<td>Rs. <?php echo "$exp3mo[0]";?></td>
			</tr>
		</table>
	</div>
</div>

<style>
	ul li:nth-child(3){
		background-color: #999;
	}
	ul li:nth-child(3) a{
		color: white;
	}
</style>