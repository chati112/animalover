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
    }
?>