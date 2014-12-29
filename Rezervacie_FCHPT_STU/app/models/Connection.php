<?php
class Connection
{
	private $connect = null;

	public function __construct()
	{
		try
		{
			$this->connect = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$aa = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD,
			array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}
		catch (PDOException $e)
		{
			$this->connect = null;
		}
	}

	public function __destruct(){
		if($this->connect != null){
			$this->connect = null;
		}
	}

	public function getUser($id){
		if($this->connect != null){
			$sql = 'SELECT *
					FROM uzivatel
					WHERE id=:id';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':id' => $id));
			$user = $stmt->fetch();
			$stmt->closeCursor();
			return $user;
		}
		else{
			return null;
		}
	}

	public function login($login, $hashed_password){
		if($this->connect != null){
			$sql = 'SELECT *
					FROM uzivatel
					WHERE login=:login
					AND heslo=:heslo';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':login' => $login, ':heslo' => $hashed_password));
			$user = $stmt->fetch();
			$stmt->closeCursor();
			return $user;
		}
		else{
			return null;
		}
	}
	
	public function createUser($meno, $priezvisko, $login, $hashed_password, $admin){
		if($this->connect != null){
			$sql = "INSERT INTO uzivatel SET Meno=:meno,
			Priezvisko=:priezvisko,
			Login=:login,			
			heslo=:heslo,
			admin=:admin";			
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':meno' => $meno, ':priezvisko' => $priezvisko ,':login' => $login, ':heslo' => $hashed_password, ':admin' => $admin));			
			$stmt->closeCursor();
			return true;
		}
		else{
			return null;
		}
	}
	
	public function getUserByLogin($login){
		if($this->connect != null){
			$sql = 'SELECT *
					FROM uzivatel
					WHERE login=:login';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':login' => $login));
			$user = $stmt->fetch();
			$stmt->closeCursor();
			return $user;
		}
		else{
			return null;
		}
	}
	
	public function changePass($id, $hashed_password){
		if($this->connect != null){
			$sql = 'UPDATE uzivatel
					SET Heslo=:heslo
					WHERE Id=:id';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':heslo' => $hashed_password, ':id' => $id));			
			$stmt->closeCursor();			
			return true;
		}
		else{
			return null;
		}
	}
	
	public function changeAdmin($login, $admin){
		if($this->connect != null){
			$sql = 'UPDATE uzivatel
					SET Admin=:admin
					WHERE Login=:login';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':admin' => $admin, ':login' => $login));			
			$stmt->closeCursor();			
			return true;
		}
		else{
			return null;
		}
	}
	
	public function getUsers(){
		if($this->connect != null){
			$sql = 'SELECT *
					FROM uzivatel';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute();
			
			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
				$users[] = $row;
			}
			
			$stmt->closeCursor();
			return $users;
		}
		else{
			return null;
		}
	}
	
	public function createRoom($name_room, $type_room, $capacity_room){
		if($this->connect != null){
			$sql = "INSERT INTO miestnost SET Kapacita=:capacity_room,
			Nazov=:name_room,
			ID_Typ_Miestnosti=:type_room";			
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':name_room' => $name_room, ':type_room' => $type_room,':capacity_room' => $capacity_room));			
			$stmt->closeCursor();
			return true;
		}
		else{
			return null;
		}
	}
	
	public function changeRoom($id_room, $name_room, $type_room, $capacity_room){
		if($this->connect != null){
			$sql = "UPDATE miestnost SET Nazov=:name_room,
			ID_Typ_Miestnosti=:type_room,
			Kapacita=:capacity_room
			WHERE ID=:id_room";			
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':name_room' => $name_room, ':type_room' => $type_room,':capacity_room' => $capacity_room, ':id_room' => $id_room));			
			$stmt->closeCursor();
			return true;
		}
		else{
			return false;
		}
	}
	
		public function changeRoomType($name_room_type){
		if($this->connect != null){
			$sql = "UPDATE typy_miestnosti 
			SET Nazov=:name_room_type";			
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':name_room_type' => $name_room_type));			
			$stmt->closeCursor();
			return true;
		}
		else{
			return false;
		}
	}
	
	public function deleteRoom($id_room){
		if($this->connect != null){
			$sql = "DELETE FROM miestnost WHERE ID=:id_room";			
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':id_room' => $id_room));			
			$stmt->closeCursor();
			return true;
		}
		else{
			return false;
		}
	}
	
	public function deleteRoomType($id_room_type){
		if($this->connect != null){
			$sql = "DELETE FROM typy_miestnosti WHERE ID=:id_room_type";			
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':id_room_type' => $id_room_type));			
			$stmt->closeCursor();
			return true;
		}
		else{
			return false;
		}
	}
	
	public function deleteAllRooms(){
		if($this->connect != null){
			$sql = "DELETE FROM miestnost";			
			$stmt = $this->connect->prepare($sql);
			$stmt->execute();			
			$stmt->closeCursor();
			return true;
		}
		else{
			return false;
		}
	}
	
	public function getRoomTypes(){
	if($this->connect != null){
			$sql = 'SELECT *
					FROM typy_miestnosti';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute();
			
			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			$result[] = $row;
			}
			
			$stmt->closeCursor();
			return $result;
		}
		else{
			return null;
		}
	}
	
	public function createRoomType($name_room_type){
		if($this->connect != null){
			$sql = "INSERT INTO typy_miestnosti SET Nazov=:name_room_type";			
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':name_room_type' => $name_room_type));			
			$stmt->closeCursor();
			return true;
		}
		else{
			return null;
		}
	}
	
	public function getAllRooms(){
		if($this->connect != null){
			$sql = "SELECT * FROM miestnost";			
			$stmt = $this->connect->prepare($sql);
			$stmt->execute();
			$result = '';
			
			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			$result[] = $row;
			}
			
			$stmt->closeCursor();
			return $result;
		}
		else{
			return null;
		}
	}
	
	public function getRoomTypeByID($id_room_type){
		if($this->connect != null){
			$sql = 'SELECT *
					FROM typy_miestnosti
					WHERE ID=:id_room_type';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':id_room_type' => $id_room_type));
			$result = $stmt->fetch();
			$stmt->closeCursor();
			return $result;
		}
		else{
			return null;
		}
	}
	
	public function TEST_MIESTNOSTI_VYTVOR($pocet){
		if($this->connect != null){
		$name_room = "TEST Miestnost";
			for($i = 0; $i < $pocet; $i++){
			$name_room = 'TEST Miestnost'.$i;
			$capacity_room = rand(1,100);
			$id_room_type = rand(2,5);
			$sql = "INSERT INTO miestnost 
			SET Nazov=:name_room,
			Kapacita=:capacity_room,
			ID_Typ_Miestnosti=:id_room_type";			
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':name_room' => $name_room, ':capacity_room' => $capacity_room, 'id_room_type' => $id_room_type));			
			$stmt->closeCursor();
			}
			return true;
		}
		else{
			return null;
		}
	}
	
	public function getRoomByID($id_room){
		if($this->connect != null){
			$sql = 'SELECT *
					FROM miestnost
					WHERE id=:id_room';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':id_room' => $id_room));
			$room = $stmt->fetch();
			$stmt->closeCursor();
			return $room;
		}
		else{
			return null;
		}
	}
	
	public function updateRezervacia($id, $id_uzivatel, $id_miestnost, $ucel){
		if($this->connect != null){
			$sql = 'UPDATE rezervacia
					SET ID_Uzivatel=:idu, ID_Miestnost=:idm, Ucel=:ucel
					WHERE Id=:id';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':idu' => $id_uzivatel, ':id' => $id, ':idm' => $id_miestnost, ':ucel' => $ucel));			
			$stmt->closeCursor();			
			return true;
		}
		else{
			return null;
		}
	}
	
	public function updateMapaRezervacie($id, $id_rezervacie, $zaciatok, $koniec, $pocet_osob ){
		if($this->connect != null){
			$sql = 'UPDATE mapa_rezervacie
					SET ID_Rezervacia=:idr, Zaciatok=:zac, Koniec=:kon, Pocet_Osob=:poc
					WHERE Id=:id';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':idr' => $id_rezervacie, ':id' => $id, ':zac' => $zaciatok, ':kon' => $koniec, ':poc' => $pocet_osob));			
			$stmt->closeCursor();			
			return true;
		}
		else{
			return null;
		}
	}
	
	public function getRezervacie(){
		if($this->connect != null){
			$sql = 'SELECT mapa_rezervacie.ID,mapa_rezervacie.ID_Rezervacia,mapa_rezervacie.Zaciatok,mapa_rezervacie.Koniec,mapa_rezervacie.Pocet_Osob,rezervacia.Ucel,rezervacia.ID_Uzivatel,uzivatel.Meno,uzivatel.Priezvisko,uzivatel.login,rezervacia.ID_Miestnost,miestnost.Nazov,miestnost.Kapacita
				FROM mapa_rezervacie 
				INNER JOIN rezervacia
				ON mapa_rezervacie.ID_Rezervacia=rezervacia.ID
				INNER JOIN uzivatel
				ON rezervacia.ID_Uzivatel=uzivatel.ID
				INNER JOIN miestnost
				ON rezervacia.ID_Miestnost=miestnost.ID';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute();	
			$result = $stmt->fetch();
			$rezervacie = '';
			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
				$rezervacie[] = $row;
			}
			
			$stmt->closeCursor();
			return $rezervacie;
		}
		else{
			return null;
		}
	}
	
	public function getNumberOfReservationsInMapByID($id){
		if($this->connect != null){
			$sql = 'SELECT Count(*)
				FROM mapa_rezervacie 
				WHERE ID_Rezervacia=:id';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':id' => $id));			
			$result = $stmt->fetch();			
			$stmt->closeCursor();
			return $result;
		}
		else{
			return null;
		}
	}
	
	public function deleteReservationInMapByID($id){
		if($this->connect != null){
			$sql = 'DELETE
				FROM mapa_rezervacie 
				WHERE ID=:id';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':id' => $id));				
			$stmt->closeCursor();
			return true;
		}
		else{
			return false;
		}
	}
	
	public function deleteReservationByID($id){
		if($this->connect != null){
			$sql = 'DELETE
				FROM rezervacia 
				WHERE ID=:id';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':id' => $id));				
			$stmt->closeCursor();
			return true;
		}
		else{
			return false;
		}
	}
}
?>