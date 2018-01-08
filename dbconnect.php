<?php
class DBconnect {
	private $db = NULL;

	function __construct() {
		$this->db = new mysqli("localhost", "d.meixner", "d(_xaV5:CK", "d_meixner","3308") or die("Error " . mysqli_error($this->db));
		mysqli_set_charset($this->db, "UTF-8");
	}

	function query($string) {
		return $this->db->query($string);
	}

	function saveDates($dates, $comments) {
		$i = 0;
		foreach ($dates as $date) {
			$this->query("INSERT INTO godis (date, comment) VALUES ('$date', '". $comments[$i] . "');");
			$i++;
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

	function getDate($id) {
		return $this->getGodi($id)->date;
	}

	function getGodi($id) {
		$result = $this->query("SELECT * FROM godis WHERE id = '$id'");
		return mysqli_fetch_object($result);
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

	function setMiniAbsentOn($name, $id) {
		$date = $this->getDate($id);
		$absentStr = $this->getMini($name)->absent;
		$absentStr .= ', ' . $date;
		return $this->setMiniAbsent($name, $absentStr);
	}

	function getMini($name) {
		$result = $this->query("SELECT * FROM minis WHERE name LIKE '$name';");
		return mysqli_fetch_object($result);
	}


	function isAbsent($name, $date) {
		$date = trim($date);
		$mini = $this->getMini($name);
		$absent = explode(",", $mini->absent);

		$absentTrim = array();
		foreach($absent as $absentDate) {
			$absentTrim[] = trim($absentDate);
		}

		return in_array($date, $absentTrim);

	}

	function setMini($name, $id) {
		$mini = $this->query("SELECT minis FROM godis WHERE id LIKE '$id';");
		$miniStrA = mysqli_fetch_array($mini);
		$miniStr = $miniStrA[0];
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
		$vb = $this->query("SELECT * FROM plan WHERE 1 LIMIT 1;");
		$vbO = mysqli_fetch_object($vb);
		if(isset($vbO->von) && isset($vbO->bis)) {
			return array('von' => $vbO->von, 'bis' => $vbO->bis);
		} else {
			return array('von' => '#Datum', 'bis' => '#Datum');
		}

	}

	function resetAbsent() {
		return $this->query("UPDATE minis SET absent = '' WHERE 1;");
	}

	function getMinisOfMass($massid) {
		$result = $this->query("SELECT * FROM godis WHERE id = '$massid';");
		$godi = mysqli_fetch_object($result);
		$miniarray = array();
		foreach(explode(',', $godi->minis) as $mini) {
			$miniarray[] = trim($mini);
		}
		return $miniarray;
	}

	function editGodi($id, $date, $comment) {
		return $this->query("UPDATE godis SET date='$date', comment='$comment' WHERE id = $id;");
	}

}