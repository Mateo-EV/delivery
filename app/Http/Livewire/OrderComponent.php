<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderComponent extends Component
{
    use WithPagination;

    public $search,
        $startdate,
        $enddate,
        $direction = "desc",
        $sort = "orders.created_at";

    public function mount(){
        $this->startdate = now()->subDay()->format("Y-m-d");
        $this->enddate = now()->format("Y-m-d");;
    }

    public function order(string $sort){
        if($this->sort == $sort){
            $this->direction = $this->direction == 'desc' ? 'asc' : 'desc';
        } else{
            $this->direction = 'asc';
        }
        $this->sort = $sort;
    }

    public function render()
    {
        $search = "%".$this->search."%";
        $between = [
            $this->startdate." 00:00:00",
            $this->enddate." 12:59:59"
        ];
        $orders = Order::join('users', 'orders.motorcyclist_id', '=', 'users.id')
            ->join('laboratories', 'orders.laboratory_id', '=', 'laboratories.id')
            ->whereBetween('orders.created_at', $between)
            ->where(function($query) use ($search){
                $query->where('users.name', 'like', $search)
                    ->orWhere('laboratories.name', 'like', $search)
                    ->orWhere('document', 'like', $search)
                    ->orWhere('ndocument', 'like', $search)
                    ->orWhere('code', 'like', $search)
                    ->orWhere('payment', 'like', $search)
                    ->orWhere('channel', 'like', $search)
                    ->orWhere('amount', 'like', $search);
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
        return view('livewire.order-component', compact('orders'));
    }
}
