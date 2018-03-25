<?php
namespace Corp\Repositories;

use Illuminate\Support\Facades\Config;

abstract class Repository
{
    protected $model = FALSE;

    public function get($sel='*', $tak=FALSE)
    {
        $builder = $this->model->select($sel);
        if($tak){
            $builder->take($tak);
        }
        return $this->check($builder->get());
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
