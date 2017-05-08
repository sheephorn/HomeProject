<?php

namespace App\Repositories;

class BaseRepository
{
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
	 * 保存(updateOrCreate)
	 *
	 * @param array $attributes 対象を選択するための属性の配列
	 * @param array $params 対象を更新するための値の配列
	 * @return 対象データ
	 **/
	public function save($attributes, $params)
	{
		$instance = $this->model
						->updateOrCreate($attributes, $params);
		return $instance;
	}

    /**
     * 並び替えクエリの発行関数
     * @param  Object $query     クエリ
     * @param  Object $condition Request
     * @param  Array $sortArray ソート定義済み配列
     * @return Object            クエリ
     */
    protected function orderBy($query, $condition, $sortArray)
    {
        if(isset($condition['sort']) && $condition['sort'] !== '' && isset($sortArray[$condition['sort']]) ) {
            if(isset($condition['order']) && ($condition['order'] === 'asc' || $condition['order'] === 'desc')) {
                $order = $condition['order'];
            } else {
                $order = 'asc';
            }
            $sorts = explode(',', $sortArray[$condition['sort']]);
            foreach ($sorts as $sort) {
                $query = $query->orderBy($sort, $order);
            }
        }
        return $query;
    }

    public function getPage($condition)
    {
        $ret = $this->createQuery($condition)
            ->forpage($condition['page'], $condition['show'])
            ->get();
        return $ret;
    }
}
