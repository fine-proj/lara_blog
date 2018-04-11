<?php
namespace Corp\Repositories;

use Illuminate\Support\Facades\Config;

abstract class Repository
{
    protected $model = FALSE;

    public function get($sel='*', $tak=FALSE, $pagination=FALSE, $whe=FALSE)
    {
        $builder = $this->model->select($sel);
        if($tak){
            $builder->take($tak);
        }
        if($whe){
            $builder->where($whe[0], $whe[1]);
        }
        if($pagination)
        {
            return $this->check($builder->paginate(Config::get('settings.paginate')));
        }
        return $this->check($builder->get());
    }

    public function one($alias, $relation = [])
    {
        $result = $this->model->where('alias', $alias)->first();
        return $result;
    }

    protected function check($result)
    {
        if($result->isEmpty()){
            return FALSE;
        }

        $result->transform(function ($item, $key){
            if(is_string($item->img) && is_object(json_decode($item->img)) && (json_last_error() == JSON_ERROR_NONE)){
                $item->img = json_decode($item->img);
            }

            return $item;
        });
        return $result;
    }
}
