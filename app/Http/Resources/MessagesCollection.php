<?php

namespace App\Http\Resources;

use App\Models\Message;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MessagesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'count' => $this->count(),
            'page' => $this->currentPage(),
            'per_page' => $this->perPage(),
            'has_more' => $this->hasMorePages(),
            'data' => $this->collection->map(function (Message $model) {
                return $model->only(['id', 'to', 'from', 'status', 'text']);
            })->all(),
        ];
    }
}
