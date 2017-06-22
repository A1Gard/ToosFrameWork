<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 9-July-2014
 * @time : 22:41 
 * @subpackage   TCategory
 * @version 1.0
 * @todo : All Category mode managing class
 */
class TCategory extends TModel {

    protected static $instance;
    private $sulg ;


    public static function GetInstance($table_name = 'category',$sulg ='category') {
        if (!isset(self::$instance))
            self::$instance = new self($table_name,$sulg);
        return self::$instance;
    }

    function __construct($table_name = 'category',$sulg ='category') {
        parent::__construct($table_name, $table_name . '_');
        $this->table_name = $table_name;
        $this->sulg = $sulg ;
    }

    /**
     * add category to db
     * @param string $title
     * @param int $parent
     * @param string $description
     */
    public function AddCategory($title, $parent = 0, $description = '') {

        // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $title, $parent, $description);

        $data = array(
            $this->table_name . '_title' => $title,
            $this->table_name . '_parent' => $parent,
            $this->table_name . '_description' => $description
        );
        $id = $this->Create($data);
        
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $id);
        
        return $id;
    }

    /**
     * remove category from db
     * @param int $id
     */
    public function RemoveCategory($id) {
        // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $id);
        $result = $this->Delete($id);
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
    }

    /**
     * get list of all categories
     * @return mixed
     */
    public function CategoryList() {
        
        
        $sql = "SELECT * FROM %table% WHERE 1";
        // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $sql);
        
        $result =  $this->db->Select($sql, array($this->table_name));
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
    }

    /**
     * get category by parent one level only
     * @param int $parent
     * @return mixed
     */
    public function CategoryByParent($parent) {

         // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $parent);
        $sql = "SELECT * FROM %table% WHERE " . $this->table_name . '_parent'
                . ' = :parent ';
        
         $result = $this->db->Select($sql, array($this->table_name),
                 array('type' => 'i', ':parent' => (int) $parent));
        
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
    }

    /**
     * select all category expect an id + no parent item.
     * @param int $expect_id
     * @return mixed
     */
    public function CategoryByExpect($expect_id = '0') {

        // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $expect_id);

        $sql = "SELECT " . $this->table_name . '_id' . ", " .
                $this->table_name . '_title' . " FROM %table% WHERE " .
                $this->table_name . '_id' . ' <> :id ';
        $result = $this->db->Select($sql, array($this->table_name), array('type' => 'i', ':id' => (int) $expect_id), PDO::FETCH_BOTH);
        $result[-1][0] = 0;
        $result[-1][1] = 'No parent';
        sort($result);
       
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        return $result;
    }

    /**
     * get all categories in orderd list
     * @param int $parent
     * @return string
     */
    public function CategoryOL($parent = 0) {

        //$parent_class = 'parent';
        $level0_class = 'drg';
         // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $parent/*,$parent_class */,$level0_class);
        
        if ($parent == 0) {
            $result = '<ol class="' . $level0_class . '">';
        } else {
            $result = '<ol>';
        }

        $cat_list = $this->CategoryByParent($parent);

        foreach ($cat_list as $record) {

            $result .= '<li data-id="' . $record[$this->table_name . '_id'] . '">';
            $result .= $record[$this->table_name . '_title'];
            $result .= $this->CategoryOL($record[$this->table_name . '_id']);
            $result .= '</li>' . PHP_EOL;
        }
        $result .= '</ol>' . PHP_EOL;

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
    }

    /**
     * get all categories in unorderd list
     * @param int $parent
     * @return string
     */
    public function CategoryUL($parent = 0, $show_child = TRUE) {

        // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $parent, $show_child);
        
        $cat_list = $this->CategoryByParent($parent);

        $result = null;

        if (count($cat_list) > 0) {


            $result = '<ul>';
            foreach ($cat_list as $record) {

                $result .= '<li>';
                if ($show_child) {
                    $result .= '<a href="/' . $this->sulg . '/' . $record[$this->table_name . '_id'] . '/' . $record[$this->table_name . '_title'] . '">';
                    $result .= $record[$this->table_name . '_title'];
                    $result .= '</a>';
                    $result .= $this->CategoryUL($record[$this->table_name . '_id']);
                }
                $result .= '</li>' . PHP_EOL;
            }
            $result .= '</ul>' . PHP_EOL;
        }
        
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
        
    }

    /**
     * get check catgory for soucess
     * @param mixed $sources array of checkneed
     * @param int $parent parent id
     * @return string
     */
    private function GetCheckedCategories($sources, $parent = 0) {
        
        // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $sources, $parent);
        
        $result = '<ul>';


        $cat_list = $this->CategoryByParent($parent);

        // each category list
        foreach ($cat_list as $record) {

            $result .= '<li data-id="' . $record[$this->table_name . '_id'] . '">';

            $result .= '<label > <input type="checkbox" name="category[]" ';
            // check if in source list
            if (in_array($record[$this->table_name . '_id'], $sources)) {
                $result .= ' checked="" ';
            }
            // set value
            $result .= ' value="' . $record[$this->table_name . '_id'] . '"/>' .
                    $record[$this->table_name . '_title'] . '</label>';
            // re run the function
            $result .= $this->GetCheckedCategories($sources, $record[$this->table_name . '_id']);

            $result .= '</li>' . PHP_EOL;
        }

        $result .= '</ul>' . PHP_EOL;

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
    }

    /**
     * Get categories of a destination
     * @param int $destination destination id
     * @param int $type
     */
    public function GetCategories($destination, $type = RELATION_CATEGORY) {

        // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $destination, $type);
        
        $rel = TRelation::GetInstance();

        $sources = $rel->GetByDestination($destination, $type);

        $result =  $this->GetCheckedCategories($sources);
        
         // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
        
    }

}
