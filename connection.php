<?php
    class animalover{
        public static function connect()
        {
            try{
            $con=new PDO('mysql:localhost=host; dbname=animalover','root','');
            return $con;
            } catch (PDOException $error1) {
                echo 'Something went wrong, it was not possible to connect to database'.$error1->getMessage();
            }catch (Exception $error2){
                echo 'Generic error !'.$error2->getMessage();
            }
        }

        
        public static function Selectdata()
        {
            $data=array();
            $p=animalover::connect()->prepare('SELECT * FROM uzytkownicy');
            $p->execute();
           $data=$p->fetchAll(PDO::FETCH_ASSOC);
           return $data;
        }
        public static function delete($id)
        {
            $p=animalover::connect()->prepare('DELETE FROM uzytkownicy WHERE id=:id');
            $p->bindValue(':id',$id);
            $p->execute();
        }

        public static function SelectAnimals()
        {
            $data = array();
            $pdo = animalover::connect();
            $stmt = $pdo->prepare('SELECT * FROM animals');
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public static function SelectVirtualAdoptions()
        {
            $data = array();
            $pdo = animalover::connect();
            $stmt = $pdo->prepare('SELECT * FROM virtualadoptions');
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public static function SelectUsers()
        {
            $data = array();
            $pdo = animalover::connect();
            $stmt = $pdo->prepare('SELECT * FROM users');
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }


        public static function SelectAdoptions()
        {
            $data = array();
            $pdo = animalover::connect();
            $stmt = $pdo->prepare('SELECT * FROM adoptions');
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public static function SelectShelters()
        {
            $data = array();
            $pdo = animalover::connect();
            $stmt = $pdo->prepare('SELECT * FROM shelters');
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public static function SelectWalks()
        {
            $data = array();
            $pdo = animalover::connect();
            $stmt = $pdo->prepare('SELECT * FROM walks');
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public static function CountAnimals() {
            $pdo = static::connect();
            $stmt = $pdo->query("SELECT COUNT(*) FROM animals");
            return $stmt->fetchColumn();
        }
    
        public static function CountUsers() {
            $pdo = static::connect();
            $stmt = $pdo->query("SELECT COUNT(*) FROM users");
            return $stmt->fetchColumn();
        }
    
        public static function CountAdoptions() {
            $pdo = static::connect();
            $stmt = $pdo->query("SELECT COUNT(*) FROM adoptions");
            return $stmt->fetchColumn();
        }
    
        public static function CountWalks() {
            $pdo = static::connect();
            $stmt = $pdo->query("SELECT COUNT(*) FROM walks");
            return $stmt->fetchColumn();
        }
    
        public static function CountVirtualAdoptions() {
            $pdo = static::connect();
            $stmt = $pdo->query("SELECT COUNT(*) FROM virtualadoptions");
            return $stmt->fetchColumn();
        }

        public static function CountAnimalsByCategory() {
            $pdo = static::connect();
            $categories = ['Cat', 'Dog', 'Other'];
            $counts = [];
    
            foreach ($categories as $category) {
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM animals WHERE Species = :species");
                $stmt->bindValue(':species', $category);
                $stmt->execute();
                $counts[$category] = $stmt->fetchColumn();
            }
    
            // Dla uproszczenia zakładamy, że wszystkie pozostałe zwierzęta są w kategorii "Inne"
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM animals WHERE Species NOT IN ('Cat', 'Dog')");
            $stmt->execute();
            $counts['Other'] = $stmt->fetchColumn();
    
            return $counts;
        }

        public static function GetTopActiveUsers() {
            $pdo = static::connect();
            $stmt = $pdo->query("
            SELECT 
                u.ID, 
                u.FirstName, 
                u.LastName, 
                COALESCE(w.WalksCount, 0) AS WalksCount,
                COALESCE(a.AdoptionsCount, 0) AS AdoptionsCount,
                COALESCE(va.VirtualAdoptionsCount, 0) AS VirtualAdoptionsCount,
                (COALESCE(w.WalksCount, 0) + COALESCE(a.AdoptionsCount, 0) + COALESCE(va.VirtualAdoptionsCount, 0)) AS TotalActivities
            FROM users u
            LEFT JOIN (SELECT UserID, COUNT(*) AS WalksCount FROM walks GROUP BY UserID) w ON u.ID = w.UserID
            LEFT JOIN (SELECT UserID, COUNT(*) AS AdoptionsCount FROM adoptions GROUP BY UserID) a ON u.ID = a.UserID
            LEFT JOIN (SELECT UserID, COUNT(*) AS VirtualAdoptionsCount FROM virtualadoptions GROUP BY UserID) va ON u.ID = va.UserID
            ORDER BY TotalActivities DESC
            LIMIT 3;
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>