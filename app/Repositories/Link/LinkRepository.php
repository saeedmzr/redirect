<?php

namespace App\Repositories\Link;

use App\Events\ViewCountIncrementEvent;
use App\Models\Link;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LinkRepository extends BaseRepository
{
    protected $model;

    public function __construct(Link $model)
    {
        $this->model = $model;
    }

    public function generateLink(Link $link)
    {
        $random_str = Str::random(10);
        $get_link_by_randomized_str = $this->model->where('generated_link', $random_str)->first();

        while ($get_link_by_randomized_str) {
            $random_str = Str::random(10);
            $get_link_by_randomized_str = $this->model->where('generated_link', $random_str)->first();
        }

        $link->generated_link = $random_str;
        $link->save();
        return $link;

    }

    public function redirect(string $generated_link)
    {


        $link = Cache::remember('link_' . $generated_link, 600, function () use ($generated_link) {


            $link_record = $this->model->where('generated_link', $generated_link)->first();
            if (!$link_record) return false;

            return $link_record;
        });

        ViewCountIncrementEvent::dispatch($link);


        return $link;
    }

    public function count(User $user, $started_at, $ended_at)
    {

        $ouput = DB::table('links')
            ->select(DB::raw('DATE(links.created_at) as date'), DB::raw('SUM(view_count) as views'))
            ->join('users', 'links.user_id', '=', 'users.id')
            ->groupBy('date')
            ->get();

        return $ouput;
    }

}
