<?php

use M4ciej\CinemaManagement\Entity\Cinema;
use M4ciej\CinemaManagement\Repository\CinemaRepository;
/*
 * Made by M4ciej
 */
/**
 * @var $cinemaRepository M4ciej\CinemaManagement\Repository\CinemaRepository
 */
class CinemaRepositoryTest extends PHPUnit_Extensions_Database_TestCase {
    private $pdoconn;
    private $cinemaRepository;
    private $cinema;
    public function testCostam(){
        $this->assertTrue(true);
    }
    public function testFindCinemaById(){
        $this->cinema=$this->cinemaRepository->findBy(1);
        $this->assertInstanceOf(Cinema::class,$this->cinema,"Nie zwrocono obiektu cinema");
        $this->assertSame(1,$this->cinema->getId(),"obiekt cinema ma niewlasciwe id");
    }
    public function testFindAllCinemas(){
        $cinemas=$this->cinemaRepository->findAll();
        $this->assertNotEmpty($cinemas, "tablica kin jest pusta");
        $this->assertInstanceOf(Cinema::class, $cinemas[0],"tablica kin nie zawiera obiektow klasy Cinema");
    }
    public function testAddCinema(){
        $this->assertTrue($this->cinemaRepository->add($this->cinema),"nie dodano kina do bazy");
    }
    public function testDeleteCinema(){
        
    }
    public function testUpdateCinema(){
        $this->cinema=$this->cinemaRepository->findBy(1);
        $this->cinema->setName("Miejskie");
        $this->cinema->setAddress("Miejska 18/19");
        $this->assertTrue($this->cinemaRepository->update($this->cinema));
    }
    protected function setUp(){
        $this->cinemaRepository=new CinemaRepository();
        $this->cinema=new Cinema();
        $this->cinema->setName("Wiejskie");
        $this->cinema->setAddress("Wiejska 1");
        //echo "SETUP";
    }
    public static function setUpBeforeClass(){
        //echo "BEFORECLASS";
        //$this->cinemaRepository=new CinemaRepository();
        //$this->cinema=new Cinema("Wiejskie", "Wiejska 12/13");
    }
    protected function getConnection(): PHPUnit_Extensions_Database_DB_IDatabaseConnection {
        $this->pdoconn = new PDO(
                "mysql:dbname=".DATABASE.";host=".SERVER, USERNAME, PASSWORD
        );
        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($this->pdoconn, DATABASE);
    }

    protected function getDataSet(): PHPUnit_Extensions_Database_DataSet_IDataSet {
        $dataMysql = $this->createMySQLXMLDataSet(__DIR__.'/cinemas.xml');
        var_dump($dataMysql);
        return $dataMysql;
    }

}
