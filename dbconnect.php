<?php
class DBconnect {
	private $db = NULL;
	
	function __construct() {
		$this->db = mysqli_connect("localhost", "dominik", "1234", "mini") or die("Error " . mysqli_error());
		mysqli_set_charset($this->db, "UTF-8");
	}
	
	function query($string) {
		return $this->db->query($string);
	}
		
	function saveDates($dates) {
		foreach ($dates as $date) {
			$this->query("INSERT INTO godis (date) VALUES ('$date');");
		}
	}	
	
	function saveMinis($minis) {
		foreach ($minis as $mini) {
			$this->query("INSERT INTO minis (name, absent) VALUES ('$mini', '');");
		}
	}
	
	function delMini($mini) {
		return $this->query("DELETE FROM minis WHERE name LIKE '$mini';");
	}
	
		
	function getDates() {
		$result = $this->query("SELECT * FROM godis;");
		
		$allDatesArr = array();
		while ($row = mysqli_fetch_object($result)) {
			array_push($allDatesArr, $row);
		}
		return $allDatesArr;
	}
	
	function getMinis() {
		$result = $this->query("SELECT * FROM minis;");
		
		$allMinisArr = array();
		while ($row = mysqli_fetch_object($result)) {
			array_push($allMinisArr, $row);
		}
		return $allMinisArr;
	}
	
	/**
	 * @return array mit Namen
	 */
	function getMiniNames() {
		$arr = $this->getMinis();
		
		$tmp = array();
		
		foreach ($arr as $mini) {
			array_push($tmp, $mini->name);
		}
		return $tmp;
		
	}
	
	
	function setMiniAbsent($name, $absentStr) {
		return $this->query("UPDATE minis SET absent = '$absentStr' WHERE name LIKE '$name';");
		
	}
	
	function getMini($name) {
		$result = $this->query("SELECT * FROM minis WHERE name LIKE '$name';");
		return mysqli_fetch_object($result);
	}
	
	
	function isAbsent($name, $date) {
		$mini = $this->getMini($name);
		$absent = explode(", ", $mini->absent);
		
		return in_array($date, $absent);
		
	}
	
	function setMini($name, $id) {
		$mini = $this->query("SELECT minis FROM godis WHERE id LIKE '$id';");
		$miniStr = mysqli_fetch_array($mini)[0];
		if(is_null($miniStr)) {
			$miniStr = "";
		}		
		$miniStr .= "$name, ";
		return $this->query("UPDATE godis SET minis = '$miniStr' WHERE id = $id;");
		
	}
	
	
	function resetMinis() {
		return $this->query("UPDATE godis SET minis = '' WHERE 1;");
	}
	
	
	function resetGodis() {
		$this->query("DELETE FROM godis WHERE 1;");
		$this->query("DELETE FROM plan WHERE 1;");
	}
	
	function saveVonBis($von, $bis) {
		return $this->query("INSERT INTO plan (von, bis) VALUES ('$von', '$bis');");
	}
	
	function getVonBis() {
		$vb = $this->query("SELECT * FROM plan WHERE id = 1;");
		$vbO = mysqli_fetch_object($vb);
		return ['von' => $vbO->von, 'bis' => $vbO->bis];
		
	}
	
	function resetAbsent() {
		return $this->query("UPDATE minis SET absent = '' WHERE 1;");
	}
	
	
	
}