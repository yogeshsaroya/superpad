<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\ORM\TableRegistry;

class DataHelper extends Helper
{



    public function get_blogs()
    {
        $tbl = TableRegistry::get('Blogs');
        return $data = $tbl->find('all')->order(['created' => 'desc'])->limit(3)->all();
    }

    public function getFeaturedProperty($type = null, $limit = 3)
    {
        $tbl = TableRegistry::get('Properties');
        return $data = $tbl->find('all')
            ->where(['Properties.type IN' => $type, 'Properties.is_featured' => 1])
            ->order(['Properties.id' => 'desc'])
            ->limit($limit)
            ->all();
    }

    public function blog_tags()
    {
        $tbl = TableRegistry::get('Tags');
        $query = $tbl->find('list', ['keyField' => 'name', 'valueField' => 'name'])->order(['Tags.name' => 'ASC']);
        return $query->toArray();
    }
    public function getAmenities()
    {
        $tbl = TableRegistry::get('Amenities');
        $query = $tbl->find('list', ['keyField' => 'name', 'valueField' => 'name'])->order(['Amenities.name' => 'ASC']);
        return $query->toArray();
    }
}
