<?php
include('template.php');
if(isset($_POST['clear']) && $_POST['clear']=="clear"){
	$query=<<<END
	   DELETE FROM daily_bed_time WHERE id={$_SESSION['Id']}
END;
$mysqli->query($query);
$query=<<<END
	   DELETE FROM daily_energy_expenditure WHERE id={$_SESSION['Id']}
END;
$mysqli->query($query);
$query=<<<END
	   DELETE FROM daily_get_up WHERE id={$_SESSION['Id']}
END;
$mysqli->query($query);
$query=<<<END
	   DELETE FROM daily_naps_times WHERE id={$_SESSION['Id']}
END;
$mysqli->query($query);
$query=<<<END
	   DELETE FROM daily_outdoors_temperature WHERE id={$_SESSION['Id']}
END;
$mysqli->query($query);
$query=<<<END
	   DELETE FROM daily_sleeping_hours WHERE id={$_SESSION['Id']}
END;
$mysqli->query($query);
$query=<<<END
	   DELETE FROM daily_steps WHERE id={$_SESSION['Id']}
END;
$mysqli->query($query);
$query=<<<END
	   DELETE FROM daily_walk_distance WHERE id={$_SESSION['Id']}
END;
$mysqli->query($query);
echo "<script>alert('Delete successfully！'); history.go(-1);</script>";
}else{  
 echo "<script>alert('Delete failed!'); history.go(-1);</script>";  
}  
?>