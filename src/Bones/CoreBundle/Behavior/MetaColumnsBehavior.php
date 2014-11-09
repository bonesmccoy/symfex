<?php

namespace Bones\CoreBundle\Behavior;


use Behavior;

class MetaColumnsBehavior extends Behavior {

	const COLUMN_NAME = "meta_columns";

	public function modifyTable()
    {
		$table = $this->getTable();
		// add the aggregate column if not present
		if(!$table->hasColumn(self::COLUMN_NAME)) {
		      $table->addColumn(array(
		        'name'    => self::COLUMN_NAME,
		        'type'    => 'LONGVARCHAR',
		      ));
		}
	}

	public function objectMethods($builder)
    {
		$method = '
public function __call($name, $params) {
    //get
    $get_reg = \'/^get([A-Za-z0-9]+)Meta/\';
    $matches = array();
    if (preg_match($get_reg, $name, $matches)) {
        $key = $matches[1] ;
        $f = new Zend_Filter_Word_CamelCaseToUnderscore();
        $key = strtolower($f->filter($key));
        $meta = unserialize($this->getMetaColumns());
        return @$meta[$key];
    }

    //set
    $set_reg = \'/^set([A-Za-z0-9]+)Meta/\';
    $matches = array();
    if (preg_match($set_reg, $name, $matches))
    {
        if (empty($params)) throw new PropelException("params must valid, if setter");
        $key = $matches[1];
        $f = new Zend_Filter_Word_CamelCaseToUnderscore();
        $key = strtolower($f->filter($key));
        $meta = unserialize($this->getMetaColumns());
        $meta[$key] = $params[0];
        $this->setMetaColumns(serialize($meta));
        return $this;
    }
    parent:__call($name, $params);
}';
        return $method;
  	}

  	private function underscoreToCamelCase($string)
    {

		  $words = explode('_', strtolower($string));
		  $return = '';
		  foreach ($words as $word) {
		    $return .= ucfirst(trim($word));
		  }

		  return $return;
  	}
}