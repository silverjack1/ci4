<?php namespace App\Models;
use CodeIgniter\Database\BaseBuilder;

class CustomModel
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function get()
    {
        //SELECT * FROM video_games_sales LIMIT 20 OFFSET 0
        $builder = $this->db->table('video_games_sales');        
        $query = $builder->get(20,0);
        return $query; 
    }

    public function get_compiled_select()
    {
        $builder = $this->db->table('video_games_sales'); 
        $builder->where('Publisher','Nintendo');       
        $query = $builder->getCompiledSelect();
        return $query; 
    }

    public function get_where()
    {
        //SELECT * FROM `video_games_sales` WHERE `Publisher` = 'Nintendo'
        $builder = $this->db->table('video_games_sales');
        $query = $builder->getWhere(['Publisher'=>'Nintendo']);
        return $query;
    }    

    public function select()
    {
        // SELECT Name, Platform FROM video_games_sales LIMIT 1 OFFSET 0
        $builder = $this->db->table('video_games_sales');
        $builder->select('Name, Platform');
        $query = $builder->get(1,0);
        return $query;
    }

    public function select_max()
    {
        // SELECT MAX(Global_Sales) AS Total_Penjualan FROM video_games_sales
        $builder = $this->db->table('video_games_sales');
        $builder->selectMax('Global_Sales','Total_Penjualan');
        $query = $builder->get();
        return $query;
    }

    public function select_min()
    {
        $builder = $this->db->table('video_games_sales');
        $builder->selectMin('Global_Sales');
        $query = $builder->get();
        return $query;
    }

    public function select_avg()
    {
        $builder = $this->db->table('video_games_sales');
        $builder->selectAvg('Global_Sales');
        $query = $builder->get();
        return $query;
    }

    public function select_sum()
    {
        $builder = $this->db->table('video_games_sales');
        $builder->selectSum('User_Count');
        $query = $builder->get();
        return $query;
    }

    public function select_count()
    {
        $builder = $this->db->table('video_games_sales');
        $builder->selectCount('id');
        $query = $builder->get();
        return $query;
    }

    public function from()
    {
        $builder = $this->db->table('video_games_sales');
        $builder->select('Name');
        $builder->from('video_games_genre');
        $query = $builder->getCompiledSelect();
        return $query;
    }

    public function join()
    {
        /**
         * SELECT video_games_sales.Name, video_games_genre.genre_name
         * FROM video_games_sales
         * LEFT JOIN video_games_genre ON video_games_sales.Genre = video_games_genre.id
         */
        $builder = $this->db->table('video_games_sales');
        $builder->select('video_games_sales.Name, video_games_genre.genre_name');
        $builder->join('video_games_genre', 'video_games_sales.Genre = video_games_genre.id','left');
        $query = $builder->get(10,0);
        return $query;
    }

    public function and_where()
    {
        /**
         * SELECT * FROM video_games_sales
         * WHERE Platform = 'PS3' AND Publisher = 'Ubisoft'
         */
        $builder = $this->db->table('video_games_sales');
        $builder->where('Platform', 'PS3');
        $builder->where('Publisher', 'Ubisoft');
        $query = $builder->get();
        return $query;
    }

    public function custom_key()
    {
        /**
         * SELECT * FROM video_games_sales
         * WHERE Critic_score > 80
         */
        $builder = $this->db->table('video_games_sales');
        $builder->where('Critic_score >',80);
        $query = $builder->get();
        return $query;
    }

    public function associative_array()
    {
        /**
         * SELECT * FROM video_games_sales
         * WHERE Platform = 'PS3' AND Publisher = 'Ubisoft' AND Critic_Score > 80
         */
        $builder = $this->db->table('video_games_sales');
        $array = [
            'Platform' => 'PS3',
            'Publisher' => 'Ubisoft',
            'Critic_Score >' => 80,
        ];
        $builder->where($array);
        $query = $builder->get();
        return $query;
    }

    public function custom_string()
    {
        $builder = $this->db->table('video_games_sales');
        $where = "Platform='PS4' AND Publisher='Ubisoft' AND Critic_Score>80";
        $builder->where($where);
        $query = $builder->get();
        return $query;
    }

    public function subqueries()
    {
        /**
         * SELECT * FROM video_games_sales
         * WHERE Critic_Score < (SELECT AVG(Critic_Score) FROM video_games_sales)
         */
        $builder = $this->db->table('video_games_sales');
        $builder->where('Critic_Score <', function(BaseBuilder $builder){
            return $builder->select('AVG(Critic_Score)', false)->from('video_games_sales');
        });
        $query = $builder->get();
        return $query;
    }

    public function or_where()
    {
        /**
         * SELECT * FROM video_games_sales
         * WHERE Genre = 1 OR Genre = 2
         */
        $builder = $this->db->table('video_games_sales');
        $builder->where('Genre',1);
        $builder->orWhere('Genre',2);
        $query = $builder->get();
        return $query;
    }

    public function where_in()
    {
        /**
         * SELECT * FROM video_games_sales
         * WHERE Platform IN ('PS4','PS3')
         */
        $builder = $this->db->table('video_games_sales');
        $platform = ['PS4','PS3'];
        $builder->whereIn('Platform', $platform);
        $query = $builder->get();
        return $query;
    }

    public function or_where_in()
    {
        $builder = $this->db->table('video_games_sales');
        $id = [3,4,5,6];
        $builder->where('id',1);
        $builder->orWhereIn('id',$id);
        $query = $builder->get();
        return $query;
    }

    public function where_not_in()
    {
        $builder = $this->db->table('video_games_sales');
        $platform = ['PS4','PS3'];
        $builder->whereNotIn('Platform', $platform);
        $query = $builder->get();
        return $query;
    }

    public function or_where_not_in()
    {
        $builder = $this->db->table('video_games_sales');
        $platform = ['PS4','PS3'];
        $builder->where('Publisher', 'Activision');
        $builder->orWhereNotIn('Platform', $platform);
        $query = $builder->get();
        return $query;
    }

    public function like()
    {   
        /**
         * WHERE Name LIKE '%MARIO' AND Platform LIKE '%nes%'
         *  */          
        $builder = $this->db->table('video_games_sales');
        $builder->like('Name','MARIO');
        $builder->like('Platform', 'nes');
        $query = $builder->get();
        return $query;
    }

    public function associative_like()
    {
        $builder = $this->db->table('video_games_sales');
        $array = [
            'Name' => 'mario',
            'Platform' => 'nes',
        ];
        $builder->like($array);
        $query = $builder->get();
        return $query;
    }

    public function or_like()
    {
        $builder = $this->db->table('video_games_sales');
        $builder->like('Name','MARIO');
        $builder->orLike('Platform', 'nes');
        $query = $builder->get();
        return $query;
    }

    public function not_like()
    {
        $builder = $this->db->table('video_games_sales');
        $builder->notLike('Name','MARIO');        
        $query = $builder->get();
        return $query;
    }

    public function or_not_like()
    {
        $builder = $this->db->table('video_games_sales');
        $builder->notLike('Name','MARIO');        
        $builder->orNotLike('Platform', 'nes');
        $query = $builder->get();
        return $query;
    }

    public function group_by()
    {
        $builder = $this->db->table('video_games_sales');
        $builder->select('Publisher, COUNT("Publisher") AS jumlah');        
        $builder->groupBy('Publisher');
        $query = $builder->get();
        return $query;
    }

    public function distinct()
    {
        $builder = $this->db->table('video_games_sales');
        $builder->select('Platform');
        $builder->distinct();
        $query = $builder->get();
        return $query;
    }

    public function having()
    {
        $builder = $this->db->table('video_games_sales');
        $builder->select('Platform, AVG(Global_Sales)');
        $builder->where('Global_Sales >',20);
        $builder->groupBy('Platform');
        $builder->having(['AVG(Global_Sales) >' => 20]);
        $query = $builder->get();
        return $query;
    }

    public function order_by()
    {
        $builder = $this->db->table('video_games_sales');
        $builder->orderBy('Year_of_Release ASC, Name DESC');
        $query = $builder->get(20,20);
        return $query;
    }

    public function limit()
    {
        $builder = $this->db->table('video_games_sales');
        $builder->orderBy('Year_of_Release', 'ASC');
        $builder->limit(20,20);
        $query = $builder->get();
        return $query;
    }

    public function count_all_results()
    {
        $builder = $this->db->table('video_games_sales');
        $builder->like('Name','MARIO');
        $builder->like('Platform', 'nes');
        $query = $builder->countAllResults();
        return $query;
    }

    public function count_all()
    {
        $builder = $this->db->table('video_games_sales');
        $builder->like('Name','MARIO');
        $builder->like('Platform', 'nes');
        $query = $builder->countAll();
        return $query;
    }

    //DELETE
    public function delete_data()
    {
        $builder = $this->db->table('contact');
        $builder->delete(['nama'=>'Susi']);
        return $this->db->affectedRows();
    }

    public function empty_table()
    {
        $builder = $this->db->table('contact');
        $builder->emptyTable();
        return $this->db->affectedRows();
    }

    public function truncate_table()
    {
        $builder = $this->db->table('contact');
        $builder->truncate();
        return $this->db->affectedRows();
    }

    public function compiled_delete()
    {
        $builder = $this->db->table('contact');
        $builder->where('id',1);        
        //$builder->delete();
        return $builder->getCompiledDelete();
    }

}