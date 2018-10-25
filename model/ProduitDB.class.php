class MusicDAO
{
  private $db;
  function __construct() {
    try {
      $this->db = new PDO('sqlite:data/music.db');
    } catch (Exception $e) {
      echo "Erreur lors de l'ouverture de la base de donnée";
    }
  }
  function get(int $id) : Music {
    $music =  $this->db->query("SELECT * FROM music WHERE id='$id'")->fetchAll(PDO::FETCH_CLASS, "Music")[0];
    // constructeur appelé après le fectchclass
    return $music;
  }
}
$jukebox = new MusicDAO();

?>
