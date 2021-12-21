<?php

namespace App\Services;

use App\Repositories\VFaqRepository;

class VFaqService extends BaseService
{
    protected $vFaqRepository;

    public function __construct(
        VFaqRepository $vFaqRepository
    )
    {
        parent::__construct($vFaqRepository);
        $this->vFaqRepository = $vFaqRepository;
    }

    public function getAllVFaqs()
    {
        return $this->vFaqRepository->getAllVFaqs();
    }

    public function getAvalVFaqs()
    {
        return $this->vFaqRepository->getAvalVFaqs();
    }

    public function getFaqsByCategory($VFaqs, $cate_id)
    {
        return $this->vFaqRepository->getFaqsByCategory($VFaqs, $cate_id);
    }
}
