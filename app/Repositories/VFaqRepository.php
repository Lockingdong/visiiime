<?php

namespace App\Repositories;

use App\Models\VFaq;

class VFaqRepository extends BaseRepository
{
    protected $vFaq;

    public function __construct(
        VFaq $vFaq
    )
    {
        parent::__construct($vFaq);
        $this->vFaq = $vFaq;
    }

    public function getAllVFaqs()
    {
        return $this->vFaq
                    ->orderBy('faq_order', 'DESC')
                    ->orderBy('created_at', 'DESC')
                    ->get();
    }

    public function getAvalVFaqs()
    {
        return $this->vFaq
            ->with('vCategory')
            ->where('faq_status', VFaq::FAQ_AVAILABLE)
            ->orderBy('faq_order')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getFaqsByCategory($VFaqs, $cate_id)
    {
        return $VFaqs->where('cate_id', $cate_id);
    }
}
