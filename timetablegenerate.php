<?php
	//class for database connection
	$POPULATION_SIZE=100;
	$GEN_COUNT = 1;
	function db () 
	{
	    static $con;
	    if ($con===NULL)
	    { 
	        $con = mysqli_connect ("localhost", "root", "aressam1999", "instmgtsys");
	    }
	    return $con;
	}

	//population initialisation function
	function generateIndividual($slot)
	{
		$con=db();

		initialisation:
		{
			$teacher_array=array();
			$subject_array=array(array());
			$class_array=array();
		}
		teacher_selection:
		{
			//array of teachers reent in the current slot
			$q2="SELECT * FROM teacher,teacher_time WHERE teacher_time.slot='$slot' AND teacher.tid=teacher_time.tid";
			$res2 = mysqli_query ($con,$q2);
			while($row2=mysqli_fetch_array($res2))
			{
				$teacher_array[$row2['tid']]=$row2['tname'];
			}
			//selecting random value from the available teachers
			$teacher_random_index=array_rand($teacher_array);
		}

		subject_selection:
		{
			//array of subjects that the randomly selected teacher teaches
			$q3="SELECT * FROM subject,teacher_subject WHERE teacher_subject.subid=subject.subjectid AND teacher_subject.tid=$teacher_random_index";																								//subject load constraint remaining
			$res3 = mysqli_query ($con,$q3);
			while($row3=mysqli_fetch_array($res3))
			{
				if($row3['type']=='theory')
					$subject_array[$row3['subid']]=array("subjectname"=>$row3['subjectname'],"type"=>$row3['type'],"thload"=>$row3['thload']);
				else
					$subject_array[$row3['subid']]=array("subjectname"=>$row3['subjectname'],"type"=>$row3['type'],"labload"=>$row3['labload']);
			}
			//selecting random suject from the fit subjects
			$subject_random_index=array_rand($subject_array);

			if($subject_array['$subject_random_index']['type']=='theory')
			{
				if (($teacher_current_thload[$teacher_random_index]+$subject_array[$subject_random_index]['thload']) <= $teacher_thload_array[$teacher_random_index]) 
				{
					continue;
				}
				else
					goto initialisation;
			}
			else
			{
				if(($teacher_current_labload[$teacher_random_index]+$subject_array[$subject_random_index]['labload']) <= $teacher_labload_array[$teacher_random_index]) 
				{

				}
			}
		}

		class_selection:
		{
			//array of class available in the current slot
			$q4="SELECT * FROM class_time,class WHERE class_time.slot=$slot AND class.classid=class_time.classid AND class_time.type=(SELECT subtype FROM subject WHERE subjectid=$subject_random_index)"
			$res4 = mysqli_query ($con,$q4);
			while($row4=mysqli_fetch_array($res4))
			{
				$class_array[$row4['classid']]=$row4['classname'];
			}
			//selecting a random class of the same type as subject
			$class_random_index=array_rand($class_array);		
		}
		// unset($class_array[$class_random_index]);
		// unset($teacher_array[$teacher_random_index]);
		// unset($subject_array[$subject_random_index]);
	}



	$indiv_array=array(array());
	$con = db();


	//teacher load constraint initialization
	$teacher_thload_array=array();
	$teacher_current_thload=array();
	$teacher_labload_array=array();
	$teacher_current_labload=array();
	
	//theory load
	$thload_q="SELECT tid,thload FROM teacher";
	$thload_res=mysqli_query($con,$thload_q);
	while($thload_row=mysqli_fetch_array($thload_res))
	{
		$teacher_thload_array["$thload_row['tid']"]=$thload_row['thload'];
		$teacher_current_thload["$thload_row['tid']"]=0;
	}

	//lab load
	$labload_q="SELECT tid,labload FROM teacher";
	$labload_res=mysqli_query($con,$labload_q);
	while($labload_row=mysqli_fetch_array($labload_res))
	{
		$teacher_labload_array["$labload_row['tid']"]=$labload_row['labload'];
		$teacher_current_labload["$labload_row['tid']"]=0;
	}


	//selecting slots one by one
	$q = "SELECT * FROM slot";
	$res = mysqli_query($con, $q) or die("error2");
	$slot_array=array();
	while($row=mysqli_fetch_array($res))
	{
		$slot_array["$row['slotid']"]=$row['slot'];
		/*if($row['slot']=='B1')
		{
			//caling the population initialization function
			generateIndividual($row['slot']);
		}*/

		//alternative: make an array for slots and select random values till <= POPULATION_SIZE

	}
	for($i=1;$i<=$POPULATION_SIZE;$i++)
	{
		$slot_random_index=array_rand($slot_array);
		generateIndividual($slot_array['$slot_random_index']);
	}

?>