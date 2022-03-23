<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\ORM\TableRegistry;

class DataHelper extends Helper
{

    public function getBlockchains($type = 'all')
    {
        $tbl = TableRegistry::get('Blockchains');
        if ($type == 'list') {
            $query = $tbl->find('list', ['keyField' => 'id', 'valueField' => 'name'])->order(['Blockchains.name' => 'ASC']);
            return $query->toArray();
        } else {
            try {
                $query = $tbl->find('all', ['conditions' => ['Blockchains.status' => 1], 'limit' => 50]);
                return $query->all();
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    public function getProjects($limit = 6)
    {
        $tbl = TableRegistry::get('Projects');
        try {
            $query = $tbl->find('all', [
                'contain' => ['Blockchains'],
                'conditions' => ['Projects.status' => 1],
                'order' => ['Projects.id' => 'desc'],
                'limit' => $limit
            ]);
            return $query->all();
        } catch (\Throwable $th) {
        }
    }

    public function getFeaturedSale() {
        $tbl = TableRegistry::get('Projects');
        try {
            $query = $tbl->find('all', [
                'contain' => ['Blockchains'],
                'conditions' => ['Projects.is_featured'=>1, 'Projects.status' => 1]]);
            return $query->first();
        } catch (\Throwable $th) {
        }
    }

    public function getPartners()
    {
        $tbl = TableRegistry::get('Partners');
        try {
            $query = $tbl->find('all', ['conditions' => ['Partners.status' => 1], 'limit' => 50]);
            return $row = $query->all();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getRoadmaps()
    {
        $tbl = TableRegistry::get('Roadmaps');
        try {
            $query = $tbl->find('all', ['conditions' => ['Roadmaps.status' => 1], 'limit' => 50, 'order' => ['Roadmaps.date' => 'ASC']]);
            return $row = $query->all();
        } catch (\Throwable $th) {
            return false;
        }
    }
}
