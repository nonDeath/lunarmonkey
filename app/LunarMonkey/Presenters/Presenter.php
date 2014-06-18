<?php namespace LunarMonkey\Presenters;

use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Presenter {

    /**
     * Return an instance of a Model wrapper
     * in a presenter object
     *
     * @param  Model       $model
     * @param  Presentable $presenter
     * @return Item
     */
    public function model(Model $model, Presentable $presenter)
    {
        $object = clone $presenter;

        $object->set($model);

        return $object;
    }

    /**
     * Return an instance of a Collection with each value
     * wrapped in a presented object
     *
     * @param  Collection  $collection
     * @param  Presentable $presenter
     * @return Collection
     */
    public function collection(Collection $collection, Presentable $presenter)
    {
        foreach($collection as $key => $value)
        {
            $collection->put($key, $this->model($value, $presenter));
        }

        return $collection;
    }

    /**
     * Return an instance of a Paginator with each value
     * wrapped in a presenter object
     *
     * @param  Paginator   $paginator
     * @param  Presentable $presenter
     * @return Paginator
     */
    public function paginator(Paginator $paginator, Presentable $presenter)
    {
        $items = array();

        foreach ($paginator->getItems() as $item)
        {
            $items[] = $this->model($item, $presenter);
        }

        $paginator->setItems($items);

        return $paginator;
    }
}