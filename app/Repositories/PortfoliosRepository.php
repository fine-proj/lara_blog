<?php
namespace Corp\Repositories;

use Corp\Portfolio;
use Corp\Repositories;
class PortfoliosRepository extends Repository
{
    public function __construct(Portfolio $portfolio)
    {
        $this->model = $portfolio;
    }
}