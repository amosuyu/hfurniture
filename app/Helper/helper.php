<?php

namespace App\Helper;

use App\Models\Comments;

class Helper
{

    public function stars_averaged($id)
    {
        $comments = Comments::where('product_id', $id)->get();
        $totalStars = 0;
        $stars = "";
        $total = 0;
        if (($comments->count()) == 0) {
            for ($i = 1; $i <= 5; $i++) {
                $stars .= '<a href="javascript:"><i class="zmdi zmdi-star-outline" style="color:#ff7f00"></i></a>';
            }
        } else {
            for ($i = 0; $i < $comments->count(); $i++) {
                if ($comments[$i]->rate > 0) {
                    $total += 1;
                    $totalStars += $comments[$i]->rate;
                } 
            }

            if ($totalStars > 0 && $total > 0) {
                $totalStars /= $total;
                for ($i = 0; $i < (floor($totalStars)); $i++) {
                    $stars .= '<a href="javascript:"><i class="zmdi zmdi-star" style="color:#ff7f00"></i></a>';
                }
                if (isset(explode(".", (string) $totalStars)[1])) {
                    $stars .= '<a href="javascript:"><i class="zmdi zmdi-star-half" style="color:#ff7f00"></i></a>';
                }
                $count = substr_count($stars, '<i');
                for ($s = $count; $s < 5; $s++) {
                    $stars .= '<a href="javascript:"><i class="zmdi zmdi-star-outline" style="color:#ff7f00"></i></a>';
                }
            }else{
                for ($i = 0; $i < 5; $i++) {
                        $stars .= '<a href="javascript:"><i class="zmdi zmdi-star-outline" style="color:#ff7f00"></i></a>';
                }
            }
        }

        return $stars;
    }

    public function show_stars($quantity)
    {
        $stars = "";
        if ($quantity > 0) {
            for ($i = 0; $i < 5; $i++) {
                if ($i < $quantity) {
                    $stars .= '<a href="javascript:"><i class="zmdi zmdi-star" style="color:#ff7f00"></i></a>';
                } else {
                    $stars .= '<a href="javascript:"><i class="zmdi zmdi-star-outline" style="color:#ff7f00"></i></a>';
                }
            }
        }

        return $stars;
    }

    public static function instance()
    {
        return new Helper();
    }

}
