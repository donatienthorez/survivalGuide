<?php

class Category{

        public $id;
	public $name;
	public $section;
        public $content;
	public $position;
        public $categories;

        public function __toString()
        {
            return $this->name . $this->section;
        }

        function Category($id,$name,$section,$content,$position)
        {
            $this->categories = array();
            $this->id=$id;
            $this->name=$name;
            $this->section=$section;
            $this->content=$content;
            $this->position=intval($position);
        }

        function addCategoryToList($category)
        {
            array_push($this->categories,$category);
        }

        function addSubcategoryToList($data)
        {
            foreach($this->categories as $value)
            {
                if($value->id == $data->chapitre)
                {
                    $c = new Category($data->idCategorie,$data->name,$data->code_section,$data->content,$data->position);
                    $value->addCategoryToList($c);
                }
            }
        }

        function removeCategoryToList($category)
        {
            array_remove($this->categories,$category);
        }
                
        function array_remove( $val, &$array ) {
            foreach ( $array as $i => $v ) {
                if ( $v == $val ) {
                    array_splice( $array, $i, 1 );
                    return $i;
                }
            }
            return false;
        }
}
