<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model
{
    protected $table = 'tbl_stories';
    protected $fillable = [
        'title', 'story', 'audio', 'img', 'tbl_category_id'
    ];
    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo('App\Category', 'tbl_category_id')->withTrashed()->withDefault(['name' => 'undefined']);;
        //withTrashed() : Khi dữ liệu là xóa mềm, nó vẫn cho phép hiển thị ở trang khác, nhưng khi bị xóa cứng, sẽ xảy ra lỗi, nên phải thêm withDefault()
        //hoặc withDefault(['name' => 'Guest Author']); và khi đó {{ $post->author->name}} --> sẽ trả về một model Author rỗng nếu không có tác giả nào của bài viết đó. Hơn thế chúng ta còn có thể gán giá trị mặc định cho các model đó:
    }

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
