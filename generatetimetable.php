<?php
echo "hi";
set_time_limit(3000);
echo "start";
function db() 
{
    static $con;
    if ($con===NULL)
    { 
        $con = mysqli_connect("localhost", "root", "aressam1999", "instmgtsys");
    }
    return $con;
}
$con=db();
$count=0;
$count1=0;
$inst_q="SELECT * FROM institute";
$inst_res=mysqli_query($con,$inst_q);
while($row0=mysqli_fetch_array($inst_res))
{
	$dataset_size=$row0['days']*(date('H',strtotime($row0['lecend']))-date('H',strtotime($row0['lecstrt'])))*($row0['labclass']+$row0['thclass']);
}

echo $dataset_size."dataset size<br>";
$POPULATION = array();
$slot_class_array=array();
$slot_teacher_array=array();
 //population of individuals
// $POPULATION_SIZE=200;
$POPULATION_SIZE = 2*$dataset_size;
echo "<br>Population size: ".$POPULATION_SIZE."<br>dataset_size: ".$dataset_size;
// $DNA_SIZE = 12;
// $GEN_COUNT = 1;
// $TEST_COUNT = 0;
genInitPopulation();
echo count($POPULATION);
echo "<br><pre>";
print_r($POPULATION);
echo "</pre>";
ob_flush();
        flush();
while (true) 
{
    naturalSelection();
    recreatePopulation();
	echo "ok";
    echo "<br><pre>";
	print_r($POPULATION);
	echo "</pre>";
    ob_flush();
    flush();
    //function to determine if the loop should stop... argument($POPULATION)
    if(check_pop($POPULATION))
    {

    	echo "----------------------------------------------------------------------------------------------- <br>";
    	echo "----------------------------------------------------------------------------------------------- <br>";
    	echo "----------------------------------------------------------------------------------------------- <br>";
    	echo "<br><pre>";
		print_r($POPULATION);
		echo "</pre><br>";

    	echo "----------------------------------------------------------------------------------------------- <br>";
    	echo "----------------------------------------------------------------------------------------------- <br>";
    	echo "----------------------------------------------------------------------------------------------- <br>";
    	exit();
    }
}

echo "<br> ok <br>";

echo "<br><pre>";
print_r($slot_class_array);
echo "</pre>";
echo "<br><pre>";
print_r($slot_teacher_array);
echo "</pre>";
/*ob_flush();
flush();*/
//========================== FUNCTIONS ============================

function check_pop($pop)
{
	$count=0;
	global $POPULATION_SIZE;
	if(count($pop) == count(array_unique($pop)))
	{
		for($i=0;$i<$POPULATION_SIZE;$i++)
		{
			if($POPULATION[$i][1]==0)
				$count++;
		}
		if($count==$POPULATION_SIZE)
			return true;
		else
			return false;
	}
	else
	{
		for($i=0;$i<$POPULATION_SIZE;$i++)
		{
			if($POPULATION[$i][1]==0)
				$count++;
		}
		if($count==$POPULATION_SIZE)
		{

		}
		else
			return false;
	}
}

function mutate($s) 
{
	$temp1=explode(",",$s);
    $sample = randomIndividual();
 	$temp=explode(",",$sample);
    for ($i=0; $i<3; $i++) 
    {
        if (rand(0,1000) == 1000) 
        {
            $temp1[$i] = $temp[$i];
        }
    }
    $mutated_child=implode(",", $temp1);
    return $mutated_child;
}

function reproduction($ia, $ib)
{
	$temp1=explode(",", $Ia);
	$temp2=explode(",", $Ib);
	$n=rand(1,2);
	if($n==1)
	{
	  $random=rand(0,3);
	  $temp1[$random]=$temp2[$random];
	}
	else
	{
		random0:
	  	{
	    	$random1=rand(0,3);
	      	$random2=rand(0,3);
	    }
 	if($random1==$random2)
    	goto random0;
	
	$temp1[$random1]=$temp2[$random1];
	$temp1[$random2]=$temp2[$random2];
	}
	$child=implode(",",$temp1);
	$child=mutate($child);
    global $DNA_SIZE;
    $crosspoint   = rand(0, $DNA_SIZE-1);
    $ia_before_cp = substr($ia, 0, $crosspoint);
    //$ia_after_cp  = substr($ia[0], $crosspoint);
    //$ib_before_cp = substr($ib[0], 0, $crosspoint);
    $ib_after_cp  = substr($ib, $crosspoint);
    $child = $ia_before_cp.$ib_after_cp;
    $child = mutate($child);
    return array($child, fitness($child));
}
function recreatePopulation()
{
    global $POPULATION, $POPULATION_SIZE;
    //echo '* Recreating population by reproducing randomly...'."\n";
    $c = count($POPULATION);
    for ($i=$c; $i<$POPULATION_SIZE; $i++) 
    {
        $a = rand(0, $c-1);
        $b = rand(0, $c-1);
       array_push($POPULATION, reproduction($POPULATION[$a][0], $POPULATION[$b][0]));
    }
}
function naturalSelection()
{
    global $POPULATION, $POPULATION_SIZE, $GEN_COUNT;
    //echo '* Natural selection...'."\n";
    usort($POPULATION, "cmp");
    array_splice($POPULATION, ceil($POPULATION_SIZE/2));
    // echo 'Best fit gen '.$GEN_COUNT.': '.$POPULATION[0][0].' ('.$POPULATION[0][1].')'."<br>";
    $count=count($POPULATION);
    /*if($POPULATION[$count-1]==0)
	{
		echo "<br><pre>";
		print_r($POPULATION);
		echo "</pre><br>";
    	echo "----------------------------------------------------------------------------------------------- <br>";
    	echo "----------------------------------------------------------------------------------------------- <br>";
    	echo "----------------------------------------------------------------------------------------------- <br>";
    	exit();
	}*/
}
function cmp($a, $b)
{
    if ($a[1] == $b[1]) return 0;
    return ($a[1] > $b[1]) ? -1 : 1;
}



//OK beyond this point


function genInitPopulation()
{
    global $POPULATION, $POPULATION_SIZE;
    //echo '* Generating inital population...'."\n";
    $break=ceil($POPULATION_SIZE/4);
    /*for($i=0;$i<$break;$i++)
    {
    	$individual1 = randomIndividual1();
        $fit1=fitness($individual1);
        array_push($POPULATION,array($individual1,$fit1));
    }*/
    for($j=0; $j<$POPULATION_SIZE; $j++) 
    {
        $individual = randomIndividual();
        $fit=fitness($individual);
        array_push($POPULATION,array($individual,$fit));
        //$POPULATION["slotid"]=array("tid"=>"teacherid","classid"=>"classid","subject"=>"subjectid");
    }
}

function randomIndividual()
{
	global $slot_class_array,$slot_teacher_array,$count,$count1,$POPULATION;
    $individual = '';
    $con=db();

	initial_array:
	{
		$slot_array=array();
		$teacher_array=array();
		$subject_array=array();
		$class_array=array();
	}

	slot_selection:
	{
		$slot_q = "SELECT * FROM slot";
		$slot_res = mysqli_query($con, $slot_q) or die("error2");
		$slot_array=array();
		while($row1=mysqli_fetch_array($slot_res))
			$slot_array[$row1['slotid']]=$row1['slot'];
		$slot_random_index=array_rand($slot_array);
	}

	teacher_selection:
	{
		$teacher_q="SELECT * FROM teacher";
		$teacher_res = mysqli_query($con, $teacher_q) or die("error2");
		$teacher_array=array();
		while($row2=mysqli_fetch_array($teacher_res))
			$teacher_array[$row2['tid']]=$row2['tname'];
		$teacher_random_index=array_rand($teacher_array);
	}

	subject_selection:
	{
		$subject_q="SELECT * FROM subject";
		$subject_res = mysqli_query($con, $subject_q) or die("error2");
		$subject_array=array();
		while($row3=mysqli_fetch_array($subject_res))
			$subject_array[$row3['subjectid']]=$row3['subjectname'];
		$subject_random_index=array_rand($subject_array);
	}

	class_selection:
	{
		$class_q="SELECT * FROM class";
		$class_res = mysqli_query($con, $class_q) or die("error2");
		$class_array=array();
		while($row4=mysqli_fetch_array($class_res))
			$class_array[$row4['classid']]=$row4['class'];
		$class_random_index=array_rand($class_array);
	}

	//teacher-slot constraint... population cannot have the same (slot,teacher) pair twice
	if (array_key_exists($slot_array[$slot_random_index],$slot_teacher_array))
	{
		if($slot_teacher_array[$slot_array[$slot_random_index]] == $teacher_random_index)
		{
			$count++;
			goto initial_array;
		}
	}
	else
	{
		$slot_teacher_array[$slot_array[$slot_random_index]]=$teacher_random_index;	
	}

	//class-slot constraint... population cannot have the same (slot,class) pair twice
	if (array_key_exists($slot_array[$slot_random_index],$slot_class_array))
	{
		if($slot_class_array[$slot_array[$slot_random_index]] == $class_random_index)
		{
			
			goto initial_array;
		}
		
	}
	else
	{
		$slot_class_array[$slot_array[$slot_random_index]]=$class_random_index;
	}

	//individual in a population : comman seperated values of slot,teacherid,subjectid

	$individual.=$slot_array[$slot_random_index].",".$teacher_random_index.",".$subject_random_index.",".$class_random_index;
	// $POPULATION["slotid"]=array("tid"=>"teacherid","classid"=>"classid","subject"=>"subjectid");
    
    return $individual;
}

function fitness($individual)
{
	$con=db();
	$delta=0;
    $temp=explode(",", $individual);
    $slot=$temp[0];
    $teacher=$temp[1];
    $subject=$temp[2];
    $class=$temp[3];
    /*echo "<pre>";
print_r($temp);
echo "</pre><br>";
    */
    $teachersubject_check="SELECT * FROM teacher_subject WHERE tid=$teacher AND subid=$subject";
    $teacherslot_check="SELECT * FROM teacher_time WHERE tid=$teacher AND slot='$slot'";
    $classsubject_check="SELECT * FROM class,subject WHERE class.classid=$class AND subject.subjectid=$subject AND class.type=subject.subtype";

    $teachersubject_check_res=mysqli_query($con,$teachersubject_check);

   	if(mysqli_num_rows($teachersubject_check_res)==0)
   	{
   		$delta-=5;
   	}

	$teacherslot_check_res=mysqli_query($con,$teacherslot_check);
   	
   	if(mysqli_num_rows($teacherslot_check_res)==0)
   	{
   		$delta-=3;
   	}

   	$classsubject_check_res=mysqli_query($con,$classsubject_check);
   	
   	if(mysqli_num_rows($classsubject_check_res)==0)
   	{
   		$delta-=1;
   	}
    return $delta;
	}
//Try using cards... ASC timetable 
// advantage: No need to check if teacher's load is fulfilled in final timetable, because cards are already made(contains teacherid,subjectid,classid), u have to just randomly select a slot



?>
