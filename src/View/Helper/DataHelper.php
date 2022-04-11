<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\ORM\TableRegistry;

class DataHelper extends Helper
{

    public function getStake()
    {
        $tbl = TableRegistry::get('Stakes');

        $query = $tbl->find('list', ['keyField' => 'id', 'valueField' => 'days'])->order(['Stakes.days' => 'ASC'])->where(['Stakes.type'=>1]);
        return $query->toArray();
    }
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

            return $data = $tbl
                ->find()
                ->contain(['Blockchains'])
                ->where(['Projects.status' => 1])
                ->order(['Projects.id' => 'desc'])
                ->all();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getFeaturedSale()
    {
        $tbl = TableRegistry::get('Projects');
        try {
            $query = $tbl->find('all', [
                'contain' => ['Blockchains'],
                'conditions' => ['Projects.is_featured' => 1, 'Projects.status' => 1]
            ]);
            return $query->first();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getInfluencers(){
        $tbl = TableRegistry::get('Influencers');
        try {
            $query = $tbl->find('all', ['conditions' => ['Influencers.status' => 1], 'limit' => 100]);
            return $row = $query->all();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getPartners()
    {
        $tbl = TableRegistry::get('Partners');
        try {
            $query = $tbl->find('all', ['conditions' => ['Partners.status' => 1, 'Partners.type' => 1], 'limit' => 100]);
            return $row = $query->all();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getTeams()
    {
        $tbl = TableRegistry::get('Teams');
        try {
            $query = $tbl->find('all', ['conditions' => ['Teams.status' => 1, 'Teams.type' => 1], 'order' => ['Teams.position' => 'ASC'], 'limit' => 50]);
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

    public function getFeatures()
    {
        $tbl = TableRegistry::get('Features');
        try {
            $query = $tbl->find('all', ['conditions' => ['Features.status' => 1], 'limit' => 50, 'order' => ['Features.position' => 'ASC']]);
            return $row = $query->all();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getFooterMenu()
    {
        $tbl = TableRegistry::get('Pages');
        try {
            $query = $tbl->find('all', ['conditions' => ['Pages.status' => 1], 'limit' => 50, 'order' => ['Pages.title' => 'ASC']]);
            return $row = $query->all();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getCountries()
    {

        $tbl = TableRegistry::get('Countries');
        $query = $tbl->find('list', ['keyField' => 'id', 'valueField' => 'name'])->order(['Countries.name' => 'ASC']);
        return $query->toArray();
    }
}
