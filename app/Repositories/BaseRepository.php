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

}
